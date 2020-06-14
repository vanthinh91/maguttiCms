<template>
    <div>
        <div class="input-group">
            <input ref="input" type="text" onkeyup="" class="form-control" v-model="message" v-bind:name="name">
            <div class="input-group-append">
                <copy-btn @copy="copyInput" class="btn-info input-group-text"></copy-btn>
            </div>
        </div>
    </div>
</template>
<script>
    import copyBtn from './partial/CopyInputBtnComponent';
    export default {
        components: {copyBtn},
        data() {
            return {
                message:'',
            }
        },
        props: ['name','input_text'],
        methods: {
            copyInput: function () {
                let testingCodeToCopy = this.$refs.input
                testingCodeToCopy.setAttribute('type', 'text')
                testingCodeToCopy.select();
                let textCopied = testingCodeToCopy.value;
                try {
                    let successful = document.execCommand('copy');
                    let msg = successful ? 'successful' : 'unsuccessful';
                    let alertMsg =`Text ${textCopied}  was copied  ${msg} `

                    $.notify(alertMsg,'success');
                } catch (err) {
                    $.notify('Oops, unable to copy');
                }
                /* unselect the range */
                //testingCodeToCopy.setAttribute('type', 'hidden')
                window.getSelection().removeAllRanges()
            }
        },
        mounted() {
            this.message=this.input_text;
        },

    }
</script>
