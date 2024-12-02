import { writable } from 'svelte/store';

export const user = writable({
    name: '',
    email: '',
    username: '',
    location: '',
    memberSince: '',
    socialMedia: {
        facebook: '',
        mail: '',
        instagram: ''
    }
});
