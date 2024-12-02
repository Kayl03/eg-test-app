<script lang="ts">
    let menuOpen = false;
    import logo from '$lib/assets/navbar/EG LOGO 1 - WHITE.png';
</script>

<!-- header -->
<div class="top-0 left-0 w-full p-5 bg-gray-600 flex items-center justify-between z-20 border-b-[15px]">

    <!-- logo -->
    <div class="absolute left-1/2 transform -translate-x-1/2">
        <img src="{logo}" alt="logo" class="h-12">
    </div>

    <!-- tago -->
    <div class="lg:hidden"></div>

    <!-- nav links -->
    <div class={`lg:flex space-x-6 text-white font-montserratt w-48  ${menuOpen ? 'flex' : 'hidden'} lg:flex lg:flex-row flex-col absolute lg:static top-16 right-0 bg-gray-800 lg:bg-transparent w-full p-8 lg:p-0 z-30`}>
        <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
            <a class="hover:underline cursor-pointer py-2" href="#">About us</a>
            <a class="hover:underline cursor-pointer py-2" href="#">Terms and Condition</a>
        </div>
    </div>

    <!-- menu burgir -->
    <div class="lg:hidden">
        <button class="text-white focus:outline-none" on:click={() => menuOpen = !menuOpen}>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d={menuOpen ? "M6 18L18 6M6 6l12 12" : "M4 6h16M4 12h16m-7 6h7"}></path>
            </svg>
        </button>
    </div>
</div>
