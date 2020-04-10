import request from "../utils/request";
import { ISupplier } from "../interface/supplier";
import { generateQuery } from "../utils/queryGenerator";

export const fetchAll = (params?: any) => {
    return request({
        url: `suppliers?` + generateQuery(params),
        method: "get"
    });
};

export const create = (supplier: ISupplier) => {
    return request({
        url: `suppliers`,
        method: "post",
        // headers: getHeader(),
        data: supplier
    });
};

export const update = (supplier: ISupplier) => {
    return request({
        url: `suppliers/${supplier.id}`,
        method: "patch",
        // headers: getHeader(),
        data: supplier
    });
};
