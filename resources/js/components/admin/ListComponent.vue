<template>
    <div>
        <h3>Contatti</h3>
        <form class="form-inline" v-on:submit.prevent>
            <input type="text" class="form-control mb-2 mr-sm-2" v-model.lazy="contact.id" placeholder="id">
            <label class="sr-only">Name</label>
            <input ref="name" type="text" class="form-control mb-2 mr-sm-2" v-model.lazy="contact.name" placeholder="name">

            <label class="sr-only">Surname</label>
            <input type="text" class="form-control" v-model="contact.surname" placeholder="surname">
            <label class="sr-only">email</label>
            <input type="text" class="form-control" v-model="contact.email" placeholder="email">

            <select v-model="contact.social" class="form-control">
                <!-- inline object literal -->

                <option v-for="node in items" :value="node.id">{{node.title}}</option>
            </select>
            <button v-if="isEdit==false" @click.prevent="addItem" class="btn btn-primary mb-2"><i
                    class="fas fa-plus"></i> Add</button>
            <button v-else="isEdit==true" @click.prevent="updateItem" class="btn btn-primary mb-2"><i
                    class="fas fa-edit"></i> Update</button>
        </form>
        <ul v-for="(contact,index) in list">
            <li class="py-1">{{ index }} {{ contact.name }} - {{ contact.surname }}
                <input type='text' v-model="contact.name" class="form-control mb-2 mr-sm-2">

                <i @click="deleteItem(index)"
                                                                                       class="px-1 fas fa-trash"></i>
                <i @click="editItem(index)" class="px-1 fas fa-edit"></i>

                <i @click="aggiorna(contact)" class="px-1 fas fa-save">s</i>
            </li>
        </ul>
    </div>
</template>
<script>
    import {HTTP} from './../../mixins/http-common';
    import helper from '../../mixins/helper';
    export default {
        mixins: [helper],
        props: ['currentSection'],
        data() {
            return {
                contact: {},
                errors:[],
                selectedItem: '',
                isEdit: false,
                list: [],
                items: []
            }
        },
        methods: {
            fetchData: function () {
                let self = this;
                return HTTP.get(this.url())
                    .then(this.refresh)
                    .catch(e => {
                        self.errors.push(e);
                        self.showMessage(e.message, self.ERROR_CLASS);
                    })
            },
            url() {
                return '/admin/api/services/social';
            },
            refresh({data}) {
                this.items = data.data.data;
                console.log(this.items)
            },
            addItem() {
                if(!this.checkForm(this.contact)) return;
                this.list.push(Object.assign({}, this.contact));
                this.clearForm();
            },
            deleteItem(index) {
                this.list.splice(index, 1);
                this.clearForm();
            },
            updateItem() {
                if(!this.checkForm(this.contact)) return;
                this.list[this.selectedItem] = Object.assign({}, this.contact);
                this.clearForm();
            },
            aggiorna(a) {
                this.checkForm(a)
            },
            editItem(index) {
                this.selectedItem = index;
                this.contact = Object.assign({}, this.list[this.selectedItem]);
                this.isEdit = true;
                //.this.setFocus();
            },
            clearForm(){
                this.contact = {};
                this.isEdit = false;
                this.errors = [];
                console.log(this.list);
            },
            checkForm: function (item) {
                if (item.name && item.surname) {
                    return true;
                }
                this.errors = [];
                if (!this.contact.name) {
                    this.errors.push('Name required.');
                }
                if (!this.contact.surname) {
                    this.errors.push('Age required.');
                }
                alert('validate');

                //e.preventDefault();
            },
            setFocus: function()
            {
                // Note, you need to add a ref="search" attribute to your input.
                this.$refs.name.focus();
            }
        },
        mounted() {
            console.log('LIST')
        },
        created() {
            this.fetchData();
        },
    }
</script>
