<script lang="ts">
    import { onMount } from 'svelte';
    import profilePicture from '$lib/assets/homepage/Beluga.png';

    let profile = {
        name: '',
        email: ''
    };

    // Fetch profile data when the component mounts
    onMount(async () => {
        try {
            console.log('Attempting to fetch profile data...');
            const response = await fetch('http://localhost/my-php-backend/getProfile.php', {
                method: 'GET',
                credentials: 'include',  // Important for sending cookies
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            console.log('Response status:', response.status);
            
            if (response.ok) {
                const data = await response.json();
                console.log('Received profile data:', data);
                profile.name = data.name || "Default Name";
                profile.email = data.email || "Default Email";
            } else {
                const errorData = await response.json();
                console.error('Failed to fetch profile data:', errorData);
            }
        } catch (error) {
            console.error('Error fetching profile:', error);
        }
    });

    let isEditing = false;
    let showPopup = false;
    let showSuccessMessage = false;
    let showSwitchPopup = false;
</script>

<main class="font-montserratt max-w-[1300px] mx-auto relative">
    <div class="box-border border-2 h-[800px] w-[400px] bg-white mt-10 pt-5 flex flex-col items-center relative rounded-lg">
        <!-- Profile Picture -->
        <div class="w-48 h-48 overflow-hidden rounded-full shadow-md border-2 border-custom mb-5">
            <img src={profilePicture} alt="Profile Picture" class="w-full h-full object-cover" />
        </div>

        <!-- Name and Email -->
        <div class="text-center mb-5">
            <h1 class="text-2xl font-bold mb-2">{profile.name }</h1>
            <p class="text-gray-600">{profile.email}</p>
        </div>

        <!-- Profile Details -->
        <div class="w-full px-5">
            <hr class="border-t border-gray-300 my-4" />

            <!-- Location -->
            <div class="mb-2 flex items-center">
                <h2 class="font-semibold text-lg text-custom mr-3">Location</h2>
                {#if isEditing}
                    <input type="text" name="location" class="text-sm border p-1 rounded w-full" />
                {:else}
                    <p class="text-sm">Location: Wala pa</p>
                {/if}
            </div>

            <!-- Member Since -->
            <div class="flex items-center mb-2">
                <h2 class="font-semibold text-lg text-custom mr-3">Member Since</h2>
                <p class="text-sm">Placeholder: Wala pa</p>
            </div>

            <!-- Social Media -->
            <div class="mt-4">
                <h3 class="text-custom text-md font-semibold mb-2">Social Media</h3>

                <!-- Facebook -->
                <div class="flex items-center mb-2">
                    <p class="mr-2">Facebook:</p>
                    {#if isEditing}
                        <input type="text" name="facebook" class="text-sm border p-1 rounded w-full" />
                    {:else}
                        <p class="text-sm">Facebook: Wala pa</p>
                    {/if}
                </div>

                <!-- Mail -->
                <div class="flex items-center mb-2">
                    <p class="mr-2">Mail:</p>
                    {#if isEditing}
                        <input type="text" name="mail" bind:value={profile.email} class="text-sm border p-1 rounded w-full" />
                    {:else}
                        <p class="text-sm">{profile.email}</p>
                    {/if}
                </div>

                <!-- Instagram -->
                <div class="flex items-center mb-2">
                    <p class="mr-2">Instagram:</p>
                    {#if isEditing}
                        <input type="text" name="instagram" class="text-sm border p-1 rounded w-full" />
                    {:else}
                        <p class="text-sm">Instagram: Wala pa</p>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .text-custom {
        color: #ff6700;
    }
</style>
