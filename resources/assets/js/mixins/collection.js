export default {
    data() {
        return {
            items: [],
            errors: [],
            SUCCESS_CLASS: 'success',
            ERROR_CLASS: 'danger'
        };
    },

    methods: {
        add(item) {
            this.items.push(item);
            this.$emit('added');
        },

        remove(index) {
            this.items.splice(index, 1);
            this.$emit('removed');
        },
        showMessage(message,status) {
           flash(message,status);
        },
        simpleAjaxResponse(response)
        {
            let data;
            data = response.data;
            if(data.status==='ok'){
                this.showMessage(data.message,this.SUCCESS_CLASS);
            }
            else  this.showMessage(data.status,this.ERROR_CLASS);
        },
        responseWithError(error)
        {
            this.showMessage(error,this.ERROR_CLASS)
        },
        methods: {
            url(page) {

                if (! page) {
                    let query = location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }

                if(location.href.indexOf("tag") > -1) {
                    let tag =this.getTag();
                    return `/news/tags/${tag}?page=${page}`;
                }
                else   return `/news?page=${page}`;
            }
        }
    }

}
