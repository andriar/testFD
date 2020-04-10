export interface IPurchaseState {
    purchases: any;
    purchase: {} | any;
    loading: boolean;
    loadingAction: boolean;
}
export interface IPurchase {
    id: string;
    transaction_code: string;
    total: string;
    supplier_id: string;
    details: any[];
}

export interface IDetail {
    good_id: string;
    name: string;
    qty: number;
    price: number;
}
