// Import necessary dependencies
import { writable, derived } from 'svelte/store';

// Store to manage popup state
export const isPopupOpen = writable(false);
export const openPopup = () => isPopupOpen.set(true);
export const closePopup = () => isPopupOpen.set(false);

// Store to manage teams
export const teams = writable([]);

// Derived store for the total number of members across all teams
export const totalMembersCount = derived(teams, ($teams) => 
    $teams.reduce((count, team) => count + (team.members ? team.members.length : 0), 0) // Handle undefined members
);

// Selected member state
export const selectedMember = writable(null); // Store to hold the selected member

// Function to add a new team
export function addTeam(label) {
    teams.update(currentTeams => {
        if (!currentTeams.some(team => team.label === label)) {
            return [...currentTeams, { label, members: [] }];
        }
        return currentTeams;
    });
}

// Function to add a member to a specific team
export function addMemberToTeam(teamIndex, member) {
    teams.update(currentTeams => {
        const team = currentTeams[teamIndex];
        if (team && !team.members.some(m => m.id === member.id)) {
            team.members.push(member);
        }
        return [...currentTeams];
    });
}

// Function to remove a member from a specific team
export function removeMemberFromTeam(teamIndex, memberId) {
    teams.update(currentTeams => {
        const team = currentTeams[teamIndex];
        if (team) {
            team.members = team.members.filter(member => member.id !== memberId);
        }
        return [...currentTeams];
    });
}

// Function to fetch all teams and their members from the backend
export async function fetchTeams() {
    try {
        const response = await fetch('http://localhost/my-php-backend/TEAM.php?fetch_teams=1');

        if (!response.ok) {
            throw new Error(`Failed to fetch teams: ${response.status} ${response.statusText}`);
        }

        const responseText = await response.text();
        
        // Check if the response text is empty
        if (!responseText) {
            console.error("No data received from fetchTeams endpoint.");
            return;
        }

        let data;
        try {
            data = JSON.parse(responseText);
        } catch (jsonError) {
            console.error("Invalid JSON received:", responseText);
            throw jsonError;
        }

        // Ensure data contains 'teams' field
        if (!data.teams) {
            console.error("No 'teams' field in response JSON:", data);
            return;
        }

        // Update teams store with fetched data
        teams.set(data.teams.map(team => ({
            id: team.id,
            label: team.label,
            members: team.members || [] // Ensure members array exists
        })));
    } catch (error) {
        console.error('Error fetching teams:', error);
    }
}

// Function to fetch team members from the API for a specific team
export async function fetchTeamMembers(teamId) {
    try {
        const response = await fetch(`/api.php?team_id=${teamId}`);
        
        if (!response.ok) {
            throw new Error(`Failed to fetch team members: ${response.status} ${response.statusText}`);
        }
        
        const members = await response.json();

        // Update specific team members
        teams.update(currentTeams => {
            const team = currentTeams.find(t => t.id === teamId);
            if (team) {
                team.members = members;
            }
            return [...currentTeams];
        });
    } catch (error) {
        console.error('Error fetching team members:', error);
    }
}

// Function to set the selected member and open the popup
export function setSelectedMember(member) {
    console.log(member); // Debug log
    selectedMember.set(member); // Update the selected member in the store
    isPopupOpen.set(true); // Open the popup
}
