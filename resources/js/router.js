import Vue from 'vue'
import VueRouter from 'vue-router'
import Main from "./components/Main.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Main },
    ]
});

export default router;

