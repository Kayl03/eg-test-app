<script lang="ts">
    import HomepageNavbar from "../../components/HomepageNavbar.svelte";
    import { openPopup } from '../../stores/Addteam';
    import AddTeam from '../../components/pupUps/AddTeam.svelte';
    import { onMount } from 'svelte';

    interface SearchResult {
        ServicesID: number;
        SName: string;
        SPrice: number;
        first_name: string;
        last_name: string;
        email: string;
        ContactNum: string;
        CategName: string;
        Rating: number;
        Feedback: string;
    }

    let minPrice = 0;
    let maxPrice = 10000;
    let selectedCategories: string[] = [];
    let minRating = 0;
    let searchTerm = '';
    let searchResults: SearchResult[] = [];
    let isLoading = false;

    function toggleCategory(cat: string) {
        const index = selectedCategories.indexOf(cat);
        if (index === -1) {
            selectedCategories.push(cat);
        } else {
            selectedCategories.splice(index, 1);
        }
    }

    async function searchServices(): Promise<void> {
        console.log('Search button clicked');
        console.log({ minPrice, maxPrice, category: selectedCategories, minRating, searchTerm });

        isLoading = true;
        try {
            // Build the query parameters
            const params = new URLSearchParams();
            if (searchTerm) params.append('search', searchTerm);
            if (minPrice > 0) params.append('minPrice', minPrice.toString());
            if (maxPrice < 10000) params.append('maxPrice', maxPrice.toString());
            if (selectedCategories.length > 0) params.append('category', selectedCategories[0]); // API supports one category at a time
            if (minRating > 0) params.append('rating', minRating.toString());

            const response = await fetch(`http://localhost/my-php-backend/searchServices.php`, {
                method: 'GET',
                headers: { 'Content-Type': 'application/json' },
            });

            if (!response.ok) {
                console.error('Failed to fetch:', response.statusText);
                return;
            }

            const data = await response.json();
            if (!data.success) {
                console.warn('Search failed:', data.message);
                searchResults = [];
                return;
            }

            searchResults = data.data;
            console.log('Updated Search Results:', searchResults);
        } catch (error) {
            console.error('Error fetching services:', error);
        } finally {
            isLoading = false;
        }
    }

    onMount(() => {
        searchServices();
    });
</script>


<main class="bg-gray-200 min-h-screen font-montserrat">
    <HomepageNavbar />

    <div class="flex flex-col lg:flex-row">
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-1/5 p-4 flex flex-col space-y-4 border-r border-gray-300">
            <!-- Price Range -->
            <div class="space-y-2 m-2">
                <label for="min-price" class="text-lg font-semibold">Min Price</label>
                <input type="number" id="min-price" placeholder="Min" class="border rounded p-2 w-full" bind:value={minPrice} />
                
                <label for="max-price" class="text-lg font-semibold">Max Price</label>
                <input type="number" id="max-price" placeholder="Max" class="border rounded p-2 w-full" bind:value={maxPrice} />
                <button class="bg-custom text-white py-2 px-2 rounded w-full sm:w-40" on:click={searchServices}>
                    Apply
                </button>
            </div>


            <!-- Categories -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Search Filter</h3>

                <div class="space-y-2">
                    <h4 class="font-semibold">By Category</h4>
                    <div class="space-y-1">
                        {#each ['Audio Services', 'Design & Print', 'Food & Beverage', 'Clothing Services', 'Photography & Video', 'Entertainment', 'Beauty Services', 'Lighting', 'Beverage Services'] as cat}
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2" name="category" on:change={() => toggleCategory(cat)} />
                            {cat}
                        </label>
                        {/each}                        
                    </div>
                </div>

                <!-- Ratings -->
                <div class="space-y-2">
                    <h4 class="font-semibold">By Rating</h4>
                    <div class="space-y-1">
                        {#each [5, 4, 3, 2, 1] as rating}
                        <label class="flex items-center">
                            <input type="radio" name="rating" class="mr-2" value={rating} on:change={() => minRating = rating} />
                            {'★'.repeat(rating) + ' ' + rating + ' Stars'}
                        </label>
                        {/each}
                    </div>
                </div>
            </div>

        </aside>


        <!-- Main Content -->
        <div class="flex-1 p-4">
            <!-- Header with Search Bar -->
            <header class="mb-4">
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-4">
                    <button class="text-gray-500 hover:text-gray-800 mt-5">
                        <a href="/homepage">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    </button>


                    <!-- Search Bar -->
                    <div class="flex flex-col flex-grow">
                        <label for="search-term" class="text-sm font-semibold">Search</label>
                        <div class="flex">
                            <input 
                                type="text" 
                                id="search-term" 
                                placeholder="Search for services..." 
                                class="border rounded-l p-2 flex-grow min-w-[200px]" 
                                bind:value={searchTerm}
                                on:keypress={(e) => e.key === 'Enter' && searchServices()} 
                            />
                            <button 
                                class="bg-custom text-white px-4 rounded-r"
                                on:click={searchServices}
                            >
                                Search
                            </button>
                        </div>

                    </div>

                    <!-- Apply Filters Button -->
                    <div class="flex justify-center">
                        
                    </div>
                </div>

                <hr class="border-gray-300" />
            </header>

            <!-- Search Results Section -->
            <section class="p-4">
                <h3 class="text-lg font-semibold mb-4">Talent Related to: {searchTerm || ''}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    {#if isLoading}
                        <p>Loading results...</p>
                    {:else if searchResults && searchResults.length > 0}
                        {#each searchResults as result}
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <h3 class="text-xl font-semibold">{result.SName}</h3>
                                <p class="text-gray-600">₱{result.SPrice}</p>
                                <p class="text-sm text-gray-500">Provider: {result.first_name} {result.last_name}</p>
                                <p class="text-sm text-gray-500">Category: {result.CategName}</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-500">★</span>
                                    <span class="ml-1">{result.Rating.toFixed(1)}</span>
                                </div>
                                {#if result.Feedback}
                                    <p class="text-sm text-gray-600 mt-2">"{result.Feedback}"</p>
                                {/if}
                                <div class="mt-2">
                                    <a href="mailto:{result.email}" class="text-blue-500 hover:text-blue-700 text-sm">
                                        Contact: {result.ContactNum}
                                    </a>
                                </div>
                            </div>
                        {/each}
                    {:else}
                        <p>No Results Found. Try Adjusting your filters.</p>
                    {/if}
                </div>
            </section>
        </div>
    </div>

</main>
