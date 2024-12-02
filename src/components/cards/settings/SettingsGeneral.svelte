<script lang="ts">
    import { onMount } from 'svelte';

    // Ensure activeSection is always a string
    let activeSection: string = 'settings'; // Default section

    onMount(() => {
        // Get the last part of the URL or default to 'profile'
        const path = window.location.pathname.split('/').pop() || 'settings';
        activeSection = path; // Set active section based on the current URL
    });
</script>

<aside class="relative flex flex-col w-full lg:w-1/6 p-4 space-y-2 border-r border-gray-300">
    <!-- general section -->
    <div class="space-y-2 m-2 relative">
        <h1 class="text-xl font-semibold mb-5 text-custom">GENERAL</h1>
        <a href="/settings" class={`block p-2 rounded ${activeSection === 'settings' ? 'bg-gray-400 text-white' : 'hover:bg-gray-300'}`}>
            My Profile
        </a>
        <a href="/settings/address" class={`block p-2 rounded ${activeSection === 'address' ? 'bg-gray-400 text-white' : 'hover:bg-gray-300'}`}>
            Address
        </a>
        <a href="/settings/deactivation" class={`block p-2 rounded ${activeSection === 'deactivation' ? 'bg-gray-400 text-white' : 'hover:bg-gray-300'}`}>
            Deactivation and Deletion
        </a>
        <a href="/settings/invite" class={`block p-2 rounded ${activeSection === 'invite' ? 'bg-gray-400 text-white' : 'hover:bg-gray-300'}`}>
            Invite a Friend
        </a>
        <a href="/settings/support" class={`block p-2 rounded ${activeSection === 'support' ? 'bg-gray-400 text-white' : 'hover:bg-gray-300'}`}>
            Customer Support
        </a>
        <a href="/settings/logout" class={`block p-2 rounded ${activeSection === 'logout' ? 'bg-gray-400 text-white' : 'hover:bg-gray-300'}`}>
            Log Out
        </a>
    </div>
</aside>
