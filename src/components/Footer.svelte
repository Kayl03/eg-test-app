<script lang="ts">
    import mail from '$lib/assets/footer/Mail.png';
    import telephone from '$lib/assets/footer/Telephone.png';
    import fb from '$lib/assets/footer/Facebook.png';
    import twitter from '$lib/assets/footer/Twitter.png';
    import ig from '$lib/assets/footer/Instagram.png';
</script>

<footer class="bg-gray-600 text-white font-montserratt p-6">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start">
            <!-- first column -->
            <div class="flex flex-col mb-6 md:mb-0">
                <h5 class="font-matiott text-4xl">El Galeria</h5>
                <p>Browse. Create. Hire.</p>
            </div>

            <!-- second column -->
            <div class="flex flex-col mb-6 md:mb-0">
                <h2 class="text-lg font-bold mb-2">For More Inquiries Contact Us Here:</h2>
                <div class="flex items-center mb-2">
                    <img src="{mail}" alt="mail-icon" class="w-6 h-6 mr-2"> elgaleria@gmail.com
                </div>
                <div class="flex items-center">
                    <img src="{telephone}" alt="telephone-icon" class="w-6 h-6 mr-2"> +690000000000
                </div>
            </div>

            <!-- third column -->
            <div class="flex flex-col items-start">
                <h2 class="text-lg font-bold mb-2">Follow Us:</h2>
                <div class="flex flex-col space-y-2">
                    <a href="https://www.facebook.com/" class="flex items-center">
                        <img src="{fb}" alt="fb-icon" class="w-6 h-6 mr-2"> LaGalerie
                    </a>
                    <a href="https://twitter.com/" class="flex items-center">
                        <img src="{twitter}" alt="twitter-icon" class="w-6 h-6 mr-2"> LaGalerie
                    </a>
                    <a href="https://www.instagram.com/" class="flex items-center">
                        <img src="{ig}" alt="ig-icon" class="w-6 h-6 mr-2"> LaGalerie
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
