<template>
    <div>
        <div class="input-group mb-3">
            <input type="text" class="form-control"
                   v-on:keyup="countdown" v-model="message" v-bind:name="name">
            <div class="input-group-append">
                <span class="input-group-text" :class=classErrorObject> {{remainingCount}} </span>
            </div>
        </div>
        <div v-if="hasError" class="float-left" :class=classErrorObject >Max length exceeded</div>
    </div>
</template>
<script>
    import counterChars from '../../mixins/chars-counter';
    export default {
        mixins: [counterChars],
        data() {
            return {
                message:'',
            }
        },
        mounted() {
            this.message=this.seo_text;
            this.countdown();
        },
    }
</script>
