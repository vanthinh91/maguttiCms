export default {
    data() {
        return {
            remainingCount: 0,
            hasError: false,
         }
    },
    props: ['name','input_text','maxCount'],
    methods: {
        countdown: function () {
            this.remainingCount = this.maxCount - this.message.length;
            this.hasError = this.remainingCount < 0;
        },
        clearInput: function () {
            this.message='';
            this.countdown();
        }
    },
    computed: {
        classErrorObject: function () {
            return {
                'text-danger': this.hasError
            }
        }
    },

}
