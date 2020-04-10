import axios from 'axios';
import { API_BASE_URL } from './config';
// import { setError, setNotification } from './notification';

const token: any = document.head.querySelector('meta[name="csrf-token"]');

const service = axios.create({
	// baseURL: `http://192.168.1.25:8000/api/`, // url = base url + request url
	baseURL: `http://127.0.0.1:8000/api/`, // url = base url + request url
	timeout: 5000,
	// withCredentials: true // send cookies when cross-domain requests
});

service.interceptors.request.use(
	(config) => {
		if (config) {
			config.headers.common['X-CSRF_TOKEN'] = token;
			config.headers.common['Content-Type'] = 'application/json';
		}
		return config;
	},
	(error) => {
		Promise.reject(error);
	},
);

service.interceptors.response.use(
	(response) => {
		// setNotification(response);
		if (response.status !== 200) {
			if (response.status === 201) {
				return response.data;
			}
			return response;
		} else {
			return response.data;
		}
	},
	(error) => {
		return Promise.reject(error);
	},
);

export default service;
