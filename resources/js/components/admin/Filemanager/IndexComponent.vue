<template>
  <div class="tab-images-gallery col-md-8 col-12">

    <search-box @update-search="updateSearchFilter"></search-box>
    <div class="row filemanager-list d-grid-lg gy-3" v-if="items">
      <div class="col-6 col-xl-2 col-lg-3 col-md-3" v-for="item in itemList">
        <media-item
            :class="{active: selected_item == item.id}"
            :media="item"
            :event-name="'FILE_MANAGER_SELECT_ITEM'"
            :key="'media_item_'+item.id">
        </media-item>
      </div>
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
      searchText: ""
    }
  },
  methods: {
    fetchData: function (payload = null) {
      let self = this;
      let url = (payload) ? this.url() + '/' + payload : this.url();
      return HTTP.get(url)
          .then(this.refresh)
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
      axios.get(urlAjaxHandlerCms + 'filemanager/edit/' + id)
          .then(response => {
            this.$root.$refs.modalEditComponent.innerHTML = response.data;
          })
    },

    refresh({data}) {
      this.items = data.data
    },
    set_selected(id) {
      this.selected_item = id;
      this.$root.$refs.fileInputValue.value = id;
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
      this.set_selected(id);
      this.updateSidebar(id)
    });
    $eventBus.$on('FILE_MANAGER_RESET', () => {
      this.set_selected(null);
    });
  },
  created() {
    this.$nextTick(function () {
        }
    )
  },
  beforeDestroy() {
    $eventBus.$off(['FILE_MANAGER_LOAD_LIST','FILE_MANAGER_RESET']);
    $eventBus.$off('FILE_MANAGER_SELECT_ITEM');

  }
}
</script>
