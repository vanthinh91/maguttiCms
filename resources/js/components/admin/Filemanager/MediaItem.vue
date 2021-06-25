<template>
  <div class="col-6 col-xl-2 col-lg-3 col-md-3">
    <div @click="updateItem(media.id)"  class="thumbnail-item">
      <img class="":src="media.cover_image" :alt="media.title" :title="media.title" v-if="media.media_type=='images'"/>
      <cover-icon :icon="media.icon" v-else />
      <div class="thumbnail-caption">
        {{ media.title }} {{ media.id }}
      </div>
    </div>
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
      required:true
    },
    eventName:{
      type:String
    }
  },
  methods: {
    updateItem(id) {
      $eventBus.$emit(this.eventName, id );
    }
  },
}
</script>

<style scoped>

</style>