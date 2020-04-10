import {
    ISupplier,
    ISupplierState
} from "./../../../common/interface/supplier";
import {
    Action,
    getModule,
    Module,
    Mutation,
    VuexModule
} from "vuex-module-decorators";
import store from "../..";
import { fetchAll, create, update } from "./../../../common/api/supplier";

@Module({ dynamic: true, store, name: "SupplierModule" })
class Supplier extends VuexModule implements ISupplierState {
    suppliers: any[] = [];
    supplier: any = {};
    loading: boolean = false;
    loadingAction: boolean = false;

    @Action
    async fetchAllSupplier(params?: any) {
        this.SET_LOADING_SUPPLIER(true);
        const res: any = await fetchAll(params);
        this.SET_LOADING_SUPPLIER(false);
        this.SET_ALL_SUPPLIER(res);
    }

    @Action
    async createSupplier(params?: any) {
        try {
            this.SET_LOADING_ACTION_SUPPLIER(true);
            const res: any = await create(params);
            this.SET_LOADING_ACTION_SUPPLIER(false);
            this.RESET_SUPPLIER();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_SUPPLIER(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async updateSupplier(params?: any) {
        try {
            this.SET_LOADING_ACTION_SUPPLIER(true);
            const res: any = await update(params);
            this.SET_LOADING_ACTION_SUPPLIER(false);
            this.RESET_SUPPLIER();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_SUPPLIER(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async fetchOneSupplier(params?: any) {
        this.SET_SUPPLIER(params);
    }

    @Action
    async resetOneSupplier() {
        this.RESET_SUPPLIER();
    }

    @Mutation
    private SET_ALL_SUPPLIER(res: any) {
        this.suppliers = res;
    }

    @Mutation
    private SET_SUPPLIER(data: any) {
        this.supplier = {
            ...data
        };
    }

    @Mutation
    private SET_LOADING_SUPPLIER(type: boolean) {
        this.loading = type;
    }

    @Mutation
    private SET_LOADING_ACTION_SUPPLIER(type: boolean) {
        this.loadingAction = type;
    }

    @Mutation
    private RESET_SUPPLIER() {
        this.supplier = {};
    }
}

export const SupplierModule = getModule(Supplier);
