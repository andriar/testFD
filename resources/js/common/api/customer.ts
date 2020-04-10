import request from "../utils/request";
import { ICustomer } from "../interface/customer";
import { generateQuery } from "../utils/queryGenerator";

export const fetchAll = (params?: any) => {
    return request({
        url: `customers?` + generateQuery(params),
        method: "get"
    });
};

export const create = (customer: ICustomer) => {
    return request({
        url: `customers`,
        method: "post",
        // headers: getHeader(),
        data: customer
    });
};

export const update = (customer: ICustomer) => {
    return request({
        url: `customers/${customer.id}`,
        method: "patch",
        // headers: getHeader(),
        data: customer
    });
};
