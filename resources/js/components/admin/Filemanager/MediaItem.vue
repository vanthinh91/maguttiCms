<template>
  <div @click="updateItem(media.id)" class="thumbnail-item">
    <img v-if="media.media_type=='images'"  :src="media.cover_image" :title="media.title"/>
    <cover-icon v-else :icon="media.icon"/>
    <div class="thumbnail-caption">{{ media.title }}</div>
  </div>
</template>
<script>
import CoverIcon from './CoverComponent'


export default {
  name: "MediaItem",
  components: {
    CoverIcon,
  },
  props: {
    media: {
      type: Object,
      required: true
    },
    eventName: {
      type: String
    }
  },
  methods: {
    updateItem(id) {
      $eventBus.$emit(this.eventName, id);
      $eventBus.$emit('FILE_MANAGER_UPDATE_SIDE_BAR', id);
    }
  },
}
</script>

<style scoped>

</style>