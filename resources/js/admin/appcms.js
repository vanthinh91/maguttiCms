

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'

window.Vue =Vue;
window.$eventBus = new Vue();


import languageBundle from '@kirschbaum-development/laravel-translations-loader!@kirschbaum-development/laravel-translations-loader';
import VueI18n from 'vue-i18n';


Vue.use(VueI18n);
const i18n = new VueI18n({
    locale: window._LOCALE,
    messages: languageBundle,
})


import GeneratorInputComponent from './../components/admin/GeneratorInputComponent';
import ListComponent from './../components/admin/ListComponent';


Vue.component('dashboard-component', require('./../components/admin/DashboardButtonsComponent').default);
Vue.component('side-bar-component', require('./../components/admin/SideBar').default);
Vue.component('seo-input-component', require('./../components/admin/SeoInputComponent').default);
Vue.component('seo-text-component', require('./../components/admin/SeoTextComponent').default);
Vue.component('clearable-input-component', require('./../components/admin/ClearableInputComponent').default);
Vue.component('copyable-input-component', require('./../components/admin/CopyableInputComponent').default);

Vue.component('generator-input-component', GeneratorInputComponent);
Vue.component('list-component', ListComponent);
Vue.component('checkbox-grid-component', require('../components/admin/CheckBoxesGrid/CheckGridComponent').default);
Vue.component('file-manager-grid-component', require('../components/admin/Filemanager/IndexComponent').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    i18n,
});
