import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../js/views/Home.vue';

Vue.use(VueRouter);

export const routes: any[] = [
	{
		path: '/',
		name: 'home',
		component: Home,
	},
];

const router = new VueRouter({
	mode: 'history',
	routes,
});

export default router;
