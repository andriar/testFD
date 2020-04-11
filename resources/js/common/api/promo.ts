import request from '../utils/request';
import { generateQuery } from '../utils/queryGenerator';

export const fetchAll = (params?: any) => {
	return request({
		url: `promos?` + generateQuery(params),
		method: 'get',
	});
};
