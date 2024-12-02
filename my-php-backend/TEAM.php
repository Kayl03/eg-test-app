<?php
// Database connection setup
$host = 'localhost';
$db = 'galeria';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => "Connection failed: " . $e->getMessage()]);
    exit;
}

// Set response headers for CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle creating a team
    if (isset($_POST['create_team']) && !empty($_POST['label'])) {
        $label = $_POST['label'];
        $stmt = $pdo->prepare("INSERT INTO ETEAM (TeamName) VALUES (:label)");
        $stmt->execute(['label' => $label]);
        echo json_encode(['message' => 'Team created successfully']);
        exit;
    }

    // Handle adding a member
    if (isset($_POST['add_member']) && isset($_POST['team_id']) && isset($_POST['member_id'])) {
        $teamId = (int)$_POST['team_id'];
        $memberId = (int)$_POST['member_id'];
        $stmt = $pdo->prepare("INSERT INTO TEAM_MEMBER (TeamMemberID, ServiceProviderID) VALUES (:team_id, :member_id)");
        $stmt->execute(['team_id' => $teamId, 'member_id' => $memberId]);
        echo json_encode(['message' => 'Member added to team']);
        exit;
    }

    // Handle removing a member
    if (isset($_POST['remove_member']) && isset($_POST['team_id']) && isset($_POST['member_id'])) {
        $teamId = (int)$_POST['team_id'];
        $memberId = (int)$_POST['member_id'];
        $stmt = $pdo->prepare("DELETE FROM TEAM_MEMBER WHERE TeamMemberID = :team_id AND ServiceProviderID = :member_id");
        $stmt->execute(['team_id' => $teamId, 'member_id' => $memberId]);
        echo json_encode(['message' => 'Member removed from team']);
        exit;
    }

    // Return an error if no valid action is found
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

// Handle fetching all teams and their members
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_teams'])) {
    $stmt = $pdo->prepare("
        SELECT ETEAM.TeamID AS id, ETEAM.TeamName AS label, 
        GROUP_CONCAT(SERVICEPROVIDER.ServiceProviderID, ':', SERVICEPROVIDER.first_name, ':', SERVICEPROVIDER.last_name) AS members
        FROM ETEAM
        LEFT JOIN TEAM_MEMBER ON ETEAM.TeamID = TEAM_MEMBER.TeamID
        LEFT JOIN SERVICEPROVIDER ON TEAM_MEMBER.ServiceProviderID = SERVICEPROVIDER.ServiceProviderID
        GROUP BY ETEAM.TeamID

    ");
    $stmt->execute();
    
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare the output structure
    $result = [];
    foreach ($teams as $team) {
        $members = [];
        if ($team['members']) {
            foreach (explode(',', $team['members']) as $memberData) {
                list($memberId, $firstName, $lastName) = explode(':', $memberData);
                $members[] = [
                    'id' => (int)$memberId,
                    'FIRSTNAME' => $firstName,
                    'LASTNAME' => $lastName
                ];
            }
        }
        $result[] = [
            'id' => (int)$team['id'],
            'label' => $team['label'],
            'members' => $members
        ];
    }
    
    echo json_encode(['teams' => $result]);
    exit;
}

// Handle fetching team members by team ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['team_id'])) {
    $teamId = (int)$_GET['team_id']; // Ensure team_id is an integer
    $stmt = $pdo->prepare("
        SELECT SERVICEPROVIDER.* 
        FROM TEAM_MEMBER 
        JOIN SERVICEPROVIDER ON TEAM_MEMBER.ServiceProviderID = SERVICEPROVIDER.ServiceProviderID 
        WHERE TEAM_MEMBER.TeamMemberID = :team_id
    ");
    $stmt->execute(['team_id' => $teamId]);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($members);
    exit;
}

// Return an error if no valid action is found
echo json_encode(['error' => 'Invalid request']);
exit;
