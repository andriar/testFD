import { ICustomer, ICustomerState } from "../../../common/interface/customer";
import {
    Action,
    getModule,
    Module,
    Mutation,
    VuexModule
} from "vuex-module-decorators";
import store from "../..";
import { fetchAll, create, update } from "../../../common/api/customer";

@Module({ dynamic: true, store, name: "CustomerModule" })
class Customer extends VuexModule implements ICustomerState {
    customers: any[] = [];
    customer: any = {};
    loading: boolean = false;
    loadingAction: boolean = false;

    @Action
    async fetchAllCustomer(params?: any) {
        this.SET_LOADING_CUSTOMER(true);
        const res: any = await fetchAll(params);
        this.SET_LOADING_CUSTOMER(false);
        this.SET_ALL_CUSTOMER(res);
    }

    @Action
    async createCustomer(params?: any) {
        try {
            this.SET_LOADING_ACTION_CUSTOMER(true);
            const res: any = await create(params);
            this.SET_LOADING_ACTION_CUSTOMER(false);
            this.RESET_CUSTOMER();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_CUSTOMER(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async updateCustomer(params?: any) {
        try {
            this.SET_LOADING_ACTION_CUSTOMER(true);
            const res: any = await update(params);
            this.SET_LOADING_ACTION_CUSTOMER(false);
            this.RESET_CUSTOMER();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_CUSTOMER(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async fetchOneCustomer(params?: any) {
        this.SET_CUSTOMER(params);
    }

    @Action
    async resetOneCustomer() {
        this.RESET_CUSTOMER();
    }

    @Mutation
    private SET_ALL_CUSTOMER(res: any) {
        this.customers = res;
    }

    @Mutation
    private SET_CUSTOMER(data: any) {
        this.customer = {
            ...data
        };
    }

    @Mutation
    private SET_LOADING_CUSTOMER(type: boolean) {
        this.loading = type;
    }

    @Mutation
    private SET_LOADING_ACTION_CUSTOMER(type: boolean) {
        this.loadingAction = type;
    }

    @Mutation
    private RESET_CUSTOMER() {
        this.customer = {};
    }
}

export const CustomerModule = getModule(Customer);
