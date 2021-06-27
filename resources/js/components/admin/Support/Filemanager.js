import {HTTP} from '../../../mixins/http-common';
export default {
    data() {
        return {
            params: {},// parameter for fetch data
            current_item: null,
            searchText: "",
            loading: true,
        }
    },
    methods: {
        /* pull  file manager data */
        fetchData: function () {

            let self = this;
            let url = (this.current_item)
                            ? this.fetchDataUrl() + '/' + this.current_item
                            : this.fetchDataUrl();

            let params = this.parameterBag()

            return HTTP.get(url, {params})
                .then(this.refresh)
                .then(function (response) {
                    self.loading = false;
                })
                .catch(e => {
                    self.errors.push(e)
                    self.showMessage(e.message, self.ERROR_CLASS);
                })
        },
        fetchDataUrl() {
            return   urlAjaxHandlerCms  + `file-manager/grid`;
        },
        parameterBag(){
            /* clean  parameterBags from empty object property */
            return Object.entries(this.params).reduce((a,[k,v]) => (v == '' ? a : (a[k]=v, a)), {})

        },
        /*  pull  form  for edit media data */
        updateSidebar(id) {
            let self = this;
            this.isLoading = true;
            HTTP.get(urlAjaxHandlerCms + 'filemanager/edit/' + id)
                .then(response => {
                    self.isLoading = false;
                    this.updateData(response);
                })
                .catch(e => {
                    self.errors.push(e)
                    self.showMessage(e.message, self.ERROR_CLASS);
                })
        },
        /*
        * Sidebar: update image data
        */
        // Make ajax request to edit media data
        saveMediaData(form){
            let target = form.attr('action')
            HTTP.post(target ,form.serialize())
                .then(function ({data}) {
                    $.notify(data.message, 'success')
                })
                .catch(function (error) {
                    $.notify('Error')
                })
        }

    },
}