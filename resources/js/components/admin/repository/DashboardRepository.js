import {HTTP} from '../../../mixins/http-common';
export default {
    methods: {
        fetchDashBoardData: function () {


            return HTTP.get(this.url())
                       .catch(e => {
                       self.errors.push(e)
                       self.showMessage(e.message, self.ERROR_CLASS);
                     })
        },
        url() {
            return window._SERVER_PATH + `/admin/api/dashboard`;
        },
        refresh({data}) {
            this.items = data.data
            console.log(this.items)
        },
        updateSearchFilter(data) {
            this.form.searchText = data;
        }

    }
}