<script lang="ts">
	import Navbar from '../../components/Navbar.svelte';
    import backgroundImage from '$lib/assets/signup/bg-green.png';
    import clientIcon from '$lib/assets/signup/client icon.png';
    import providerIcon from '$lib/assets/signup/provider icon.png';
</script>

<main class="relative min-h-screen bg-cover" style="background-image: url({backgroundImage}); background-size: cover;">
    <Navbar/>

    <!-- acc type -->
    <div class="flex flex-col items-center justify-center min-h-[85vh] text-white text-center z-10 font-montserratt p-4">
        <div class="mb-8 mt-[-20px]">
            <h3 class="text-4xl sm:text-5xl mb-1">Account Type</h3> 
            <p class="text-sm sm:text-m">Choose from the actions below:</p>
        </div>

        <!-- cards sec -->
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-10 justify-center items-center mt-[-10px]"> 
            <!-- client -->
            <a href="/signup/client" class="p-4 sm:p-8 rounded-lg shadow-lg w-full sm:max-w-sm h-56 sm:h-72 relative text-center transition ease-in-out delay-150 bg-white hover:-translate-y-1 hover:scale-105 hover:bg-gray-300 duration-300">
                <div class="flex flex-col justify-center items-center h-full">
                    <img src="{clientIcon}" alt="Clients" class="w-10 sm:w-14 h-10 sm:h-14 mb-3 sm:mb-6" />
                    <p class="text-xs sm:text-sm font-montserratt mb-1 sm:mb-3 text-gray-700">Pick and Book Clients</p>
                </div>
                <!-- client gray -->
                <div class="absolute bottom-0 left-0 w-full bg-gray-700 text-white py-1 sm:py-2 rounded-b-lg">
                    <p class="text-xs sm:text-base font-montserratt">CLIENT</p>
                </div>
            </a>
        
            <!-- prof card -->
            <a href="/signup/provider" class="p-4 sm:p-8 rounded-lg shadow-lg w-full sm:max-w-sm h-56 sm:h-72 relative text-center transition ease-in-out delay-150 bg-white hover:-translate-y-1 hover:scale-105 hover:bg-gray-300 duration-300">
                <div class="flex flex-col justify-center items-center h-full">
                    <img src="{providerIcon}" alt="Service Providers" class="w-10 sm:w-14 h-10 sm:h-14 mb-3 sm:mb-6" />
                    <p class="text-xs sm:text-sm font-montserratt mb-1 sm:mb-3 text-gray-700">Showcase Your Portfolio</p>
                </div>
                <!-- prof gray -->
                <div class="absolute bottom-0 left-0 w-full bg-gray-700 text-white py-1 sm:py-2 rounded-b-lg">
                    <p class="text-xs sm:text-base font-montserratt">SERVICE PROVIDER</p>
                </div>
            </a>
        </div>

    </div>
    
</main>
