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
        <header class="mb-10">
            <div class="flex flex-col space-y-2 mb-4">
                <h2 class="text-2xl font-bold text-custom">CUSTOMER SUPPORT</h2>
                <p class="text-sm text-gray-600">Get in touch with us. We’d love to hear from you.</p>
                <hr class="border-gray-300 mt-2">
            </div>
        </header>

        <!-- Contact form section -->
        <section class="">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" class="mt-1 block w-full max-w-lg border border-gray-300 rounded-full p-3" placeholder="Your Name" required />
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" class="mt-1 block w-full max-w-lg border border-gray-300 rounded-full p-3" placeholder="Your Email" required />
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" placeholder="Your Message" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-custom text-white py-2 px-4 rounded-full hover:bg-green-800">Send Message</button>
                </div>
            </form>
        </section>
    </div>
</main>
