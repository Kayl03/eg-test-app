<script lang="ts">
  let menuOpen = false;
  import logo from '$lib/assets/navbar/EG LOGO 1 - WHITE.png';
  import settings from '$lib/assets/menu/Settings.png';
  import exit from '$lib/assets/menu/BoxArrowLeft.png';
  import chat from '$lib/assets/menu/Chat.png';
  import ecreate from '$lib/assets/menu/Ecreate.png';
  import profile from '$lib/assets/menu/Profile.png';
</script>

<style>
  .menu-icon {
    margin-right: 8px; 
    flex-shrink: 0; 
  }
  .menu-item {
    display: flex;
    align-items: center;
  }
</style>

<!-- header -->
<div class="top-0 left-0 w-full p-10 bg-gray-600 flex items-center justify-between z-20 border-b-[15px] ">

  <!-- logo -->
  <div class="absolute left-1/2 transform -translate-x-1/2">
    <button><a href="/homepage"> <img src="{logo}" alt="logo" class="h-12"></a></button>
  </div>

  <!-- nav links -->
  <div class="hidden lg:flex lg:absolute lg:top-7 lg:left-5 lg:space-x-6 lg:text-white lg:font-montserratt">
    <a class="hover:underline cursor-pointer" href="#">About us</a>
    <a class="hover:underline cursor-pointer" href="#">Terms and Condition</a>
  </div>

  <!-- menu hamburger -->
  <div class="absolute top-4 right-5">
    <button on:click={() => (menuOpen = !menuOpen)} class="p-2 text-white focus:outline-none">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d={menuOpen ? "M6 18L18 6M6 6l12 12" : "M4 6h16M4 12h16m-7 6h7"}></path>
      </svg>
    </button>

    <!-- menu items -->
    {#if menuOpen}
      <ul class="absolute right-0 mt-2 w-48 bg-custom bg-opacity-20 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
        <li class="px-4 py-2 hover:bg-gray-100 menu-item">
          <a href="/profile/client-profile" class="flex items-center">
            <img src="{profile}" alt="profile" class="menu-icon">
            Profile
          </a>
        </li>
        <li class="px-4 py-2 hover:bg-gray-100 menu-item">
          <a href="/messaging" class="flex items-center">
            <img src="{chat}" alt="chat" class="menu-icon">
            Messaging
          </a>
        </li>
        <li class="px-4 py-2 hover:bg-gray-100 menu-item">
          <a href="/ecreate" class="flex items-center">
            <img src="{ecreate}" alt="ecreate" class="menu-icon">
            E Create
          </a>
        </li>
        <li class="px-4 py-2 hover:bg-gray-100 menu-item">
          <a href="/settings" class="flex items-center">
            <img src="{settings}" alt="settings" class="menu-icon">
            Settings
          </a>
        </li>
        <li class="px-4 py-2 hover:bg-gray-100 menu-item">
          <a href="/login" class="flex items-center">
            <img src="{exit}" alt="logout" class="menu-icon">
            Logout
          </a>
        </li>
      </ul>
    {/if}
  </div>
</div>
