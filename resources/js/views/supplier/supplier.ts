import { SupplierModule } from "./../../store/modules/master/supplier";
import Vue from "vue";
import { Component, Watch } from "vue-property-decorator";

@Component({
    name: "Supplier"
})
export default class Supplier extends Vue {
    headers: any[] = [
        {
            text: "Name",
            align: "left",
            sortable: false,
            value: "name"
        },
        { text: "Description", value: "description" },
        { text: "Pilihan", value: "actions" }
    ];

    totalSuppliers: number = 10;
    options: any = {};
    params: any = {};
    keyword: string = "";

    dialog: boolean = false;
    isEdit: boolean = false;

    get loading() {
        return SupplierModule.loading;
    }

    get loadingAction() {
        return SupplierModule.loadingAction;
    }

    get suppliers() {
        return SupplierModule.suppliers;
    }

    get supplier() {
        return SupplierModule.supplier;
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
            }
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
        await SupplierModule.fetchAllSupplier(this.params);
    }

    async submit() {
        await SupplierModule.createSupplier(this.supplier);
        this.fetchData();
        this.dissmiss();
    }

    async submitUpdate() {
        await SupplierModule.updateSupplier(this.supplier);
        this.fetchData();
        this.dissmiss();
    }

    openDialog(item: any) {
        this.isEdit = true;
        this.dialog = true;
        SupplierModule.fetchOneSupplier(item);
    }

    dissmiss() {
        this.dialog = false;
        this.isEdit = false;
        SupplierModule.resetOneSupplier();
    }
}
