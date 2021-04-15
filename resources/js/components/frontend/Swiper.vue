<template>
  <swiper ref="mySwiper" :options="swiperOptions">
    <swiper-slide><img src="https://travelmate.comunichiamo.eu/media/images/assisi.jpeg" alt="MaguttiCms" class="img-fluid w-100"></swiper-slide>
    <swiper-slide><img src="https://travelmate.comunichiamo.eu/media/images/logo-share.jpeg" alt="MaguttiCms" class="img-fluid w-100"></swiper-slide>
    <swiper-slide><img src="https://travelmate.comunichiamo.eu/media/images/assisi.jpeg" alt="MaguttiCms" class="img-fluid w-100"></swiper-slide>
    <swiper-slide><img src="https://travelmate.comunichiamo.eu/media/images/logo-share.jpeg" alt="MaguttiCms" class="img-fluid w-100"></swiper-slide>
    <swiper-slide><img src="https://travelmate.comunichiamo.eu/media/images/assisi.jpeg" alt="MaguttiCms" class="img-fluid w-100"></swiper-slide>
    <swiper-slide><img src="https://travelmate.comunichiamo.eu/media/images/logo-share.jpeg" alt="MaguttiCms" class="img-fluid w-100"></swiper-slide>
    <div class="swiper-pagination" slot="pagination"></div>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'


export default {
  data() {
    return {
      swiperOptions: {
        pagination: {
          el: '.swiper-pagination',
          clickable: true
        },
        // Some Swiper option/callback...
      }
    }
  },
  computed: {
    swiper() {
      return this.$refs.mySwiper.$swiper
    }
  },
  components: {
    Swiper,
    SwiperSlide
  },
  directives: {
    swiper: directive
  }


}
</script>
<style>


</style>
