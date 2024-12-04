<script>
    import { onMount } from 'svelte';

    export let userId;
    let userData = null;
    let error = null;

    async function fetchUserProfile() {
        try {
            const response = await fetch(`http://localhost/my-php-backend/getProfile.php?userId=${userId}`);
            const result = await response.json();
            
            if (result.success) {
                userData = result.data;
            } else {
                error = result.message;
            }
        } catch (err) {
            error = 'Failed to fetch user profile';
            console.error(err);
        }
    }

    onMount(() => {
        if (userId) {
            fetchUserProfile();
        }
    });
</script>

<div class="client-profile">
    {#if error}
        <div class="error">{error}</div>
    {:else if userData}
        <div class="profile-container">
            <h2>Client Profile</h2>
            <div class="profile-info">
                <div class="info-item">
                    <span class="label">Name:</span>
                    <span class="value">{userData.name}</span>
                </div>
                <div class="info-item">
                    <span class="label">Email:</span>
                    <span class="value">{userData.email}</span>
                </div>
            </div>
        </div>
    {:else}
        <div class="loading">Loading profile...</div>
    {/if}
</div>

<style>
    .client-profile {
        padding: 20px;
        max-width: 600px;
        margin: 0 auto;
    }

    .profile-container {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .profile-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        gap: 10px;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .label {
        font-weight: bold;
        min-width: 80px;
        color: #666;
    }

    .value {
        color: #333;
    }

    .error {
        color: #dc3545;
        padding: 10px;
        border-radius: 4px;
        background: #ffe6e6;
        text-align: center;
    }

    .loading {
        text-align: center;
        color: #666;
        padding: 20px;
    }
</style>
