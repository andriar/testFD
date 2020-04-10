import { CustomerModule } from "../../store/modules/master/customer";
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
        { text: "Address", value: "address" },
        { text: "Telephone", value: "telephone" },
        { text: "Pilihan", value: "actions" }
    ];

    totalSuppliers: number = 10;
    options: any = {};
    params: any = {};
    keyword: string = "";

    dialog: boolean = false;
    isEdit: boolean = false;

    get loading() {
        return CustomerModule.loading;
    }

    get loadingAction() {
        return CustomerModule.loadingAction;
    }

    get customers() {
        return CustomerModule.customers;
    }

    get customer() {
        return CustomerModule.customer;
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
        await CustomerModule.fetchAllCustomer(this.params);
    }

    async submit() {
        await CustomerModule.createCustomer(this.customer);
        this.fetchData();
        this.dissmiss();
    }

    async submitUpdate() {
        await CustomerModule.updateCustomer(this.customer);
        this.fetchData();
        this.dissmiss();
    }

    openDialog(item: any) {
        this.isEdit = true;
        this.dialog = true;
        CustomerModule.fetchOneCustomer(item);
    }

    dissmiss() {
        this.dialog = false;
        this.isEdit = false;
        CustomerModule.resetOneCustomer();
    }
}
