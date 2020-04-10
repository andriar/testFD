import request from "../utils/request";
import { IPurchase } from "../interface/purchase";
import { generateQuery } from "../utils/queryGenerator";

export const fetchAll = (params?: any) => {
    return request({
        url: `purchasetransactions?` + generateQuery(params),
        method: "get"
    });
};

export const create = (purchase: IPurchase) => {
    return request({
        url: `purchasetransactions`,
        method: "post",
        // headers: getHeader(),
        data: purchase
    });
};

export const update = (purchase: IPurchase) => {
    return request({
        url: `purchasetransactions/${purchase.id}`,
        method: "patch",
        // headers: getHeader(),
        data: purchase
    });
};
