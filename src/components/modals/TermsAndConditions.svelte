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
            <h2 class="text-2xl font-bold text-gray-800">Terms and Conditions</h2>
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
            <div class="space-y-4">
                <h3 class="text-xl font-semibold">1. Introduction</h3>
                <p class="text-gray-600">Welcome to Galeria. By accessing or using our service, you agree to be bound by these terms and conditions.</p>

                <h3 class="text-xl font-semibold">2. User Accounts</h3>
                <p class="text-gray-600">Users must maintain accurate, complete, and up-to-date account information. Users are responsible for safeguarding their account credentials.</p>

                <h3 class="text-xl font-semibold">3. Service Usage</h3>
                <p class="text-gray-600">Our service connects clients with service providers. Users agree to use the service in good faith and in compliance with all applicable laws.</p>

                <h3 class="text-xl font-semibold">4. Privacy</h3>
                <p class="text-gray-600">We collect and process personal information as described in our Privacy Policy. By using our service, you consent to such processing.</p>

                <h3 class="text-xl font-semibold">5. Content</h3>
                <p class="text-gray-600">Users are responsible for any content they post or share through our service. Content must not violate any laws or infringe on others' rights.</p>

                <h3 class="text-xl font-semibold">6. Service Providers</h3>
                <p class="text-gray-600">Service providers must maintain professional standards, provide accurate information about their services, and fulfill their commitments to clients.</p>

                <h3 class="text-xl font-semibold">7. Termination</h3>
                <p class="text-gray-600">We reserve the right to terminate or suspend accounts that violate these terms or for any other reason at our discretion.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="border-t p-6 flex justify-end">
            <button
                on:click={closeModal}
                class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50"
            >
                Close
            </button>
        </div>
    </div>
</div>
{/if}
