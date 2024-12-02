<script lang="ts">
    import backgroundImage from '$lib/assets/landing/BG - LANDING PAGE.png';       
</script>

<main>

<div class="relative flex  items-center justify-center h-screen bg-cover bg-center" style="background-image: url({backgroundImage}); background-size: cover;">
 <div class= "text-center">
   <div>
    <h1 class = " text-white font-matiott text-[100px] max-w-5xl flex mt-[50] text-wrap">Explore the Gallery</h1>
   </div> 
    <div class="space-x-4 text-center">
        <button  class="font-montserratt px-6 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800">
            <a href="/signup">Sign Up</a>
        </button>

        <button  class="font-montserratt px-6 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800">
            <a href="/login">Login</a>
        </button>
    </div>
    <p class="text-[14px] text-white mt-10 font-montserratt">Start your journey by exploring the world of creatives</p>
 </div>
</main>
