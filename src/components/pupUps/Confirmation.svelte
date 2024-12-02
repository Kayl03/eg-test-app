<script lang="ts">
    export let message: string = "Are you sure you want to make these changes?";
    export let onConfirm: () => void;
    export let onCancel: () => void;
    export let showSuccessMessage: boolean = false;
    export let show: boolean = false; // Add this line
</script>

{#if show} <!-- Conditionally render the modal -->
    <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded shadow-md w-80">
            <h2 class="font-bold text-lg mb-4">{showSuccessMessage ? "Success" : "Confirmation"}</h2>
            <p class="text-sm mb-4">{showSuccessMessage ? "Your changes have been saved." : message}</p>
            <div class="flex justify-between">
                {#if !showSuccessMessage}
                    <button class="bg-green-800 text-white px-4 py-2 rounded" on:click={onConfirm}>
                        Yes
                    </button>
                    <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded" on:click={onCancel}>
                        No
                    </button>
                {:else}
                    <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded" on:click={onCancel}>
                        Close
                    </button>
                {/if}
            </div>
        </div>
    </div>
{/if}

<style>
    button {
        cursor: pointer;
    }
</style>
