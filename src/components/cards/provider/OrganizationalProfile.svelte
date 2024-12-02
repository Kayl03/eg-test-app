<script lang="ts">
    import { writable } from 'svelte/store';
    import profilePicture from '$lib/assets/profile/organization.png';
    import Confirmation from '../../pupUps/Confirmation.svelte';

    // store to track edit mode
    let isEditing = writable(false);

    interface BusinessHours {
    [day: string]: string;
    }

    // data of the profie
    interface Profile {
    name: string;
    username: string;
    location: string;
    memberSince: string;
    about: string;
    services: string[];
    businessHours: BusinessHours;
    socialMedia: {
        facebook: string;
        mail: string;
        instagram: string;
    };
    }


    let profile: Profile = {
        name: 'Studio Two Four',
        username: '@Stud24',
        location: 'Ugac Sur, Tuguegarao Cagayan',
        memberSince: 'August 2024',
        about: 'Lorem ipsum dolor sit amet...',
        services: ['Voice Over', 'Hosting'],
        businessHours: {
            Sunday: 'Closed',
            Monday: '8:00 AM - 5:00 PM',
            Tuesday: '8:00 AM - 5:00 PM',
            Wednesday: '8:00 AM - 5:00 PM',
            Thursday: '8:00 AM - 5:00 PM',
            Friday: '8:00 AM - 4:00 PM',
            Saturday: 'Closed'
        },
        socialMedia: {
            facebook: '',
            mail: '',
            instagram: ''
        }
    };

    // toggle edit mode
    function toggleEdit() {
        isEditing.update(editing => !editing);
    }

    //add a new service
    function addService() {
        profile.services.push('New Service');
    }

    // save the profile changes
    function saveProfile() {
        isEditing.set(false);
    }


</script>

