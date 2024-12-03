<script>
    import { goto } from '$app/navigation';
    
    export let isOpen = false;
    export let categoryName = '';
    export let topProviders = [];

    function closeModal() {
        isOpen = false;
    }

    function viewProfile(providerId) {
        goto(`/service-provider-profile/${providerId}`);
    }
</script>

{#if isOpen}
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl p-6 w-[600px] max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-green-600">Top 5 {categoryName} Service Providers</h2>
                <button 
                    on:click={closeModal}
                    class="text-gray-500 hover:text-gray-700 text-2xl"
                >
                    &times;
                </button>
            </div>

            <div class="grid grid-cols-5 gap-4">
                {#each topProviders as provider, index}
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-green-500">
                            <img 
                                src={provider.ProfileImg || '/default-profile.png'} 
                                alt={provider.first_name} 
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <span class="text-sm font-semibold mt-2 text-center">
                            {provider.first_name} {provider.last_name}
                        </span>
                        <div class="text-xs text-gray-500 mb-2">
                            Rank {index + 1}
                        </div>
                        <button 
                            on:click={() => viewProfile(provider.ServiceProviderID)}
                            class="bg-green-500 text-white px-3 py-1 rounded-full text-xs hover:bg-green-600 transition"
                        >
                            View Profile
                        </button>
                    </div>
                {/each}
            </div>
        </div>
    </div>
{/if}
