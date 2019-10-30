<template>
    <div class="form-group col-12 col-sm-6  ">
        <p>{{label}}</p>
        <input class="form-control"
               :value="content"
               :placeholder="placeholder"
               @input="$emit('update:content', $event.target.value)"
        >

    </div>
</template>
<script>
    export default {
        props: ['label', 'placeholder','content','cssInput' ],
        data() {
            return {

            }
        },
    }
</script>
