<script>
    export let showModal = false;
    
    function closeModal() {
        showModal = false;
    }
</script>

{#if showModal}
<div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[80vh] flex flex-col relative">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">About El Galeria</h2>
            <button 
                on:click={closeModal}
                class="text-gray-500 hover:text-gray-700 focus:outline-none"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-6 overflow-y-auto">
            <div class="space-y-6">
                <section class="space-y-3">
                    <h3 class="text-xl font-semibold text-green-800">Our Vision</h3>
                    <p class="text-gray-600">
                        El Galeria aims to be the premier platform connecting talented service providers with clients seeking exceptional creative services. We envision a world where creative professionals can easily showcase their work and where clients can find the perfect talent for their needs.
                    </p>
                </section>

                <section class="space-y-3">
                    <h3 class="text-xl font-semibold text-green-800">Our Mission</h3>
                    <p class="text-gray-600">
                        To provide a seamless, user-friendly platform that empowers creative professionals and enables clients to discover, connect with, and hire top talent in various creative fields.
                    </p>
                </section>

                <section class="space-y-3">
                    <h3 class="text-xl font-semibold text-green-800">What We Offer</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Professional Photography and Videography Services</li>
                        <li>Music and Audio Production</li>
                        <li>Professional Makeup Artists</li>
                        <li>Graphics and Design Services</li>
                        <li>Formal Wear (Gowns and Suits)</li>
                        <li>Event Lighting Solutions</li>
                        <li>Entertainment Services</li>
                        <li>Catering Services</li>
                    </ul>
                </section>

                <section class="space-y-3">
                    <h3 class="text-xl font-semibold text-green-800">Why Choose Us</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Curated Selection of Professional Service Providers</li>
                        <li>Secure and Easy-to-Use Platform</li>
                        <li>Direct Communication with Service Providers</li>
                        <li>Transparent Pricing and Reviews</li>
                        <li>Quality Assurance and Support</li>
                    </ul>
                </section>

                <section class="space-y-3">
                    <h3 class="text-xl font-semibold text-green-800">Contact Us</h3>
                    <p class="text-gray-600">
                        Have questions or need assistance? We're here to help!<br>
                        Email: support@elgaleria.com<br>
                        Phone: (123) 456-7890<br>
                        Hours: Monday - Friday, 9:00 AM - 6:00 PM
                    </p>
                </section>
            </div>
        </div>

        <!-- Footer -->
        <div class="border-t p-6 flex justify-end">
            <button
                on:click={closeModal}
                class="px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700 focus:outline-none"
            >
                Close
            </button>
        </div>
    </div>
</div>
{/if}
