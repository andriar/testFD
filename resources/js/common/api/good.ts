import request from "../utils/request";
import { IGood } from "../interface/good";
import { generateQuery } from "../utils/queryGenerator";

export const fetchAll = (params?: any) => {
    return request({
        url: `goods?` + generateQuery(params),
        method: "get"
    });
};

export const create = (good: IGood) => {
    return request({
        url: `goods`,
        method: "post",
        // headers: getHeader(),
        data: good
    });
};

export const update = (good: IGood) => {
    return request({
        url: `goods/${good.id}`,
        method: "patch",
        // headers: getHeader(),
        data: good
    });
};
