<template>
    <div>
        <nav>
            <router-link to="/">Home</router-link>
            <router-link to="/create">Create Visit</router-link>
            <router-link to="/logout" @click.prevent="logout">Logout</router-link>
        </nav>
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
    name: 'AppLayout',
    setup() {
        const router = useRouter();

        const logout = async () => {
            try {
                await axios.post('/logout');
                router.push({ name: 'login' });
            } catch (error) {
                console.error(error);
            }
        };

        return { logout };
    },
};
</script>
