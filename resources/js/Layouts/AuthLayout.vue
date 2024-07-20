<template>
    <div>
        <nav>
            <router-link to="/">Home</router-link>
            <router-link to="/login">Login</router-link>
            <router-link to="/register">Register</router-link>
        </nav>
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
export default {
    name: 'AuthLayout',
};
</script>
