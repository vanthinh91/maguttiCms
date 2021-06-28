<template>
  <carousel :pagination-padding=4  paginationActiveColor="#3B5696" paginationColor="#ddd4d4" :per-page=1 easing="linear" >
    <slide>
      <img src="https://travelmate.comunichiamo.eu/media/images/assisi.jpeg" alt="MaguttiCms" class="img-fluid w-100">
    </slide>
    <slide>
      <img src="https://travelmate.comunichiamo.eu/media/images/logo-share.jpeg" alt="MaguttiCms" class="img-fluid w-100">
    </slide>
    <slide>
      <img src="https://travelmate.comunichiamo.eu/media/images/logo-share.jpeg" alt="MaguttiCms" class="img-fluid w-100">
    </slide>
    <slide>
      <img src="https://travelmate.comunichiamo.eu/media/images/assisi.jpeg" alt="MaguttiCms" class="img-fluid w-100">
    </slide>
    <slide>
      <img src="https://travelmate.comunichiamo.eu/media/images/logo-share.jpeg" alt="MaguttiCms" class="img-fluid w-100">
    </slide>
    <slide>
      <img src="https://travelmate.comunichiamo.eu/media/images/assisi.jpeg" alt="MaguttiCms" class="img-fluid w-100">
    </slide>

  </carousel>
</template>

<script>
import {Carousel, Slide} from 'vue-carousel'

export default {
  data: () => ({
    socialElements: []
  }),
  components: {
    Carousel,
    Slide
  },


}
</script>
<style scoped>


</style>
