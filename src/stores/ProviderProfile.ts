// src/lib/stores/profileStore.ts
import { writable } from 'svelte/store';

interface BusinessHours {
    [day: string]: string;
}

interface Profile {
    name: string;
    username: string;
    location: string;
    memberSince: string;
    about: string;
    services: string[];
    businessHours: BusinessHours;
    socialMedia: {
        facebook: string;
        mail: string;
        instagram: string;
    };
}

const defaultProfile: Profile = {
    name: 'Van Pogi',
    username: '@van_123',
    location: 'Caritan Centro, Tuguegarao Cagayan',
    memberSince: 'August 2024',
    about: 'Lorem ipsum dolor sit amet...',
    services: ['Voice Over', 'Hosting'],
    businessHours: {
        Sunday: 'Closed',
        Monday: '8:00 AM - 5:00 PM',
        Tuesday: '8:00 AM - 5:00 PM',
        Wednesday: '8:00 AM - 5:00 PM',
        Thursday: '8:00 AM - 5:00 PM',
        Friday: '8:00 AM - 4:00 PM',
        Saturday: 'Closed'
    },
    socialMedia: {
        facebook: '',
        mail: '',
        instagram: ''
    }
};

export const profileStore = writable(defaultProfile);
export const isEditing = writable(false);
