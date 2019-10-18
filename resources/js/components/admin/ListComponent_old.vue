<template>
    <div>
        <h3>Contatti</h3>
        <div class="card  p-3 border border-dark">
            <form v-on:submit.prevent>
                <div class="form-row bg">
                    <div class="form-group col-md-4">
                        <label for="name">Name</label>
                        <input type='text' id="name" v-model.lazy="contact.name" class="form-control mb-1 mr-sm-2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="surname">Surname</label>
                        <input id="surname" type='text' v-model.lazy="contact.surname"
                               class="form-control mb-1 mr-sm-2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input id="email" type='text' v-model.lazy="contact.email" class="form-control mb-1 mr-sm-2">
                    </div>
                </div>
                <div class="form-row bg">
                    <div class="form-group col-md-12">
                        <button v-if="isEdit==false" @click.prevent="addItem" class="btn btn-primary mb-2 btn-block"><i
                                class="fas fa-plus"></i> Add
                        </button>
                        <button v-else="isEdit==true" @click.prevent="updateItem" class="btn btn-primary mb-2 w-100"><i
                                class="fas fa-edit"></i> Update
                        </button>
                    </div>
                </div>
            </form>
            <hr/>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Cognome</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(contact,index) in list">
                        <td>{{ contact.name }}</td>
                        <td>{{ contact.surname }}</td>
                        <td>{{ contact.email }}</td>
                        <td><i @click="deleteItem(index)" class="px-1 fas fa-trash"></i>
                            <i @click="editItem(index)" class="px-1 fas fa-edit"></i>

                            <i @click="aggiorna(contact)" class="px-1 fas fa-save"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <ul v-for="(contact,index) in list" class="list-unstyled">
                <li class="py-1">{{ contact.id }} {{ contact.name }} - {{ contact.surname }}- {{ contact.email }}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="contact_name">Name</label>
                            <input type='text' id="contact_name" v-model="contact.name"
                                   class="form-control mb-2 mr-sm-2">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contact_surname">Surname</label>
                            <input id="contact_surname" type='text' v-model="contact.surname"
                                   class="form-control mb-2 mr-sm-2">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contact_email">Email</label>
                            <input id="contact_email" type='text' v-model="contact.email"
                                   class="form-control mb-2 mr-sm-2">
                        </div>
                    </div>


                    <i @click="deleteItem(index)" class="px-1 fas fa-trash"></i>
                    <i @click="editItem(index)" class="px-1 fas fa-edit"></i>

                    <i @click="aggiorna(contact)" class="px-1 fas fa-save">s</i>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'
    export default {
        props: ['items'],
        components: {
            'editor': Editor
        },
        data() {
            return {
                contact: {},
                errors: [],
                selectedItem: '',
                isEdit: false,
                list: []
            }
        },
        created() {
            this.list = this.items;
        },
        methods: {
            addItem() {
                if (!this.checkForm(this.contact)) return;
                this.list.push(Object.assign({}, this.contact));
                this.clearForm();
            },
            deleteItem(index) {
                this.list.splice(index, 1);
                this.clearForm();
            },
            updateItem() {
                if (!this.checkForm(this.contact)) return;
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
                //this.setFocus();
            },
            clearForm() {
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
            setFocus: function () {
                // Note, you need to add a ref="search" attribute to your input.
                this.$refs.name.focus();
            }
        },
        mounted() {
            console.log('LIST')
        },
    }
</script>
