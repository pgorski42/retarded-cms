require('./bootstrap');

import Vue from 'vue'
import Dashboard from './app/dashboard/Dashboard.vue'
import DashboardMenu from './app/dashboard/DashboardMenu.vue'


window.store = {
    currentComponent: null
};

const app = new Vue({
    el: "#content",
    template: "<Dashboard/>",
    components: { Dashboard },
});

const menu = new Vue({
    el: "#menu",
    template: "<DashboardMenu/>",
    components: { DashboardMenu }
});