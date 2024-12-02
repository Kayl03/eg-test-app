<script lang="ts">
    export let show = false;
    export let onCancel: () => void;
    export let onProceed: () => void;

    let selectedService1 = '';
    let selectedService2 = '';
    let portfolioImages: File[] = [];
    let showConfirmation = false; // For the second popup

    function handleFileUpload(event: Event) {
        const input = event.target as HTMLInputElement;
        if (input.files) {
            portfolioImages = Array.from(input.files);
        }
    }

    function handleProceed() {
        // Hide the first popup and show the confirmation popup
        show = false;
        showConfirmation = true;
    }

    function handleConfirmProceed() {
        // Proceed with the original action
        showConfirmation = false;
        onProceed();
    }

    function handleConfirmCancel() {
        // Close the confirmation popup and show the first popup again
        showConfirmation = false;
        show = true;
    }
</script>

{#if show}
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-[500px] shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-center">Be A Service Provider!</h2>

            <!-- Service Offered 1 -->
            <div class="flex items-center justify-between mb-3">
                <label class="text-sm font-medium w-1/3">Service Offered: </label>
                <select bind:value={selectedService1} class="border p-1 rounded w-2/3">
                    <option value="" disabled selected>Select Service</option>
                    <option value="service1">Service 1</option>
                    <option value="service2">Service 2</option>
                    <option value="service3">Service 3</option>
                </select>
            </div>

            <!-- Service Offered 2 -->
            <div class="flex items-center justify-between mb-3">
                <label class="text-sm font-medium w-1/3">Service Offered: </label>
                <select bind:value={selectedService2} class="border p-1 rounded w-2/3">
                    <option value="" disabled selected>Select Service</option>
                    <option value="service1">Service 1</option>
                    <option value="service2">Service 2</option>
                    <option value="service3">Service 3</option>
                </select>
            </div>

            <!-- Portfolio Upload -->
            <div class="flex items-center justify-between mb-4">
                <label class="text-sm font-medium w-1/3">Portfolio Upload</label>
                <div class="flex items-center w-2/3">
                    <input type="file" multiple accept="image/*" on:change={handleFileUpload} class="hidden" id="fileUpload">
                    <label for="fileUpload" class="text-xs cursor-pointer bg-custom text-white px-7 py-2 rounded hover:bg-green-800 mr-2">
                        Upload Image
                    </label>
                    <p class="text-xs text-gray-500">Upload at least 2 images</p>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center space-x-20 mt-10">
                <button on:click={onCancel} class="px-10 py-2 border rounded hover:bg-gray-200">Cancel</button>
                <button on:click={handleProceed} class="px-10 py-2 bg-custom text-white rounded hover:bg-green-800">Proceed</button>
            </div>
        </div>
    </div>
{/if}

{#if showConfirmation}
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-[450px] shadow-lg">
            <h2 class="text-lg text-center">
                You’re About to Switch Your Account As a
            </h2>
            <h2 class="text-lg mb-4 text-center font-bold">Service Provider</h2>
            <p class="text-center mb-6">Do you wish to continue?</p>

            <!-- Buttons -->
            <div class="flex justify-center space-x-20">
                <button on:click={handleConfirmCancel} class="px-10 py-2 border rounded hover:bg-gray-200">Cancel</button>
                <button on:click={handleConfirmProceed} class="px-10 py-2 bg-custom text-white rounded hover:bg-green-800">Proceed</button>
            </div>
        </div>
    </div>
{/if}
