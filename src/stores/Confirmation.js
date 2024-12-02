import { writable } from 'svelte/store';

export const showConfirmation = writable(false);
export const showSuccessMessage = writable(false);
export const confirmationMessage = writable("Are you sure you want to make these changes?");