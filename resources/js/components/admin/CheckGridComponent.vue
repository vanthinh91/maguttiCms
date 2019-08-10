<template>
    <div class="col-xs-12 location-set-multi-checkboxes-container bg-light p-3 border rounded">
        <div class="btn-group mb-2">

            <button type="button" class="btn btn-info">
                <span class="city-name">Select</span>
                <input type="checkbox" class="checkbox-inline" v-model="allSelected" @change="selectAll"/>
            </button>
            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle</span>
            </button>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" @click.prevent="actionSelect(true)">Select All</a>
                <a class="dropdown-item" href="#" @click.prevent="actionSelect(false)"> Deselect All</a>
            </div>
        </div>
        <div class="row">
            <div v-for="item in items" class="col-xs-12 col-sm-6 col-lg-4">
                <input
                        v-model="item.active" @click="select" :value="item.id"
                        :name=" field + '[]'"
                        type="checkbox"> {{ item.title}}
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['data', 'field', 'value'],
        data() {
            return {
                items: {},
                selectedItems: [],
                allSelected: false,
            }
        },
        mounted() {
            this.items = this.data;
            this.selectedItems = this.value;
            this.setSelected();
        },
        methods: {
            selectAll: function () {
                for (let item in this.items) {
                    this.items[item].active = this.allSelected;
                }
            },
            setSelected() {
                for (let item in this.items) {
                    this.items[item].active = this.selectedItems.includes(this.items[item].id);
                }
            },
            select: function () {
                this.allSelected = false;
            },
            actionSelect: function (status) {
                this.allSelected = status;
                this.selectAll();
            }
        }
    }
</script>
