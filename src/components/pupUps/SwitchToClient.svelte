<script lang="ts">
    import { createEventDispatcher } from 'svelte';

    // Define the prop type
    export let show: boolean;

    const dispatch = createEventDispatcher();

    function confirm() {
        dispatch('confirm');
        show = false; // Close the popup
    }

    function cancel() {
        dispatch('cancel');
        show = false; // Close the popup
    }
</script>

{#if show}
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-[450px] shadow-lg">
        <h2 class="text-lg text-center">
            You’re About to Switch Your Account As a
        </h2>
        <h2 class="text-lg mb-4 text-center font-bold">Client</h2>
        <p class="text-center mb-6">Do you wish to continue?</p>

        <!-- Buttons -->
        <div class="flex justify-center space-x-20">
            <button on:click={cancel} class="px-10 py-2 border rounded hover:bg-gray-200">Cancel</button>
            <button on:click={confirm} class="px-10 py-2 bg-custom text-white rounded hover:bg-green-800">Proceed</button>
        </div>
    </div>
</div>
{/if}
