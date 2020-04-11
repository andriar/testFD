import { IPromoState } from '../../common/interface/promo';
import { Action, getModule, Module, Mutation, VuexModule } from 'vuex-module-decorators';
import store from '..';
import { fetchAll } from '../../common/api/promo';

@Module({ dynamic: true, store, name: 'CustomerModule' })
class Promo extends VuexModule implements IPromoState {
	promos: any[] = [];
	promo: any = {};
	loading: boolean = false;
	loadingAction: boolean = false;

	@Action
	async fetchAllPromo(params?: any) {
		this.SET_LOADING_PROMO(true);
		const res: any = await fetchAll(params);
		this.SET_LOADING_PROMO(false);
		this.SET_ALL_PROMO(res);
	}

	@Action
	async fetchOnePromo(params?: any) {
		this.SET_PROMO(params);
	}

	@Action
	async resetOnePromo() {
		this.RESET_PROMO();
	}

	@Mutation
	private SET_ALL_PROMO(res: any) {
		this.promos = res;
	}

	@Mutation
	private SET_PROMO(data: any) {
		this.promo = {
			...data,
		};
	}

	@Mutation
	private SET_LOADING_PROMO(type: boolean) {
		this.loading = type;
	}

	@Mutation
	private SET_LOADING_ACTION_PROMO(type: boolean) {
		this.loadingAction = type;
	}

	@Mutation
	private RESET_PROMO() {
		this.promo = {};
	}
}

export const PromoModule = getModule(Promo);
