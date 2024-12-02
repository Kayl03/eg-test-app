<script lang="ts">
    import SettingsGeneral from "../../../components/cards/settings/SettingsGeneral.svelte";
    import HomepageNavbar from "../../../components/HomepageNavbar.svelte";
</script>

<HomepageNavbar />

<main class="font-montserratt bg-gray-200 flex flex-col lg:flex-row lg:h-[850px]">
    <!-- side bar aside -->
    <SettingsGeneral />

    <!-- main content -->
    <div class="flex-1 p-4">
        <!-- header -->
        <header class="mb-4">
            <div class="flex flex-col space-y-2 mb-4">
                <h2 class="text-2xl font-bold text-custom">ADDRESS</h2>
                <p class="text-sm text-gray-600">Manage your address</p>
                <hr class="border-gray-300 mt-2">
            </div>
        </header>
        
        <!-- Address management content goes here -->
        <div class="p-4">
            <form>
                <!-- Row for Street and City -->
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                        <input type="text" id="street" class="mt-1 block w-full border border-gray-300 rounded-full p-3" placeholder="123 Main St" required />
                    </div>
                    <div class="flex-1">
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" id="city" class="mt-1 block w-full border border-gray-300 rounded-full p-3" placeholder="City Name" required />
                    </div>
                </div>
                <!-- Row for State and ZIP Code -->
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" id="state" class="mt-1 block w-full border border-gray-300 rounded-full p-3" placeholder="State" required />
                    </div>
                    <div class="flex-1">
                        <label for="zip" class="block text-sm font-medium text-gray-700">ZIP Code</label>
                        <input type="text" id="zip" class="mt-1 block w-35 border border-gray-300 rounded-full p-3" placeholder="3500" required />
                    </div>
                </div>
                <div class="flex ">
                    <button type="submit" class="bg-custom text-white py-2 px-4 rounded-full hover:bg-green-800">Save Address</button>
                </div>
            </form>
        </div>
    </div>
</main>
