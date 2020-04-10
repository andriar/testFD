import { PurchaseModule } from "../../../store/modules/transaction/purchase";
import { SupplierModule } from "../../../store/modules/master/supplier";
import Vue from "vue";
import { Component, Watch } from "vue-property-decorator";
import { GoodModule } from "../../../store/modules/master/good";

@Component({
    name: "Purchase"
})
export default class Purchase extends Vue {
    headers: any[] = [
        {
            text: "Code",
            align: "left",
            sortable: false,
            value: "transaction_code"
        },
        { text: "Total", value: "total" },
        { text: "Supplier", value: "supplier.name" },
        { text: "Pilihan", value: "actions" }
    ];

    totalPurchases: number = 10;
    options: any = {};
    params: any = {};
    paramsSupplier: any = {};
    keyword: string = "";
    // autoCompleteSuppliers: any = [];
    goodDetails: any[] = [];

    dialog: boolean = false;
    dialogDetail: boolean = false;
    isEdit: boolean = false;

    get loading() {
        return PurchaseModule.loading;
    }

    get loadingAction() {
        return PurchaseModule.loadingAction;
    }

    get purchases() {
        return PurchaseModule.purchases;
    }

    get purchase() {
        return PurchaseModule.purchase;
    }

    get suppliers() {
        return SupplierModule.suppliers;
    }

    get goods() {
        return GoodModule.goods;
    }

    @Watch("options", { deep: true })
    onChangePage() {
        this.params.per_page = this.options.itemsPerPage;
        this.params.page = this.options.page;
        this.fetchData();
    }

    // @Watch("options", { deep: true })
    // onChangeSupplier() {
    //     if (this.suppliers) {
    //         this.autoCompleteSuppliers = this.suppliers.data;
    //     }
    // }

    mounted() {
        this.initData();
    }

    initData() {
        this.setParams();
        this.fetchSuppliers();
        this.fetchGoods();
        // this.fetchData();
    }

    setParams() {
        this.params = {
            page: 1,
            per_page: 10,
            sort: {
                field: "created_at",
                value: "DESC"
            },
            join: "supplier,details"
        };
    }

    search() {
        this.setParams();
        this.params = {
            ...this.params,
            filter: {
                field: "transaction_code",
                value: this.keyword
            }
        };
        this.fetchData();
    }

    async fetchData() {
        await PurchaseModule.fetchAllPurchase(this.params);
    }

    async submit() {
        const data: any = {
            ...this.purchase,
            details: this.goodDetails
        };
        await PurchaseModule.createPurchase(data);
        this.fetchData();
        this.dissmiss();
    }

    async submitUpdate() {
        await PurchaseModule.updatePurchase(this.purchase);
        this.fetchData();
        this.dissmiss();
    }

    openDialog(item: any) {
        this.isEdit = true;
        this.dialog = true;
        PurchaseModule.fetchOnePurchase(item);
    }

    openDetailDialog(item: any) {
        this.dialogDetail = true;
        PurchaseModule.fetchOnePurchase(item);
    }

    dissmiss() {
        this.dialog = false;
        this.isEdit = false;
        PurchaseModule.resetOnePurchase();
    }

    async fetchSuppliers() {
        this.paramsSupplier = {
            sort: {
                field: "name",
                value: "ASC"
            }
        };
        await SupplierModule.fetchAllSupplier(this.paramsSupplier);
    }

    async fetchGoods() {
        this.paramsSupplier = {
            sort: {
                field: "name",
                value: "ASC"
            }
        };
        await GoodModule.fetchAllGood(this.paramsSupplier);
    }

    addGoods() {
        this.goodDetails.push({
            good_id: "",
            name: "asd",
            qty: "",
            price: ""
        });
    }
}
