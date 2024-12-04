<script lang="ts">
    import { onMount } from 'svelte';
    import Footer from "../../components/Footer.svelte";
    import HomepageNavbar from "../../components/HomepageNavbar.svelte";
    import TopServiceProvidersModal from '../../components/modals/TopServiceProvidersModal.svelte';
    
    import Cat1 from '$lib/assets/categories/photoandvideo.png';
    import Cat2 from '$lib/assets/categories/musicandaudio.png';
    import Cat4 from '$lib/assets/categories/graphicsanddesign.png';
    import Cat5 from '$lib/assets/categories/gownsandsuits.png';
    import Cat6 from '$lib/assets/categories/eventlighting.png';
    import Cat7 from '$lib/assets/categories/entertainment.png';

    let isModalOpen = false;
    let selectedCategory = '';
    let topProviders: never[] = [];

    async function openCategoryModal(category) {
        selectedCategory = category;
        isModalOpen = true;

        try {
            const response = await fetch(`http://localhost/my-php-backend/getTopServiceProviders.php?category=${encodeURIComponent(category)}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            topProviders = await response.json();
        } catch (error) {
            console.error('Error fetching top providers:', error);
            topProviders = [];
        }
    }

    const categories = [
        { name: 'Photo and Video', image: Cat1 },
        { name: 'Music and Audio', image: Cat2 },
        { name: 'Graphics and Design', image: Cat4 },
        { name: 'Gowns and Suits', image: Cat5 },
        { name: 'Event Lighting', image: Cat6 },
        { name: 'Entertainment', image: Cat7 }
    ];
</script>

<div class="font-montserratt min-h-screen bg-gray-50">
    <HomepageNavbar/>

    <main class="bg-gray-200 flex flex-col items-center justify-center py-12 min-h-screen">
        <div class="flex flex-col items-center">
            <!-- Main Title -->
            <h1 class="font-matiott text-4xl md:text-6xl lg:text-8xl text-center mb-6 text-black">EXPLORE THE GALLERY</h1>
            <p class="text-center mb-8">Unlock your imagination with El Galeria. We provide the best talents for your creative needs.</p>
    
            <!-- Search Bar -->
            <div class="flex items-center justify-center w-full max-w-3xl px-4">
                <input type="search" placeholder="Search by Talent Name, Category" class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-800" />
                <button class="bg-custom text-white p-3 ml-4 rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-700">Search</button>
            </div>
        </div>
    
        <!-- Subcategory Boxes -->
        <section class="grid grid-cols-3 gap-8 p-4 mt-10 max-w-6xl mx-auto">
            {#each categories as category}
                <div 
                    class="relative w-[300px] h-[200px] rounded-lg overflow-hidden cursor-pointer"
                    on:click={() => openCategoryModal(category.name)}
                >
                    <img 
                        src={category.image} 
                        alt={category.name} 
                        class="w-full h-full object-cover object-center rounded-lg opacity-90 transition-opacity duration-300 hover:opacity-90" 
                    />
                    <p class="absolute bottom-0 left-0 right-0 text-center bg-black bg-opacity-50 text-white py-2 rounded-b-lg">
                        {category.name}
                    </p>
                </div>
            {/each}
        </section>
    </main>

    <section class="mt-10 mb-10 ">
        <div class="flex items-center justify-center flex-col text-center">
            <p>Never run out of options</p>
            <h2 class="text-3xl font-bold">El Galeria is always updated</h2>
            <p>Browse through our wide variety of artists and build the best team for your events.</p>
            <a href="/ecreate"><button class="mt-6 px-4 py-2 bg-gray-600  text-2xl text-white rounded-lg hover:bg-green-800">
                Browse More
            </button></a>
        </div>
    </section>

        
    <TopServiceProvidersModal 
        bind:isOpen={isModalOpen} 
        categoryName={selectedCategory}
        topProviders={topProviders}
    />

    <Footer/>
</div>
