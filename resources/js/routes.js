import { createWebHistory, createRouter } from "vue-router";


import Products from './pages/products';



const routes = [
    { path: '/', component: Products, name: 'Products' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "activePage", // active class for non-exact links.
    linkExactActiveClass: "activePage" // active class for exact links.
});

export default router;
