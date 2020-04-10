import { IPurchase, IPurchaseState } from "../../../common/interface/purchase";
import {
    Action,
    getModule,
    Module,
    Mutation,
    VuexModule
} from "vuex-module-decorators";
import store from "../..";
import { fetchAll, create, update } from "../../../common/api/purchase";

@Module({ dynamic: true, store, name: "PurchaseModule" })
class Purchase extends VuexModule implements IPurchaseState {
    purchases: any[] = [];
    purchase: any = {};
    loading: boolean = false;
    loadingAction: boolean = false;

    @Action
    async fetchAllPurchase(params?: any) {
        this.SET_LOADING_PURCHASE(true);
        const res: any = await fetchAll(params);
        this.SET_LOADING_PURCHASE(false);
        this.SET_ALL_PURCHASE(res);
    }

    @Action
    async createPurchase(params?: any) {
        try {
            this.SET_LOADING_ACTION_PURCHASE(true);
            const res: any = await create(params);
            this.SET_LOADING_ACTION_PURCHASE(false);
            this.RESET_PURCHASE();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_PURCHASE(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async updatePurchase(params?: any) {
        try {
            this.SET_LOADING_ACTION_PURCHASE(true);
            const res: any = await update(params);
            this.SET_LOADING_ACTION_PURCHASE(false);
            this.RESET_PURCHASE();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_PURCHASE(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async fetchOnePurchase(params?: any) {
        this.SET_PURCHASE(params);
    }

    @Action
    async resetOnePurchase() {
        this.RESET_PURCHASE();
    }

    @Mutation
    private SET_ALL_PURCHASE(res: any) {
        this.purchases = res;
    }

    @Mutation
    private SET_PURCHASE(data: any) {
        this.purchase = {
            ...data
        };
    }

    @Mutation
    private SET_LOADING_PURCHASE(type: boolean) {
        this.loading = type;
    }

    @Mutation
    private SET_LOADING_ACTION_PURCHASE(type: boolean) {
        this.loadingAction = type;
    }

    @Mutation
    private RESET_PURCHASE() {
        this.purchase = {};
    }
}

export const PurchaseModule = getModule(Purchase);
