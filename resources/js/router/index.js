import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../Pages/Auth/Login.vue';
import Register from '../Pages/Auth/Register.vue';
import Index from '../Pages/Visits/Index.vue';
import Form from '../Pages/Visits/Form.vue';

const routes = [
    { path: '/', component: Index, meta: { requiresAuth: true } },
    { path: '/login', name: "Login", component: Login },
    { path: '/register', name: "Register", component: Register },
    { path: '/visits', name: 'Index', component: Index, meta: { requiresAuth: true } },
    { path: '/visits/create', name: 'CreateForm', component: Form, meta: { requiresAuth: true } },
    { path: '/visits/edit/:id', name: 'EditForm', component: Form, props: true, meta: { requiresAuth: true } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('authToken');
    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;
