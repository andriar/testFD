import Vue from 'vue';

import './bootstrap';
import vuetify from './plugins/vuetify';
import router from './routes';
import App from '../js/views/App.vue';

// import store from './store';
Vue.config.productionTip = false;

const app = new Vue({
	el: '#app',
	// store,
	vuetify,
	router,
	render: (h: any) => h(App),
});

export default app;
