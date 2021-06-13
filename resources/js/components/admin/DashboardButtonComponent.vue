<template>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
     <div class="dashboard-card">
       <a class="dashboard-card-body" :href="item.url" :target="item.target ? item.target : null">
         <div class="button">
           <i :class="item.iconClass+' fa-fw fa-5x '"></i>
           <h3>{{item.title}}</h3>
         </div>
       </a>
       <div class="dashboard-card-footer d-flex justify-content-between">
         <div class="dashboard-card-footer-counter">
           <span class="badge rounded-pill bg-info">{{ item.pills }}</span>
         </div>
         <div v-if="item.footer_url!==''" class="dashboard-card-footer-action">
           <a :href="item.footer_url" :target="item.target ? item.target : null">
           <i :class="item.footer_icon ? item.footer_icon:'fas fa-plus-circle'+' fa-lg'"></i>
         </a>
         </div>
         <div v-else-if="item.total!==''" class="dashboard-card-footer-action">
             <span class="badge rounded-pill bg-info">{{ item.total }}</span>
         </div>

       </div>
     </div>


    </div>
</template>

<script>
    export default {
        props: ['item'],
        data() {
            return {
                show: false,
                activeClass: 'btn-success'
            }
        },

        mounted() {}
    }
</script>
