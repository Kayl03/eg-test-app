<script lang="ts">
    import SettingsGeneral from "../../../components/cards/settings/SettingsGeneral.svelte";
    import HomepageNavbar from "../../../components/HomepageNavbar.svelte";
</script>

<HomepageNavbar />

<main class="font-montserratt bg-gray-200 flex flex-col lg:flex-row lg:h-[850px]">
    <!-- side bar aside -->
    <SettingsGeneral/>

    <!-- main content -->
    <div class="flex-1 p-4">
        <!-- header -->
        <header class="mb-10">
            <div class="flex flex-col space-y-2 mb-4">
                <h2 class="text-2xl font-bold text-custom">DEACTIVATION OR DELETION</h2>
                <p class="text-sm text-gray-600">Manage your account</p>
                <hr class="border-gray-300 mt-2">
            </div>
        </header>

        <!-- section for choices -->
        <section class="grid grid-cols-1 gap-6">
            <!-- deactivation -->
            <div class="bg-white p-6 rounded-lg shadow-md max-w-full lg:max-w-screen-lg">
                <div class="flex items-center mb-4">
                    <input type="radio" id="deactivation" name="account-action" class="form-radio h-5 w-5 text-blue-500" />
                    <label for="deactivation" class="ml-2 text-lg font-medium">DEACTIVATION</label>
                </div>
                <p class="text-gray-600">
                    Before deactivating your account, consider that you'll temporarily suspend your access to El Galeria. Your profile and data will remain intact, allowing you to reactivate your account at any time. During deactivation, your listings and interactions will be hidden, but not permanently deleted.
                </p>
            </div>

            <!-- deletion -->
            <div class="bg-white p-6 rounded-lg shadow-md max-w-full lg:max-w-screen-lg">
                <div class="flex items-center mb-4">
                    <input type="radio" id="deletion" name="account-action" class="form-radio h-5 w-5 text-red-500" />
                    <label for="deletion" class="ml-2 text-lg font-medium">DELETION</label>
                </div>
                <p class="text-gray-600">
                    Before deleting your account, note that this action is irreversible. All your data, including profile information, listings, and interactions, will be permanently removed from El Galeria's system. Once deleted, you won't be able to recover your account or any associated data.
                </p>
            </div>

            <!-- buttons -->
            <div class="flex justify-start space-x-4">
                <button class="bg-custom text-white py-2 px-4 rounded-full hover:bg-green-800">Cancel</button>
                <button class="bg-custom text-white py-2 px-4 rounded-full hover:bg-green-800">Continue</button>
            </div>
        </section>
    </div>
</main>
