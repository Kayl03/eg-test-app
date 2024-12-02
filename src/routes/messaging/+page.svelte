<script lang="ts">
    import HomepageNavbar from "../../components/HomepageNavbar.svelte";
</script>

<main class="font-montserratt ">
    <HomepageNavbar />

    <div class="flex flex-col lg:flex-row ">
        <!-- aside -->
        <aside class="w-full lg:w-1/4 p-8 flex flex-col space-y-4 border-r border-gray-300 lg:block hidden">
            <!-- arrow -->
            <div class="flex items-center mb-4">

                <a href="/homepage">
                    <button class="p-2">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                </a>
                <div class="flex-1 mr-12 text-center">
                    <div class="text-lg font-semibold text-green-800">CHAT</div>
                </div>
            </div>

            <!-- search bar -->
            <div class="flex items-center space-x-2 mb-4">
                <input type="text" placeholder="Search messages here..." class="flex-1 p-2 border border-gray-300 rounded-full ps-6 focus:outline-none focus:ring-2 focus:ring-green-800">
                <button class="p-2 bg-green-800 text-white rounded-full">
                    
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                      </svg>
                      
                </button>
            </div>

            <!-- pinned messages -->
            
            <div class="overflow-y-auto">
                <div class="font-bold text-gray-700 mb-4 text-center text-green-800">PINNED MESSAGES</div>
                <div class="space-y-2">
                    <div class="flex items-center p-2 rounded hover:bg-gray-200 active:bg-gray-300 transition-colors">
                        
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354V16.65m0 0L15.793 12m-3.793 4.65L8.207 12" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Van Pogi</div>
                            <div class="text-gray-600">okay see ya.</div>
                        </div>
                        <div class="text-gray-500 text-sm ml-4">2:45 PM</div>
                        <div class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center p-2 rounded hover:bg-gray-200 active:bg-gray-300 transition-colors">
                        
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354V16.65m0 0L15.793 12m-3.793 4.65L8.207 12" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Kyle Umbrero</div>
                            <div class="text-gray-600">Yes, that's gonna work, hopefully.</div>
                        </div>
                        <div class="text-gray-500 text-sm ml-4">1:30 PM</div>
                        <div class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <!-- chats  -->
            <div class="flex-1 overflow-y-auto">
                <div class="font-bold text-gray-700 mb-4 text-center text-green-800">ALL MESSAGES</div>
                <div class="space-y-2">
                    <div class="flex items-center p-2 rounded hover:bg-gray-200 active:bg-gray-300 transition-colors">
                        
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354V16.65m0 0L15.793 12m-3.793 4.65L8.207 12" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Van Pogi</div>
                            <div class="text-gray-600">okay see ya.</div>
                        </div>
                        <div class="text-gray-500 text-sm ml-4">2:45 PM</div>
                        <div class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center p-2 rounded hover:bg-gray-200 active:bg-gray-300 transition-colors">
                        
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354V16.65m0 0L15.793 12m-3.793 4.65L8.207 12" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Calvin Caguin</div>
                            <div class="text-gray-600">Please take a look at the images.</div>
                        </div>
                        <div class="text-gray-500 text-sm ml-4">12:15 PM</div>
                        <div class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center p-2 rounded hover:bg-gray-200 active:bg-gray-300 transition-colors">
                        
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354V16.65m0 0L15.793 12m-3.793 4.65L8.207 12" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Darren Dela Cruz</div>
                            <div class="text-gray-600">What you said is such a good idea</div>
                        </div>
                        <div class="text-gray-500 text-sm ml-4">12:15 PM</div>
                        <div class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center p-2 rounded hover:bg-gray-200 active:bg-gray-300 transition-colors">
                        
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354V16.65m0 0L15.793 12m-3.793 4.65L8.207 12" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold">Kyle Umbrero</div>
                            <div class="text-gray-600">Yes, that's gonna work, hopefully.</div>
                        </div>
                        <div class="text-gray-500 text-sm ml-4">12:15 PM</div>
                        <div class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- main convo -->
        <section class="w-full lg:w-3/4 p-8 flex flex-col h-screen">
            <!-- header -->
            <div class="flex justify-between items-center border-b border-gray-300 pb-4 mb-4">
                <div class="text-lg font-semibold text-green-800">Van Pogi</div>
                <div class="flex space-x-4">
                    <!-- more options -->
                    <button class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="5" d="M5 12h.01M12 12h.01M19 12h.01" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- convo messages -->
            <div class="flex-grow overflow-y-auto">
                <div class="text-center mb-4">
                    <div class="text-gray-600 text-sm">September 18, 2024</div>
                </div>

                <!-- messages container -->
                <div class="space-y-4">
                    <!-- sent message -->
                    <div class="flex justify-end">
                        <div class="bg-green-800 text-white p-4 rounded-lg max-w-xs">
                            Hi sir! I'd like to book an appointment for makeup on my wedding.
                        </div>
                    </div>

                    <!-- received message -->
                    <div class="flex justify-start">
                        <div class="bg-gray-200 p-4 rounded-lg max-w-xs">
                            Hello, can you tell me the details like when and where?
                        </div>
                    </div>

                    <!-- sent message -->
                    <div class="flex justify-end">
                        <div class="bg-green-800 text-white p-4 rounded-lg max-w-xs">
                            August 6 in the morning, Caritan Centro Tuguegarao.
                        </div>
                    </div>

                    <!-- received message -->
                    <div class="flex justify-start">
                        <div class="bg-gray-200 p-4 rounded-lg max-w-xs">
                            Let me just check my schedule.
                        </div>
                    </div>

                    <!-- received message -->
                    <div class="flex justify-start">
                        <div class="bg-gray-200 p-4 rounded-lg max-w-xs">
                            Can we meet up to talk about further details?
                        </div>
                    </div>

                    <!-- received message -->
                    <div class="flex justify-end pb-12">
                        <div class="bg-green-800 text-white p-4 rounded-lg max-w-xs">
                            Okay, see ya.
                        </div>
                    </div>
                </div>
            </div>

            <!-- message input -->
            <div class="sticky bottom-0 bg-white py-4 flex items-center border-t border-gray-300">
                <!-- icons  -->
                <div class="flex space-x-4 mr-4">
                    <!-- camera -->
                    <button class="p-2">
                        <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M7.5 4.586A2 2 0 0 1 8.914 4h6.172a2 2 0 0 1 1.414.586L17.914 6H19a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1.086L7.5 4.586ZM10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm2-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <!-- sound record -->
                    <button class="p-2">
                        <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 8a1 1 0 0 1 1 1v3a4.006 4.006 0 0 0 4 4h4a4.006 4.006 0 0 0 4-4V9a1 1 0 1 1 2 0v3.001A6.006 6.006 0 0 1 14.001 18H13v2h2a1 1 0 1 1 0 2H9a1 1 0 1 1 0-2h2v-2H9.999A6.006 6.006 0 0 1 4 12.001V9a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                            <path d="M7 6a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v5a4 4 0 0 1-4 4h-2a4 4 0 0 1-4-4V6Z"/>
                        </svg>
                    </button>
                    <!-- files -->
                    <button class="p-2">
                        <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 .087.586l2.977-7.937A1 1 0 0 1 6 10h12V9a2 2 0 0 0-2-2h-4.532l-1.9-2.28A2 2 0 0 0 8.032 4H4Zm2.693 8H6.5l-3 8H18l3-8H6.693Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>

                <!-- message input field -->
                <input type="text" placeholder="Type your message..." class="flex-1 p-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-800">

                <!-- send -->
                <button class="p-2 ml-4 bg-green-800 text-white rounded-full">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"/>
                    </svg>
                </button>
            </div>
        </section>

    </div>
</main>
