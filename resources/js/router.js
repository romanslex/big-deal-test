import Vue from 'vue'
import VueRouter from 'vue-router'
import Planets from "./components/Planets.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Planets },
    ]
});

export default router;

