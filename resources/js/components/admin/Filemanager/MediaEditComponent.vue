<template>
  <div id="sidebar-content" class="col-md-4 col-12" ref="modalEditComponent">
    <loader v-if="isLoading"></loader>
  </div>
</template>
<script>
import Loader from "../../BaseComponent/LoaderComponent";
import fileManagerSupport from "../Support/Filemanager";

export default {
  name: "MediaEditComponent",
  components: {
    Loader
  },
  mixins: [fileManagerSupport],
  data() {
    return {
      isLoading: false
    }
  },
  methods: {

    updateData({data}) {
      this.$refs.modalEditComponent.innerHTML = data;
    },
  },
  mounted() {
    $eventBus.$on('FILE_MANAGER_UPDATE_SIDE_BAR', (id) => {
      if (id === null) {
        this.$refs.modalEditComponent.innerHTML = '';
      }
      else this.updateSidebar(id)
    });
    let self = this;

    $(document).on('submit', '#filemanager-edit-form', function (e) {
      e.preventDefault();
      let  form = $(this);
      self.saveMediaData(form)
    });
  },
  beforeDestroy() {
    $eventBus.$off(['FILE_MANAGER_UPDATE_SIDE_BAR']);
  }
}
</script>

