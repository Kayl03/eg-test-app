
<script lang="ts">
    import backgroundImage from '$lib/assets/login/BG 2 - GREEN.png';
    import fbIcon from '$lib/assets/login/FB Icon.png';
    import googleIcon from '$lib/assets/login/Google Icon.png';

    import { goto } from '$app/navigation';
    

    let email = '';
    let password = '';
    let errorMessage = '';

    async function handleLogin(event: Event) {
        event.preventDefault(); 

        const loginData = {
            email: email,
            password: password
        };

        try {
            const response = await fetch('http://localhost/my-php-backend/Login.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
        },
            body: JSON.stringify(loginData)
        });

            const result = await response.json();

            if (response.ok && result.redirect) {
                // Redirect 
                goto(result.redirect);
            } else {
                errorMessage = result.error || "Login failed. Please try again.";
            }
        } catch (error) {
            errorMessage = "Failed to connect to the server.";
            console.error(error);
        }
    }

    
    let menuOpen = false;
</script>

<main>

    <div class="absolute top-0 left-0 p-7 flex items-center justify-between  z-20">

        <!-- menu icon -->
        <div class="lg:hidden">
            <button class="text-white focus:outline-none" on:click={() => menuOpen = !menuOpen}>
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d={menuOpen ? "M6 18L18 6M6 6l12 12" : "M4 6h16M4 12h16m-7 6h7"}></path>
                </svg>
            </button>
        </div>
    
        <!-- navigation links -->
        <div class={`lg:flex space-x-6 text-white font-montseratt ${menuOpen ? 'flex' : 'hidden'} lg:flex flex-col lg:flex-row absolute lg:relative top-full left-0 bg-gray-800 lg:bg-transparent w-90 p-9 lg:p-0 z-30`}>
            <a class="hover:underline cursor-pointer" href="#">EXPLORE</a>
            <a class="hover:underline cursor-pointer" href="#">CONTACT US</a>
            <a class="hover:underline cursor-pointer" href="#">TALENT BUILDER</a>
            
        </div>
    
    </div>

    <!-- background -->
    <div class="relative flex justify-center h-screen bg-cover" style="background-image: url({backgroundImage}); background-size: cover;">

        <!-- smal title -->
        <div class="absolute top-0 w-full text-center mt-7 z-10">
            <h2 class="text-white text-3xl font-matiott">EL GALERIA</h2>
        </div>

        <!-- main content -->
        <div class="flex flex-col lg:flex-row justify-center items-center w-full px-10 mt-16 lg:mt-0">

            <!-- big title and tagline -->
            <div class="text-white text-center lg:text-left mb-10 lg:mb-0 lg:mr-16">
                <h1 class="text-5xl lg:text-9xl mb-4 font-matiott">EL GALERIA</h1>
                <p class="text-xl lg:ml-[350px] font-montseratt">CREATIVITY AT YOUR FINGERS.</p>
            </div>

            <!-- sign in form -->
            <div class="bg-gray-700 p-8 rounded-lg shadow-lg w-full max-w-md font-montseratt z-10">
                <h2 class="text-white text-3xl text-center mb-1">Sign in to Account</h2>
                <p class="text-white mb-6 text-[13px] text-center">Enter your credential to login</p>
                <form on:submit={handleLogin} class="space-y-4">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" bind:value={email} class="w-full p-3 border rounded-lg" required />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" bind:value={password} class="w-full p-3 border rounded-lg" required />
                    </div>
                    {#if errorMessage}
                        <p class="text-red-500">{errorMessage}</p>
                    {/if}
                    <div class="text-center">
                        <button type="submit" class="border border-white text-white p-3 rounded-lg">LOGIN</button>
                    </div>
                </form>
                <div class="flex items-center justify-center mb-4">
                    <div class="border-t border-gray-300 w-1/3"></div>
                    <p class="mx-2 text-gray-500">Or</p>
                    <div class="border-t border-gray-300 w-1/3"></div>
                </div>
                <div class="flex justify-center space-x-4 mb-4">
                    <a href="https://www.facebook.com/"><img src={fbIcon} alt="Facebook" class="w-8 h-8 cursor-pointer" /></a>
                    <a href="https://accounts.google.com/"><img src={googleIcon} alt="Google" class="w-8 h-8 cursor-pointer" /></a>
                </div>
                <a class="flex justify-center text-gray-400 hover:underline cursor-pointer hover:text-white" href="/signup/client">Create an account?</a>
            </div>

        </div>
    </div> 
</main>
