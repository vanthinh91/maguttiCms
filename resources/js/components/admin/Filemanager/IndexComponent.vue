<template>
  <div class="tab-images-gallery col-md-8 col-12">
    {{selected_item}}
    <search-box @update-search="updateSearchFilter"></search-box>
    <div class="row filemanager-list d-grid-lg gy-3" v-if="items">
      <media-item v-for="item in itemList"
                  :class="{active: selected_item === item.id}"
                  :media="item"
                  :event-name="'FILE_MANAGER_SELECT_ITEM'"
                  :key="'media_item_'+item.id">
      </media-item>
    </div>
  </div>
</template>

<script>
import {HTTP} from '../../../mixins/http-common';
import helper from '../../../mixins/helper';
import MediaItem from './MediaItem'
import SearchBox from './SearchBoxComponent'

export default {
  name: "file-manager-grid",
  components: {
    MediaItem,
    SearchBox
  },
  mixins: [helper],
  data() {
    return {
      items: [],
      selected_item: null,
      is_active: "is-active",
      searchText: ""
    }
  },
  methods: {
    fetchData: function (payload = null) {
      this.selected_item = payload;
      this.set_selected(payload);
      let self = this;
      let url = (payload) ? this.url() + '/' + this.selected_item : this.url();
      return HTTP.get(url)
          .then(this.refresh)
          .then((response) => {
            if (payload) self.updateSidebar(payload)
          })
          .catch(e => {
            self.errors.push(e)
            self.showMessage(e.message, self.ERROR_CLASS);
          })
    },
    url() {
      return window._SERVER_PATH + `/admin/api/file-manager/grid`;
    },
    updateSidebar(id) {
      // Set modal hidden value with media id
      this.selected_item = id;
      this.set_selected(id);
      axios.get(urlAjaxHandlerCms + 'filemanager/edit/' + id)
          .then(response => {
            this.$root.$refs.modalEditComponent.innerHTML = response.data;
          })
    },
    refresh({data}) {
      this.items = data.data
    },
    set_selected(id) {

      this.$root.$refs.fileInputValue.value = id;this.selected_item = id;
      if (this.selected_item === null) {
        this.$root.$refs.modalEditComponent.innerHTML = null;
      }
    },
    updateSearchFilter(value) {
      this.searchText = value;
    },
  },
  computed: {
    itemList() {
      return this.items.filter(item => {
            return (
                item.title.toLowerCase().includes(this.searchText.toLowerCase())
                ||
                item.media_type.toLowerCase().includes(this.searchText.toLowerCase())
                ||
                item.file_ext.toLowerCase().includes(this.searchText.toLowerCase())
            )
          }
      )
    }
  },
  mounted() {
    $eventBus.$on('FILE_MANAGER_LOAD_LIST', (payload) => {
      this.fetchData(payload);
    });
    $eventBus.$on('FILE_MANAGER_SELECT_ITEM', (id) => {
      this.updateSidebar(id);
    });
    $eventBus.$on('FILE_MANAGER_RESET', () => {
      this.set_selected(null);
    });


  },
  created() {
    this.$nextTick(function () {
          this.fetchData(1);
        }
    )
  },
  beforeDestroy() {
    $eventBus.$off('FILE_MANAGER_LOAD_LIST');
    $eventBus.$off('FILE_MANAGER_RESET');
    $eventBus.$off('FILE_MANAGER_SELECT_ITEM');
  }
}
</script>
