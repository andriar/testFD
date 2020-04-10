export interface ICustomerState {
    customers: any;
    customer: {} | any;
    loading: boolean;
    loadingAction: boolean;
}
export interface ICustomer {
    id: string;
    name: string;
    address: string;
    telephone: string;
    meta: JSON;
}
