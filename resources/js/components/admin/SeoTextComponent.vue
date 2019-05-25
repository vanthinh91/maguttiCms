<template>
    <div>
        <span class="input-group-text" id="basic-addon2" >
            Max Chars: {{maxCount}} - <span class="mx-1 inline-block" :class=classErrorObject > Left:  {{remainingCount}}</span>
            <span v-if="hasError" :class=classErrorObject> (Max length exceeded) </span>
        </span>
        <textarea  class="form-control" v-on:keyup="countdown" v-model="message" v-bind:name="name" rows="8"></textarea>
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
