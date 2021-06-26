<template>
  <div id="sidebar-content" class="col-md-4 col-12" ref="modalEditComponent">
    <loader v-if="isLoading"></loader>
  </div>
</template>

<script>
import Loader from "../../BaseComponent/LoaderComponent";
import {HTTP} from "../../../mixins/http-common";

export default {
  name: "MediaEditComponent",
  components: {
     Loader
  },
  data() {
    return {
     isLoading:false
    }
  },
  methods: {

    updateSidebar(id) {
      this.isLoading=true;
      HTTP.get(urlAjaxHandlerCms + 'filemanager/edit/' + id)
          .then(response => {
            console.log({'loading':this.isLoading})
            this.isLoading=false;
            this.$refs.modalEditComponent.innerHTML = response.data;
            console.log({'loading':this.isLoading})
          })
    },
  },
  mounted() {
      $eventBus.$on('FILE_MANAGER_UPDATE_SIDE_BAR', (id) => {
      if(id===null){
          this.$refs.modalEditComponent.innerHTML = '';
        }
       else this.updateSidebar(id)
    });
  },
   beforeDestroy() {
    $eventBus.$off(['FILE_MANAGER_UPDATE_SIDE_BAR']);
  }
}
</script>

