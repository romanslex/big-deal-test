import Vue from 'vue'
import VueRouter from 'vue-router'
import Planets from "./components/Planets.vue";
import Planet from "./components/Planet.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Planets },
        { path: '/:id', component: Planet },
    ]
});

export default router;

