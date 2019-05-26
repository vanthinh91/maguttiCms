<template>
    <div>
        <div class="input-group mb-3">
            <input type="text"  v-on:keyup="uppercaseMessages" class="form-control text-uppercase" v-model="message" v-bind:name="name">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-save" @click="updateInput"></i></span>
              </div>
        </div>
        <div v-if="hasError" class="float-left text-danger">Il pin deve avere da 8 a 30 caratteri solo alpha numerici</div>

    </div>
</template>
<script>
    import clearBtn from './partial/ClearInputBtnComponent';
    export default {
        components: {clearBtn},
        data() {
            return {
                message:'',
                remainingCount: 0,
                hasError: false,
            }
        },
        props: ['name','input_text','maxCount'],
        methods: {
            updateInput: function () {
                if(this.message.length>30 || this.message.length<8){
                    this.hasError=true;
                }


            },
            uppercaseMessages:function () {
                this.hasError=false;
                this.message= this.message.toLocaleUpperCase();
            }
        },
        mounted() {
            this.message=this.input_text;
        },
    }
</script>
