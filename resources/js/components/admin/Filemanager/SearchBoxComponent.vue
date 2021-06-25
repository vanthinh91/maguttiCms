<template xmlns="http://www.w3.org/1999/html">
  <div class="search-box">
    <div class="input-group">
      <span class="input-group-text"  >
        <i class="fas fa-search"></i>
      </span>

      <input type="text" class="form-control"
             id="search-text"
             v-model="searchText"
             placeholder="Filter By title, extensions, type ...."
             aria-label="Filter By title, extensions, type .... "
             aria-describedby="search-text">
    </div>
  </div>

</template>

<script>
export default {
  name: "SearchBoxComponent",
  data() {
    return {
      searchText:null,
    }
  },
  watch: {
    // whenever question changes, this function will run
    searchText: function (newQuestion, oldQuestion) {
      this.$emit('update-search', newQuestion)
    }
  },
}
</script>

