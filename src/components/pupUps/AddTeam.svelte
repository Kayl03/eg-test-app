<script lang="ts">
    import Icon from '$lib/assets/homepage/Beluga.png';

    import { isPopupOpen, closePopup } from '../../stores/AddTeam';
    import { onDestroy } from 'svelte';
    import type { Unsubscriber } from 'svelte/store';

    let isOpen: boolean = false;

    // Subscribe to the popup state store
    let unsubscribe: Unsubscriber = isPopupOpen.subscribe((value: boolean) => {
        isOpen = value;
    });

    // Cleanup the subscription when the component is destroyed
    onDestroy(() => {
        unsubscribe();
    });
</script>

{#if isOpen}
    <div class="fixed inset-0 flex items-center justify-end pr-0 font-montserratt">
        <div class="relative bg-custom p-6 rounded-lg shadow-lg z-20 text-center w-[700px] h-[420px] max-w-full translate-x-[-80%]">
            <button 
                class="absolute top-2 right-2 text-white text-xl font-bold"
                on:click={closePopup}>
                &times;
            </button>
            
            <!-- Upper Left Section -->
            <div class="text-center mb-4">
                <p class="text-lg font-semibold text-white">Pick a Team</p>
            </div>

            <!-- White Box Section -->
            <div class="bg-white p-4 rounded-lg mb-4">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-lg font-semibold">Team 1: Wedding</p>
                    <button class="text-black hover:underline">Edit</button>
                </div>
                <div class="flex justify-center gap-5">
                    <!-- Image placeholders -->
                    <div class="w-20 h-20 bg-gray-300 rounded-full overflow-hidden">
                        <img src="{Icon}" alt="Image 1" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-20 h-20 bg-gray-300 rounded-full overflow-hidden">
                        <img src="{Icon}" alt="Image 2" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-20 h-20 bg-gray-300 rounded-full overflow-hidden">
                        <img src="{Icon}" alt="Image 3" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-20 h-20 bg-gray-300 rounded-full overflow-hidden">
                        <img src="{Icon}" alt="Image 4" class="w-full h-full object-cover" />
                    </div>
                </div>
            </div>

            <!-- Another White Box Section -->
            <div class="bg-white p-4 rounded-lg h-[160px]">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-lg font-semibold">Team 2:</p>
                </div>
                <div class="justify-center items-center h-full pt-3">
                    <button class=" text-black py-2 px-4 rounded-lg hover:underline">
                        Add New Team 
                    </button>
                </div>
            </div>
        </div>
    </div>
{/if}
