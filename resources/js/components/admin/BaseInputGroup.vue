<template>
  <label v-if="label" :for="$attrs.name??''" class="form-label">{{ label }}</label>
  <div class="input-group">
    <input
        v-bind="$attrs"
        :value="modelValue"
        :placeholder="$attrs.placeholder??''"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-control"
    >
    <span class="input-group-text">
        <i class="fas fa-search"></i>
    </span>
  </div>
</template>
<script>
export default {
  inheritAttrs: false,
  props: {
    label: {
      type: String,
      default: ''
    },
    modelValue: {
      type: [String, Number],
      default: ''
    }
  },
  emits: ['update:modelValue'],
}
</script>
