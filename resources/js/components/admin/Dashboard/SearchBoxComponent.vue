<template>

    <div class="col ">
      <label for="context" class="form-label">Section</label>
      <select
          name="context"
          class="form-control"
          @change="$emit('update:context', $event.target.value)"
      >
        <option value="">Select Context</option>
        <option
            v-for="item of sections"
            :value="item"
            :key="item"
            :selected="context === item"
        >
          {{ item }}
        </option>
      </select>
    </div>
    <div class="col">
      <BaseInputGroup
          v-model="searchText"
          label="Models"
          type="text"
          name="searchText"
          @input="$emit('update:searchText', $event.target.value)"
          aria-placeholder=""
          placeholder="Type a  word  to filter"
      />

    </div>

</template>

<script>
import BaseInputGroup from "../BaseInputGroup";
import {ref, computed, watch} from "vue";

const sections = [
  'Cms',
  'Shop',
]

export default {
  name: "DashBoardSearchComponent",
  components: {BaseInputGroup},
  props: {
    context: {
      type: String,
      default: ''
    },
    searchText: {
      type: String,
      default: ''
    },
  },

  setup() {
    const sections = ['Cms', 'Shop'];
    return {
      sections
    }
  },
}
</script>