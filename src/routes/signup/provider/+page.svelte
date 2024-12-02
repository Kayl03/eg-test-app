<script lang="ts">

    import backgroundImage from '$lib/assets/signup/bg-green.png';
	import Navbar from '../../../components/Navbar.svelte';
</script>


<main class="relative min-h-screen bg-cover  " style="background-image: url({backgroundImage}); background-size: cover; ">
    <Navbar/>

    <!-- container -->
    <div class="flex flex-col md:flex-row w-full max-w-4xl mx-auto h-auto shadow-lg rounded-lg overflow-hidden mt-10 mb-10">
        <!-- right card -->
        <div class="w-full md:w-1/2 bg-gray-700 text-white p-8 flex flex-col justify-center text-center relative order-1 md:order-2">
            <!-- close button -->
            <a href="/signup" class="absolute top-4 right-4 text-gray-300 text-4xl hover:text-gray-100 font-montserratt">
                &times;
            </a>
            <p class="text-lg font-montserratt">SERVICE</p>
            <h3 class="text-4xl md:text-5xl lg:text-7xl font-matiott">PROVIDER</h3>
            <p class="text-lg font-montserratt">REGISTRATION</p>
        </div>

        <!-- left card-->
        <div class="w-full md:w-1/2 bg-white p-8 flex flex-col relative order-2 md:order-1">
            <h3 class="text-xl md:text-2xl font-montserratt text-center">Register Your Account</h3>
            <p class="text-sm font-montserratt mb-4 text-gray-700 text-center">Let's get started</p>
            
            <!-- refistration form -->
            <form class="space-y-4 font-montserratt">
                <div>
                    <label class="block text-gray-700">First Name</label>
                    <input type="prof-fname" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-200" />
                </div>
                <div>
                    <label class="block text-gray-700">Last Name</label>
                    <input type="prof-lname" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-200" />
                </div>
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="prof-email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-200" />
                </div>
                <div>
                    <label class="block text-gray-700">Birthday</label>
                    <input type="prof-bday" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-200" />
                </div>
                <div>
                    <label class="block text-gray-700">Password</label>
                    <input type="prof-password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-200" />
                </div>
                <div>
                    <label class="block text-gray-700">Confirm Password</label>
                    <input type="prof-rpassword" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-200" />
                </div>

                <!-- signup button -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-gray-700 text-white p-3 rounded-lg w-4/12 max-w-xs font-montserratt">SIGN UP</button>
                </div>
            </form>
        </div>
    </div>
</main>
