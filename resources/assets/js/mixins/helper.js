export default {
    data () {
        return {
            isModalVisible: false,
            deleteUrl :'',
            path: '',
        };
    },
    methods: {
        urlHandler(page) {
            if (! page) {
                let query = location.search.match(/page=(\d+)/);
                page = query ? query[1] : 1;
            }
            if(location.href.indexOf("tag") > -1) {
                let tag =this.getTag();
                this.path = `/news/tags/${tag}`;
            }
            else   this.path = `/news`;

            if(page>1){
                this.path+=`?page=${page}`;
            }

            return this.path;
        },
        showModal(target) {
            this.deleteUrl=target;
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
        updateModal() {
            this.isModalVisible = false;
            location.href = this.deleteUrl;
        },
    }
}
