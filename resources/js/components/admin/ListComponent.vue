<template>
    <div>
        <h3>Contatti</h3>
        <div class="card  p-3 border border-dark">
            <form v-on:submit.prevent>
                <div class="form-row bg">
                    <div class="form-group col-md-6">
                        <label for="title">Titolo</label>
                        <input type='text' id="title" v-model.lazy="contact.title" class="form-control mb-1 mr-sm-2">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="link">Link</label>
                        <input id="link" type='text' v-model.lazy="contact.link" class="form-control mb-1 mr-sm-2">
                    </div>
                    <div class="form-row bg">
                        <div class="form-group col-md-12">
                            <select name="" id="" v-model="contact.template_id" class="form-control" @change="onChange($event)">
                                <option selected="true">Select template</option>
                                <option v-for="template in templates" :value="template.id">{{ template.title }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="Description">Description</label>
                        <editor id="Description" v-model="contact.description"></editor>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="sort" >Sort</label>
                        <input id="sort"  type='text' v-model.lazy="contact.sort" class="form-control mb-1 mr-sm-2">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="pub" >Status</label>
                        <input id="pub"  type='text' v-model.lazy="contact.pub" class="form-control mb-1 mr-sm-2">
                    </div>
                </div>

                <div class="form-row bg">
                    <div class="form-group col-md-12">
                        <button v-if="isEdit==false" @click.prevent="addItem" class="btn btn-success mb-2 btn-block"><i
                                class="fas fa-plus"></i> Add
                        </button>
                        <button v-else="isEdit==true" @click.prevent="updateItem" class="btn btn-danger mb-2 w-100"><i
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
                        <td>Tile</td>
                        <td>Link</td>
                        <td>Template</td>
                        <td>Note</td>
                        <td>Sort</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(contact,index) in list">
                        <td>{{ contact.title }}</td>
                        <td>{{ contact.link }}</td>
                        <td>{{ contact.template}}</td>
                        <td v-html="contact.description"></td>
                        <td>{{ contact.sort}}</td>
                        <td>{{ contact.pub}}</td>

                        <td><i @click="deleteItem(index)" class="px-1 fas fa-trash"></i>
                            <i @click="editItem(index)" class="px-1 fas fa-edit"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
<script>

    import Editor from '@tinymce/tinymce-vue'
    export default {
        props: ['items','selects'],
        components: {
            'editor': Editor
        },
        data() {
            return {
                contact: {},
                errors: [],
                selectedItem: '',
                template: '',
                isEdit: false,
                list: [],
                templates:[]
            }
        },
        created() {
            this.list = this.items;
            this.templates = this.selects;
        },
        methods: {
            onChange(event) {
                console.log(event.target.value);
                this.contact.template = this.templates[event.target.selectedIndex-1].title;
                console.log(this.contact.template_id);
            },
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
                tinymce.get('description').setContent('');
                this.list[this.selectedItem] = Object.assign({}, this.contact);
                this.clearForm();
            },
            aggiorna(a) {
                this.checkForm(a)
            },
            editItem(index) {
                this.selectedItem = index;
                this.contact = Object.assign({}, this.list[this.selectedItem]);
                tinymce.get('description').setContent(this.contact.description);
                this.isEdit = true;

            },
            clearForm() {
                this.contact = {};
                this.template="";
                this.isEdit = false;
                this.errors = [];
                tinymce.get('message').setContent('');
                console.log(this.list);
            },
            checkForm: function (item) {

                this.errors = [];
                if (!this.contact.title) {
                    this.errors.push('Name required.');
                }
                if (!this.contact.description) {
                    this.errors.push('Age required.');
                }
                if(this.errors.length>0) alert('validate');

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