<main class="font-montserratt max-w-[1300px] mx-auto relative">
    <div class="box-border border-2 max-w-[400px] bg-white mt-10 pt-5 flex flex-col relative rounded-lg">
        <button class="absolute top-4 right-4 text-sm font-medium hover:underline" on:click={toggleEdit}>
            {$isEditing ? 'Save' : 'Edit'}
        </button>

        <!-- profile box -->
        <div class="flex flex-col items-center mb-5 mt-5">
            <div class="w-48 h-48 overflow-hidden rounded-full shadow-md border-2 border-custom">
                <img src="{profilePicture}" alt="Stud24" class="w-full h-full object-cover" />
            </div>
            {#if $isEditing}
                <input type="text" bind:value={profile.name} class="font-bold text-xl mb-2 text-center border p-1 rounded" />
                <input type="text" bind:value={profile.username} class="text-sm text-center border p-1 rounded" />
            {:else}
                <h1 class="font-bold text-xl mb-2">{profile.name}</h1>
                <p class="text-sm">{profile.username}</p>
            {/if}
        </div>

        <!-- action buttons -->
        <div class="flex flex-col items-center space-y-2 mb-5">
            <button class="w-3/4 py-2 bg-custom text-white rounded-full hover:bg-green-800">Add to Team</button>
            <button class="w-3/4 py-2 bg-custom text-white rounded-full hover:bg-green-800">Message Us</button>
            <button class="w-3/4 py-2 bg-custom text-white rounded-full hover:bg-green-800">Follow</button>
        </div>

        <!-- locaation and member since -->
        <div class="flex flex-col px-5 mb-5 ">
            <!-- divider -->
            <hr class="border-t border-gray-300 my-4">
            <!-- location -->
            <div class="mb-2 flex items-center">
                <h2 class="font-semibold text-lg text-custom mr-3">Location</h2>
                {#if $isEditing}
                    <input type="text" name="location" bind:value={profile.location} class="text-sm border p-1 rounded" />
                {:else}
                    <p class="text-sm">{profile.location}</p>
                {/if}
            </div>
            <!-- member since -->
            <div class="flex items-center">
                <h2 class="font-semibold text-lg text-custom mr-3">Member Since</h2>
                    <p class="p-1 text-sm">{profile.memberSince}</p>
            </div>
        </div>

        <!-- bio -->
        <div class="px-5 mb-5">
            <hr class="border-t border-gray-300 my-4">
            <h2 class="font-semibold text-lg mb-2">About Me</h2>
            {#if $isEditing}
                <textarea class="text-sm text-gray-700 w-full border p-1 rounded" bind:value={profile.about}></textarea>
            {:else}
                <p class="text-sm text-gray-700">{profile.about}</p>
            {/if}
        </div>

        <!-- Services Offered -->
        <div class="px-5 mb-5">
            <hr class="border-t border-gray-300 my-4">
            <h2 class="font-semibold text-lg mb-2">Services Offered</h2>
            {#if $isEditing}
                <div class="flex flex-col space-y-2">
                    {#each profile.services as service, index (service)}
                        <div class="flex items-center">
                            <input
                                type="text"
                                bind:value={profile.services[index]}
                                class="py-2 px-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-custom"
                                placeholder="Enter a service"
                            />
                            <button
                                on:click={() => {
                                    // Remove the service immediately
                                    profile.services.splice(index, 1);
                                }}
                                class="ml-2 text-red-600 hover:underline"
                            >
                                Delete
                            </button>
                        </div>
                    {/each}
                    <button
                        on:click={() => profile.services = [...profile.services, '']}
                        class="py-2 px-4 bg-custom text-white rounded-full hover:bg-green-800"
                    >
                        Add Service
                    </button>
                </div>
            {:else}
                <div class="flex flex-wrap gap-2">
                    {#each profile.services.filter(service => service.trim() !== '') as service}
                        <button class="py-2 px-4 bg-custom text-white rounded-full hover:bg-green-800">
                            {service}
                        </button>
                    {/each}
                </div>
            {/if}
        </div>

        <!-- business hours -->
        <div class="px-5 mb-5">
            <hr class="border-t border-gray-300 my-4">
            <h2 class="font-semibold text-lg mb-2">Business Hours</h2>
            <div class="grid grid-cols-2 gap-x-4 text-sm">
                {#each Object.entries(profile.businessHours) as [day, hours]}
                    <span>{day}:</span>
                    {#if $isEditing}
                        <input type="text" bind:value={profile.businessHours[day]} class="border p-1 rounded"/>
                    {:else}
                        <span>{hours}</span>
                    {/if}
                {/each}
            </div>
        </div>
        

        <!-- social media -->
        <div class="px-5 mb-5">
            <hr class="border-t border-gray-300 my-4">
            <h2 class="font-semibold text-lg mb-2 text-custom">Social Media</h2>
                <!-- facebook -->
                <div class="flex items-center mb-3">
                    <button class="mr-2">
                        <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    {#if $isEditing}
                        <input type="text" name="facebook" bind:value={profile.socialMedia.facebook} class="text-sm border p-1 rounded" placeholder="Enter Facebook link" />
                    {:else}
                        <a href={profile.socialMedia.facebook} target="_blank" class="text-blue-600 hover:underline">{profile.socialMedia.facebook || 'Facebook'}</a>
                    {/if}
                </div>
                <!--mail -->
                <div class="flex items-center mb-3">
                    <button class="mr-2">
                        <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                        </svg>                      
                    </button>
                    {#if $isEditing}
                        <input type="text" name="mail" bind:value={profile.socialMedia.mail} class="text-sm border p-1 rounded" placeholder="Enter Mail link" />
                    {:else}
                        <a href={profile.socialMedia.mail} target="_blank" class="text-blue-600 hover:underline">{profile.socialMedia.mail || 'Mail'}</a>
                    {/if}
                </div>
                <!-- instagram -->
                <div class="flex items-center">
                    <button class="mr-2">
                        <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    {#if $isEditing}
                        <input type="text" name="instagram" bind:value={profile.socialMedia.instagram} class="text-sm border p-1 rounded" placeholder="Enter Instagram link" />
                    {:else}
                        <a href={profile.socialMedia.instagram} target="_blank" class="text-blue-600 hover:underline">{profile.socialMedia.instagram || 'Instagram'}</a>
                    {/if}
                </div>
        </div>
    </div>
    <!-- view public profile box -->
    <div class="box-border border-2 w-[400px] bg-white mt-5 p-2 flex justify-center rounded-lg">
        <button class="px-4 py-2  text-custom rounded hover:underline">
            View Profile in Public
        </button>
    </div>
</main>