<template>
    <div class="form-group col-12 col-sm-12  ">
        <p>{{label}}</p>
        <select  class="form-control">
            <option selected="true">Select template</option>
            <option v-for="item in options" :value="item.id">{{ item.title }}</option>
        </select>

    </div>
</template>
<script>
    export default {
        props: {
            label: String,
            cssInput: String,
            options: Array,
        },
        data() {
            return {

            }
        },
    }
</script>
