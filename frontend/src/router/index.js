import { createRouter, createWebHistory } from 'vue-router';
import FootballFixtures from "@/components/FootballFixtures.vue";

const routes = [
    {
        path: '/',
        name: 'FootballFixtures',
        component: FootballFixtures,
    },
    {
        path: '/:catchAll(.*)',
        redirect: '/',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
