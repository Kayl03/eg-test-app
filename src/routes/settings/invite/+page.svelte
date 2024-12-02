<script lang="ts">
    import HomepageNavbar from "../../../components/HomepageNavbar.svelte";
    import Qr from '$lib/assets/settings/qr.png';
    import SettingsGeneral from "../../../components/cards/settings/SettingsGeneral.svelte";
</script>

<HomepageNavbar />

<main class="font-montserratt bg-gray-200 flex flex-col lg:flex-row lg:h-[850px]">
    <!-- side bar aside -->
    <SettingsGeneral />

    <!-- main content -->
    <div class="flex-1 p-4">
        <!-- header -->
        <header class="mb-10">
            <div class="flex flex-col space-y-2 mb-4">
                <h2 class="text-2xl font-bold text-custom">INVITE A FRIEND</h2>
                <p class="text-sm text-gray-600">Share and Connect for a greater Galeria Community!</p>
                <hr class="border-gray-300 mt-2">
            </div>
        </header>

        <!-- section for qr and others -->
        <section class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6">
            <!-- qr -->
            <div class="bg-white w-full lg:w-[285px] rounded-lg shadow-md flex flex-col items-center p-4">
                <img src={Qr} alt="QR Code" class="w-full h-auto mb-4" />
                <p class="text-center text-gray-700 font-semibold">Scan QR</p>
            </div>

            <!-- link and copy button -->
            <div class="flex-1 p-4 bg-white rounded-lg shadow-md flex flex-col">
                <div class="mb-4">
                    <input type="text" value="https://www.figma.com/design/aoRM7IbPo6Z7bqzLUu4ejT/EL-GALERIA?node-id=423-1367&t=rCWBtAoqNA4ceEJG-0"
                        class="w-full p-2 border border-gray-300 rounded" readonly />
                </div>
                <div class="flex flex-col space-y-4">
                    <p class="text-gray-600">Copy and Share the link to invite them to be a part of our Community.</p>
                    <button class="bg-custom text-white py-2 rounded-full hover:bg-green-800">COPY LINK</button>
                </div>
            </div>
        </section>
    </div>
</main>
