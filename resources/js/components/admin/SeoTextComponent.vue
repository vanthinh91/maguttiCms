<template>
    <div>
        <span class="input-group-text" id="basic-addon2" >
            Max Chars {{maxCount}} - <span v-bind:class="{'text-danger': hasError }" class="mx-1 inline-block"> Left  {{remainingCount}}</span>
            <span v-if="hasError" v-bind:class="{'text-danger': hasError }"> (Maximum length exceeded) </span>
        </span>

        <textarea  class="form-control" v-on:keyup="countdown" v-model="seo_text" v-bind:name="name" rows="8"></textarea>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                remainingCount: 140,
                hasError: false
            }
        },
        props: ['name', 'seo_text', 'maxCount'],
        methods: {
            countdown: function () {
                this.remainingCount = this.maxCount - this.seo_text.length;
                this.hasError = this.remainingCount < 0;
            }
        },
        mounted() {
            this.remainingCount = this.maxCount - this.seo_text.length;
            this.countdown();
            console.log('Component mountedseo ')
        }
    }
</script>
