<template>

    <div class="col ">
      <label for="context" class="form-label">{{ $t('admin.label.sections') }}</label>
      <select
          name="context"
          class="form-control"
          @change="$emit('update:context', $event.target.value)"
      >
        <option value="">{{ $t('admin.dashboard.select_context') }}</option>
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
          :label="$t('admin.label.models')"
          type="text"
          prepend="fas fa-search"
          name="searchText"
          @input="$emit('update:searchText', $event.target.value)"
          aria-placeholder=""
          :placeholder="$t('admin.dashboard.filter_message')"
      />

    </div>

</template>

<script>
import BaseInputGroup from "../../BaseComponent/BaseInputGroup";
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
    const sections = ['Cms', 'Shop','Users'];
    return {
      sections
    }
  },
}
</script>