<template>
  <div class="search-box">
    <div class="input-group">
      <span class="input-group-text">
        <i class="fas fa-search"></i>
      </span>
      <input type="text" class="form-control"
             id="search-text"
             v-model="searchText"
             :placeholder="$t('admin.file_manager.filter_message')"
             :aria-label="$t('admin.file_manager.filter_message')"
             aria-describedby="search-text">
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchBoxComponent",
  data() {
    return {
      searchText: null,
    }
  },
  watch: {
    searchText: function (newFilter, oldFilter) {
      this.$emit('update-search', newFilter)
    }
  },
}
</script>

