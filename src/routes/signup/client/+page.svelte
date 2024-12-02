<script lang="ts">

    import backgroundImage from '$lib/assets/signup/bg-green.png';
	import Navbar from '../../../components/Navbar.svelte';
    import { goto } from '$app/navigation'; 
    
    let firstName = '';
    let lastName = '';
    let email = '';
    let birthday = '';
    let password = '';
    let confirmPassword = '';
    let passwordMismatch = false;
    let errorMessage = '';

    // Function to check if passwords match
    function checkPasswords() {
        passwordMismatch = password !== confirmPassword;
    }

    // Async function to handle form submission
    async function handleSubmit(event: Event) {
        event.preventDefault();

        checkPasswords();

        if (passwordMismatch) {
            errorMessage = "Passwords do not match!";
            return;
        }

        const formData = {
            first_name: firstName,
            last_name: lastName,
            email: email,
            birthday: birthday,
            password: password
        };

        try {
            const response = await fetch('http://localhost/my-php-backend/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (response.ok && result.redirect) {
                // Redirect to login page after successful registration
                goto(result.redirect);
            } else {
                errorMessage = result.error || "Failed to register. Try again.";
            }
        } catch (error) {
            errorMessage = "Failed to connect to the server.";
            console.error(error);
        }
    }
</script>


<main class="relative min-h-screen bg-cover  " style="background-image: url({backgroundImage}); background-size: cover; ">
    <Navbar/>


    <!-- container -->
    <div class="flex flex-col md:flex-row w-full max-w-4xl mx-auto h-auto shadow-lg rounded-lg overflow-hidden mt-10 mb-10">
        <!-- left card-->
        <div class="w-full md:w-1/2 bg-gray-700 text-white p-8 flex flex-col justify-center text-center">
            <h3 class="text-4xl md:text-5xl lg:text-8xl font-matiott">CLIENT</h3>
            <p class="text-lg font-montserratt">REGISTRATION</p>
        </div>

        <!-- right card -->
        <div class="w-full md:w-1/2 bg-white p-8 flex flex-col relative">

            <!-- close button -->
            <a href="/signup" class="absolute top-4 right-4 text-gray-700 text-4xl hover:text-gray-900 font-montserratt">
                &times;
            </a>

            <h3 class="text-xl md:text-2xl font-montserratt text-center">Register Your Account</h3>
            <p class="text-sm font-montserratt mb-4 text-gray-700 text-center">Let's get started</p>

            <!-- refistration form -->
            <form on:submit={handleSubmit} class="space-y-4">  <!-- Attach handleSubmit to form -->
                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" id="firstName" bind:value={firstName} required class="w-full p-3 border rounded-lg" />
                </div>
                <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" id="lastName" bind:value={lastName} required class="w-full p-3 border rounded-lg" />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" bind:value={email} required class="w-full p-3 border rounded-lg" />
                </div>
                <div>
                    <label for="birthday">Birthday</label>
                    <input type="date" id="birthday" bind:value={birthday} required class="w-full p-3 border rounded-lg" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" bind:value={password} required class="w-full p-3 border rounded-lg" />
                </div>
                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" bind:value={confirmPassword} required class="w-full p-3 border rounded-lg" />
                </div>
                {#if passwordMismatch}
                    <p class="text-red-500">Passwords do not match.</p>
                {/if}
                {#if errorMessage}
                    <p class="text-red-500">{errorMessage}</p>
                {/if}
                <button type="submit" class="bg-blue-500 text-white p-3 rounded-lg justify-center">Register</button>
            </form>
        </div>

    </div>
</main>
