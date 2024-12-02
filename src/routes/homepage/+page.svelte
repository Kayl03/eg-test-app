<script lang="ts">
    import Footer from "../../components/Footer.svelte";
    import Icon1 from '$lib/assets/homepage/Beluga.png';
    import Icon2 from '$lib/assets/profile/calvin.png';
    import Icon3 from '$lib/assets/profile/darren.png';
    import Icon4 from '$lib/assets/profile/kyle.png';
    import Cat1 from '$lib/assets/categories/photoandvideo.png';
    import Cat2 from '$lib/assets/categories/musicandaudio.png';
    import Cat3 from '$lib/assets/categories/makeup.png';
    import Cat4 from '$lib/assets/categories/graphicsanddesign.png';
    import Cat5 from '$lib/assets/categories/gownsandsuits.png';
    import Cat6 from '$lib/assets/categories/eventlighting.png';
    import Cat7 from '$lib/assets/categories/entertainment.png';
    import Cat8 from '$lib/assets/categories/cateringservices.png';



	import HomepageNavbar from "../../components/HomepageNavbar.svelte";



</script>

<div class="font-montserratt">

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
        <section class="flex flex-wrap justify-center gap-5 p-4 mt-10">
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat1} alt="Category 1" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Photo and Video</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat2} alt="Category 2" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Music and Audio</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat3} alt="Category 3" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Hair and Makeup</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat4} alt="Category 4" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Graphics and Design</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat5} alt="Category 5" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Gowns and Suits</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat6} alt="Category 6" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Events Lighting</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat7} alt="Category 7" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Entertainment</p>
            </button>
            <button class="bg-white rounded-lg shadow-lg flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105 w-[200px] h-[200px] relative">
                <img src={Cat8} alt="Category 8" class="w-full h-full object-cover rounded-lg opacity-70 transition-opacity duration-300 hover:opacity-90" />
                <p class="absolute text-center text-white font-bold top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">Catering Services</p>
            </button>
        </section>
        
    </main>
    

    <!-- idk -->
    <section class="mt-10 mb-10 ">
        <div class="flex items-center justify-center flex-col text-center">
            <p>Never run out of options</p>
            <h2 class="text-3xl font-bold">El Galeria is always updated</h2>
            <p>Browse through our wide variety of artists and build the best team for your events.</p>
        </div>
    </section>

    <!-- rated talents -->
    <section class="bg-gray-200 p-7 font-montserrat">
        <h2 class="text-3xl font-bold text-black text-center">Most Rated Talents</h2>
        <div class="flex flex-wrap justify-center gap-10 mt-8 mb-10">
            <!-- card 1 -->
            <button class="bg-white rounded-lg shadow-lg w-80 h-50 flex flex-col items-center overflow-hidden group transition-transform duration-300 ease-in-out transform hover:scale-105">
                <img src="{Icon1}" alt="Van Bunagan" class="w-full h-full object-cover rounded-t-lg" />
                <div class="flex flex-col items-center p-2 flex-grow">
                    <h3 class="text-xl mb-2">VAN BUNAGAN</h3>
                    <p class="text-gray-600">Model</p>
                </div>
            </button>
            <!-- card 2 -->
            <button class="bg-white rounded-lg shadow-lg w-80 h-50 flex flex-col items-center overflow-hidden group transition-transform duration-300 ease-in-out transform hover:scale-105">
                <img src="{Icon3}" alt="DARREN DELA CRUZ" class="w-full h-full object-cover rounded-t-lg" />
                <div class="flex flex-col items-center p-2 flex-grow">
                    <h3 class="text-xl mb-2">DARREN DELA CRUZ</h3>
                    <p class="text-gray-600">Cinematographer</p>
                </div>
            </button>
            <!-- card 3 -->
            <button class="bg-white rounded-lg shadow-lg w-80 h-50 flex flex-col items-center overflow-hidden group transition-transform duration-300 ease-in-out transform hover:scale-105">
                <img src="{Icon2}" alt="CALVIN CAGUIN" class="w-full h-full object-cover rounded-t-lg" />
                <div class="flex flex-col items-center p-2 flex-grow">
                    <h3 class="text-xl mb-2">CALVIN CAGUIN</h3>
                    <p class="text-gray-600">Voice Actor</p>
                </div>
            </button>
            <!-- card 4 -->
            <button class="bg-white rounded-lg shadow-lg w-80 h-50 flex flex-col items-center overflow-hidden group transition-transform duration-300 ease-in-out transform hover:scale-105">
                <img src="{Icon4}" alt="KYLE UMBRERO" class="w-full h-full object-cover rounded-t-lg" />
                <div class="flex flex-col items-center p-2 flex-grow">
                    <h3 class="text-xl mb-2">KYLE UMBRERO</h3>
                    <p class="text-gray-600">Tattoo Artist</p>
                </div>
            </button>
        </div>
    </section>


    <section class="flex items-center justify-center bg-gray-200">
        <div class="flex flex-col items-center justify-center w-[1400px] h-[250px] bg-custom text-white font-bold rounded-lg shadow-lg mb-10">
            <p class="text-5xl">Freelance services at your fingertips!</p>
            <a href="/ecreate">
            <button class="mt-6 px-4 py-2 bg-gray-600  text-2xl text-white rounded-lg hover:bg-green-800">
                Browse More
            </button></a>

        </div>
    </section>
    
    
       

    <Footer/>
</div>
