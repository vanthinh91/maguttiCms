<template>
    <div>

        <div class="input-group mb-3">
            <input type="text" class="form-control"
                   v-on:keyup="countdown" v-model="seo_text" v-bind:name="name">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2" v-bind:class="{'text-danger': hasError }">{{remainingCount}}</span>
            </div>

        </div>
        <div v-if="hasError" v-bind:class="{'text-danger': hasError }" class="float-left">maximum length exceeded</div>
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
            console.log('Component mountedseo ')
        }
    }
</script>
