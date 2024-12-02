<script lang="ts">
    import ProviderProfile from "../../../components/cards/provider/ProviderProfile.svelte";
    import HomepageNavbar from "../../../components/HomepageNavbar.svelte";
    import pic1 from '$lib/assets/profile/dutch.png';
    import pic2 from '$lib/assets/profile/calvin.png';
    import pic3 from '$lib/assets/profile/darren.png';
    import pic4 from '$lib/assets/profile/kyle.png';
    import Profile1 from '$lib/assets/profile/emma.png';
    import Profile2 from '$lib/assets/profile/calvin.png';
    import Profile3 from '$lib/assets/profile/darren.png';
    import Profile4 from '$lib/assets/profile/kyle.png';
</script>

<HomepageNavbar />

<main class="bg-gray-200">
    <div class="font-montserratt max-w-[1300px] mx-auto flex flex-col md:flex-row gap-10 ">
        <!-- provider profile -->
        <div class="flex justify-center md:justify-start w-full md:w-auto">
            <ProviderProfile />
        </div>

        <!-- gallery box -->
        <div class="flex flex-col gap-6 w-full md:w-2/3 mt-10">
            <!-- first card with pics -->
            <div class="box-border border-2 bg-white p-5 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-lg text-custom">Gallery</h2>
                    <button class="hover:underline text-sm">Edit</button>
                </div>

                <!-- gallery container -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="{pic1}" alt="Gallery Image 1" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="{pic2}" alt="Gallery Image 2" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="{pic3}" alt="Gallery Image 3" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="{pic4}" alt="Gallery Image 4" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="https://via.placeholder.com/80" alt="Gallery Image 5" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="https://via.placeholder.com/80" alt="Gallery Image 6" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="https://via.placeholder.com/80" alt="Gallery Image 7" class="w-full h-full object-cover" />
                    </div>
                    <div class="w-full h-[200px] overflow-hidden rounded-md shadow-md">
                        <img src="https://via.placeholder.com/80" alt="Gallery Image 8" class="w-full h-full object-cover" />
                    </div>
                </div>
            </div>
            <!-- second card feedback -->
            <div class="box-border border-2 bg-white p-5 rounded-lg">
                <h2 class="font-semibold text-lg mb-4 text-custom">Feedback</h2>
                <div class="space-y-4">
                    <!-- feedback 1 -->
                    <div class="p-3 bg-gray-100 rounded-md">
                        <p class="text-sm text-gray-700">"Great service! Very satisfied with the professionalism."</p>
                        <span class="text-xs text-gray-500">- Emma Llamas</span>
                    </div>

                    <!-- feedback 2 -->
                    <div class="p-3 bg-gray-100 rounded-md">
                        <p class="text-sm text-gray-700">"Highly recommended! Will definitely book back again."</p>
                        <span class="text-xs text-gray-500">- Dutch the Cat</span>
                    </div>
                </div>
            </div>

            <!-- My Team box main section -->
            <div class="flex flex-col w-full">
                <!-- my team box -->
                <div class="w-full bg-white border-2 p-5">
                    <h1 class="font-bold text-2xl mb-4 text-custom">My Team</h1>
                    <div class="flex flex-col md:flex-row justify-between gap-4">

                        <!-- Team 1 Box -->
                        <div class="w-full md:w-[49%] h-auto md:h-[850px] bg-white border border-gray-300 p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-lg text-custom">Wedding</h3>
                                <button class="text-sm text-green-800 px-3 py-1 rounded hover:underline">Edit</button>
                            </div>

                            <!-- dp and name -->
                            <div class="flex flex-col gap-8">
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] overflow-hidden rounded-full flex-shrink-0 border-2 border-custom">
                                        <img src="{Profile1}" alt="Emma Llamas" class="w-full h-full object-cover" />
                                    </div>
                                    <span class="ml-4">Emma Llamas</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] overflow-hidden rounded-full flex-shrink-0 border-2 border-custom">
                                        <img src="{Profile2}" alt="Calvin Caguin" class="w-full h-full object-cover" />
                                    </div>
                                    <span class="ml-4">Calvin Caguin</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] overflow-hidden rounded-full flex-shrink-0 border-2 border-custom">
                                        <img src="{Profile3}" alt="Darren Dela Cruz" class="w-full h-full object-cover" />
                                    </div>
                                    <span class="ml-4">Darren Dela Cruz</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] overflow-hidden rounded-full flex-shrink-0 border-2 border-custom">
                                        <img src="{Profile4}" alt="Kyle Umbrero" class="w-full h-full object-cover" />
                                    </div>
                                    <span class="ml-4">Kyle Umbrero</span>
                                </div>
                            </div>
                        </div>

                        <!-- Team 2 Box -->
                        <div class="w-full md:w-[49%] h-auto md:h-[850px] bg-white border border-gray-300 p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-lg text-custom">Team 2</h3>
                                <button class="text-sm text-green-800 px-3 py-1 rounded hover:underline">Edit</button>
                            </div>

                            <!-- dp and name empty -->
                            <div class="flex flex-col gap-8">
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] bg-gray-400 rounded-full flex-shrink-0"></div>
                                    <span class="ml-4">Empty</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] bg-gray-400 rounded-full flex-shrink-0"></div>
                                    <span class="ml-4">Empty</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] bg-gray-400 rounded-full flex-shrink-0"></div>
                                    <span class="ml-4">Empty</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-[70px] h-[70px] bg-gray-400 rounded-full flex-shrink-0"></div>
                                    <span class="ml-4">Empty</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
