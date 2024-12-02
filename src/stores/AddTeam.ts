import { writable } from 'svelte/store';

// Define an interface for the expected team member response from the backend
export interface TeamMember {
    id: number; // Assuming the ID is a number
    FIRSTNAME: string; // Assuming the member has a FIRSTNAME field
    LASTNAME: string; // Assuming the member has a LASTNAME field
}

// Define an interface for the expected team response from the backend
export interface TeamResponse {
    id: number;
    label: string;
    members?: TeamMember[]; // Optional, in case no members are returned
}

// Create a writable store for teams
export const teams = writable<TeamResponse[]>([]);

// Create a writable store for managing the popup state
export const isPopupOpen = writable(false);

// Function to open the popup
export function openPopup() {
    isPopupOpen.set(true);
}

// Function to close the popup
export function closePopup() {
    isPopupOpen.set(false);
}

// Function to fetch all teams and their members from the backend
export async function fetchTeams(): Promise<void> {
    try {
        const response = await fetch('http://localhost/my-php-backend/TEAM.php?fetch_teams=1');

        if (!response.ok) {
            throw new Error(`Failed to fetch teams: ${response.status} ${response.statusText}`);
        }

        const responseText = await response.text();

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

        if (!data.teams) {
            console.error("No 'teams' field in response JSON:", data);
            return;
        }

        // Update teams store with fetched data
        teams.set(data.teams.map((team: TeamResponse) => ({
            id: team.id,
            label: team.label,
            members: team.members || [] // Ensure members array exists
        })));

    } catch (error) {
        console.error('Error fetching teams:', error);
    }
}
