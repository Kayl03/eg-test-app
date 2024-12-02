<script lang="ts">
    // Existing script remains unchanged
    import HomepageNavbar from "../../components/HomepageNavbar.svelte";
    import { openPopup } from '../../stores/Addteam';
    import AddTeam from '../../components/pupUps/AddTeam.svelte';

    interface SearchResult {
        FIRSTNAME: string;
        LASTNAME: string;
        BIO: string;
        RATING: number;
        SNAME: string[];
        ProfileImg?: string;
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
            const requestBody: any = { searchTerm };
            if (minPrice > 0) requestBody.minPrice = minPrice;
            if (maxPrice < 10000) requestBody.maxPrice = maxPrice;
            if (selectedCategories.length > 0) requestBody.category = selectedCategories;
            if (minRating > 0) requestBody.minRating = minRating;

            const response = await fetch('http://localhost/my-php-backend/ecreate.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(requestBody),
            });

            if (!response.ok) {
                console.error('Failed to fetch:', response.statusText);
                return;
            }

            const data = await response.json();
            if (data.message) {
                console.warn('No results found:', data.message);
                searchResults = [];
                return;
            }

            if (!Array.isArray(data)) {
                console.error('Expected an array but got:', data);
                return;
            }

            searchResults = data.map(item => ({
                FIRSTNAME: item.FIRSTNAME, 
                LASTNAME: item.LASTNAME, 
                BIO: item.BIO, 
                RATING: item.RATING !== null ? item.RATING : 0,
                SNAME: item.SNAME ? item.SNAME.split(',') : [],
                ProfileImg: item.ProfileImg
            }));

            console.log('Updated Search Results:', searchResults);
        } catch (error) {
            console.error('Error fetching services:', error);
        } finally {
            isLoading = false;
        }
    }
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
            </div>

            <!-- Categories -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Search Filter</h3>

                <div class="space-y-2">
                    <h4 class="font-semibold">By Category</h4>
                    <div class="space-y-1">
                        {#each ['Music & Audio', 'Graphics & Design', 'Catering Services', 'Gowns & Suits', 'Photo & Video Production', 'Entertainment & Activities', 'Make-Up Artists', 'Event Lighting', 'Bartending'] as cat}
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
                        <input type="text" id="search-term" placeholder="Search for services..." class="border rounded p-2 flex-grow min-w-[200px]" bind:value={searchTerm} />
                    </div>

                    <!-- Apply Filters Button -->
                    <div class="flex justify-center">
                        <button class="bg-custom text-white py-2 px-2 rounded w-full sm:w-40" on:click={searchServices}>
                            Apply
                        </button>
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
                        {#each searchResults as { FIRSTNAME, LASTNAME, BIO, RATING, SNAME, ProfileImg }}
                            <div class="bg-white border rounded-lg shadow-md max-w-sm">
                                <div class="p-2">
                                    <div class="relative w-82 h-80 overflow-hidden rounded-lg">
                                        <img src={ProfileImg} alt="{FIRSTNAME} {LASTNAME}" class="w-full h-full object-cover rounded-lg" />
                                    </div>

                                    <div class="flex items-center mt-2">
                                        <h4 class="font-semibold text-lg flex-grow">{FIRSTNAME} {LASTNAME}</h4>
                                        <span class="flex items-center text-yellow-500">
                                            {'★'.repeat(Math.round(RATING)) + '☆'.repeat(5 - Math.round(RATING))}
                                            <span class="text-gray-500 ml-1">{RATING.toFixed(1)}</span>
                                        </span>
                                    </div>

                                    <div class="flex space-x-2 mt-2">
                                        {#each SNAME as SERVICE}
                                            <span class="bg-green-500 text-white text-xs py-1 px-2 rounded">{SERVICE}</span>
                                            
                                        {/each}
                                    </div>

                                    <p class="mt-2 text-gray-600">{BIO}</p>

                                    <div class="flex space-x-10 mt-4 items-center justify-center mb-2">
                                        <a href="/profile/{FIRSTNAME}-{LASTNAME}">
                                            <button class="bg-green-800 text-white py-2 px-8 rounded-lg">Visit Profile</button>
                                        </a>
                                        <button class="bg-green-800 text-white py-2 px-8 rounded-lg" on:click={openPopup}>Add to Team</button>
                                    </div>
                                    <AddTeam />
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
