<template>
    <div class="col ">
      <BaseSelect
          :options="sections"
          v-model="section"
          name="section"
          :label="$t('admin.label.category')"
          :empty_value ="$t('admin.dashboard.select_section')"
          @input="$emit('update:section', $event.target.value)"
      />
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
import BaseSelect from "../../BaseComponent/BaseSelect";

import {ref} from 'vue'

export default {
  name: "DashBoardSearchComponent",
  components: {BaseInputGroup,BaseSelect},
  props: {
    section: {
      type: String,
      default: ''
    },
    searchText: {
      type: String,
      default: ''
    }
  },
  setup() {
    const sections = ['Cms', 'Shop','Users'];
    const element= ref('');
    const elements = [
      { label: 'Shop', id: 1 },
      { label: 'Cms', id: 2 },
      { label: 'User', id: 3 },
    ]
    return {
      sections,elements,element
    }
  },
}
</script>