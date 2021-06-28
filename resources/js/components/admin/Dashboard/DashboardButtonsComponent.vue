<template>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5 gx-4
  dashboard-search align-items-center">
     <DashBoardSearch
        v-model:section="form.section"
        v-model:searchText="form.searchText"

    />
   </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5 gx-4  dashboard-menu bg-light ">
    <dashboard-item v-for="(item, index) in dashBoardItem" :item="item" :key="index"/>
  </div>

</template>

<script>
import {reactive, onMounted, ref,computed} from 'vue'

import DashboardItem from './DashboardButtonComponent'
import DashBoardSearch from './SearchBoxComponent'
import DashboardRepository from '../repository/DashboardRepository'

import helper from '../../../mixins/helper';
import {HTTP} from "../../../mixins/http-common";

export default {
  mixins: [helper,DashboardRepository],
  components: {
    DashboardItem,
    DashBoardSearch
  },
   setup(props, {emit}) {
    const form = reactive({
      section: '',
      searchText: '',

    })
    const items=reactive([])
     onMounted(async () => {
       await getData();
    });

   async function getData()
     {
       HTTP.
       get(window._SERVER_PATH + `/admin/api/dashboard`)
           .then(({data}) =>{
             items.value = data.data;
           })
           .finally()
     }
     const dashBoardItem = computed(() => { // <-------
       if(items.value){
         return items.value.filter(item => {
               return (
                   item.title.toLowerCase().includes(form.searchText.toLowerCase())
                   &&
                   item.section.toLowerCase().includes(form.section.toLowerCase())
               )
             }
         )
       }
     });
     return {form,dashBoardItem}
  },



}
</script>
