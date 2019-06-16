
import Vue from 'vue';


import Modal from '../plugins/modal/ModalPlugin';
import ConfirmButton from './../components/admin/ConfirmButton';
import ConfirmDialog from './../components/admin/ConfirmDialog';
import GeneratorInputComponent from './../components/admin/GeneratorInputComponent';

Vue.component('dashboard-component', require('./../components/admin/DashboardButtonsComponent').default);
Vue.component('side-bar-component', require('./../components/admin/SideBar').default);
Vue.component('seo-input-component', require('./../components/admin/SeoInputComponent').default);
Vue.component('seo-text-component', require('./../components/admin/SeoTextComponent').default);
Vue.component('clearable-input-component', require('./../components/admin/ClearableInputComponent').default);
Vue.component('generator-input-component', GeneratorInputComponent);


Vue.component('confirm-button', ConfirmButton);
Vue.component('confirm-dialog', ConfirmDialog)


window.Vue = Vue;
Vue.use(Modal);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',

    methods: {
        confirm(message) {
            this.$modal.dialog(message)
                .then(confirmed => {
                    if (confirmed) {
                        // Proceed. Submit ajax request, etc.
                        alert(message);
                    } else {
                        // Optionally override the button visibility and labels.
                       /* this.$modal.dialog('Okay, canceled', {
                            cancelButton: 'Close',
                            confirmButton: false
                        });

                        */
                    }
                });
        }
    }
});
