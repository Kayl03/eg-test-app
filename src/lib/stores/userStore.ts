import { writable } from 'svelte/store';

interface User {
    id: string;
    name: string;
    email: string;
    isAuthenticated: boolean;
}

function createUserStore() {
    const { subscribe, set, update } = writable<User>({
        id: '',
        name: '',
        email: '',
        isAuthenticated: false
    });

    return {
        subscribe,
        login: (userData: { id: string; name: string; email: string }) => {
            set({
                ...userData,
                isAuthenticated: true
            });
        },
        logout: () => {
            set({
                id: '',
                name: '',
                email: '',
                isAuthenticated: false
            });
        },
        updateProfile: (userData: Partial<User>) => {
            update(user => ({
                ...user,
                ...userData
            }));
        }
    };
}

export const userStore = createUserStore();
