import { IGood, IGoodState } from "../../../common/interface/good";
import {
    Action,
    getModule,
    Module,
    Mutation,
    VuexModule
} from "vuex-module-decorators";
import store from "../..";
import { fetchAll, create, update } from "../../../common/api/good";

@Module({ dynamic: true, store, name: "GoodModule" })
class Good extends VuexModule implements IGoodState {
    goods: any = [];
    good: any = {};
    loading: boolean = false;
    loadingAction: boolean = false;

    @Action
    async fetchAllGood(params?: any) {
        this.SET_LOADING_GOOD(true);
        const res: any = await fetchAll(params);
        this.SET_LOADING_GOOD(false);
        this.SET_ALL_GOOD(res);
    }

    @Action
    async createGood(params?: any) {
        try {
            this.SET_LOADING_ACTION_GOOD(true);
            const res: any = await create(params);
            this.SET_LOADING_ACTION_GOOD(false);
            this.RESET_GOOD();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_GOOD(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async updateGood(params?: any) {
        try {
            this.SET_LOADING_ACTION_GOOD(true);
            const res: any = await update(params);
            this.SET_LOADING_ACTION_GOOD(false);
            this.RESET_GOOD();
        } catch (error) {
            if (error) {
                this.SET_LOADING_ACTION_GOOD(false);
                //  setError(error.response);
            }
        }
    }

    @Action
    async fetchOneGood(params?: any) {
        this.SET_GOOD(params);
    }

    @Action
    async resetOneGood() {
        this.RESET_GOOD();
    }

    @Mutation
    private SET_ALL_GOOD(res: any) {
        this.goods = res;
    }

    @Mutation
    private SET_GOOD(data: any) {
        this.good = {
            ...data
        };
    }

    @Mutation
    private SET_LOADING_GOOD(type: boolean) {
        this.loading = type;
    }

    @Mutation
    private SET_LOADING_ACTION_GOOD(type: boolean) {
        this.loadingAction = type;
    }

    @Mutation
    private RESET_GOOD() {
        this.good = {};
    }
}

export const GoodModule = getModule(Good);
