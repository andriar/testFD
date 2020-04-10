import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../js/views/Home.vue";
import Supplier from "../js/views/supplier/Supplier.vue";
import Customer from "../js/views/customer/Customer.vue";
import Good from "../js/views/good/Good.vue";
import Purchase from "../js/views/transactions/purchase/Purchase.vue";

Vue.use(VueRouter);

export const routes: any[] = [
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/supplier",
        name: "supplier",
        component: Supplier
    },
    {
        path: "/customer",
        name: "customer",
        component: Customer
    },
    {
        path: "/good",
        name: "good",
        component: Good
    },
    {
        path: "/purchase",
        name: "purchase",
        component: Purchase
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
