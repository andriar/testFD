import { GoodModule } from "../../store/modules/master/good";
import Vue from "vue";
import { Component, Watch } from "vue-property-decorator";

@Component({
    name: "Good"
})
export default class Good extends Vue {
    headers: any[] = [
        {
            text: "Name",
            align: "left",
            sortable: false,
            value: "name"
        },
        { text: "Code", value: "code" },
        { text: "Quantity", value: "stock.qty" },
        { text: "Pilihan", value: "actions" }
    ];

    totalGoods: number = 10;
    options: any = {};
    params: any = {};
    keyword: string = "";

    dialog: boolean = false;
    isEdit: boolean = false;

    get loading() {
        return GoodModule.loading;
    }

    get loadingAction() {
        return GoodModule.loadingAction;
    }

    get goods() {
        return GoodModule.goods;
    }

    get good() {
        return GoodModule.good;
    }

    @Watch("options", { deep: true })
    onChangePage() {
        this.params.per_page = this.options.itemsPerPage;
        this.params.page = this.options.page;
        this.fetchData();
    }

    mounted() {
        this.initData();
    }

    initData() {
        this.setParams();
        // this.fetchData();
    }

    setParams() {
        this.params = {
            page: 1,
            per_page: 10,
            sort: {
                field: "name",
                value: "ASC"
            },
            join: "stock"
        };
    }

    search() {
        this.setParams();
        this.params = {
            ...this.params,
            filter: {
                field: "name",
                value: this.keyword
            }
        };
        this.fetchData();
    }

    async fetchData() {
        await GoodModule.fetchAllGood(this.params);
    }

    async submit() {
        await GoodModule.createGood(this.good);
        this.fetchData();
        this.dissmiss();
    }

    async submitUpdate() {
        await GoodModule.updateGood(this.good);
        this.fetchData();
        this.dissmiss();
    }

    openDialog(item: any) {
        this.isEdit = true;
        this.dialog = true;
        GoodModule.fetchOneGood(item);
    }

    dissmiss() {
        this.dialog = false;
        this.isEdit = false;
        GoodModule.resetOneGood();
    }
}
