export interface IGoodState {
    goods: any;
    good: {} | any;
    loading: boolean;
    loadingAction: boolean;
}
export interface IGood {
    id: string;
    code: string;
    name: string;
    category_id: string;
    sub_category_id: string;
}
