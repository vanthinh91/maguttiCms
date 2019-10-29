<template>
    <div>
        <h3>Contatti</h3>
        <div class="card  p-3 border border-dark">
            <form v-on:submit.prevent>
            <div class="form-row w-100 my-3">
                    <ul class="ist-group list-group-horizontal list-group-item ml-auto border-0 px-0">
                        <li v-for="(value, key) in lang" :key="key" class="list-inline-item  py-1 px-2"
                            v-bind:class="{'bg-primary text-white':(curLang===key)}"
                            @click="changeLang(key)">{{ value }}
                        </li>
                    </ul>
                </div>
                <div class="form-row bg">
                    <input-component
                        class="mb-1 mr-sm-2 col-1"
                        :content.sync="contact.id"
                        placeholder="Item Id"/>
                    <input-component
                        label="Title"
                        :content.sync="contact.title"
                        placeholder="Enter a title"
                        v-show="this.curLang=='en'"/>
                    <div v-for="(value, key) in lang" :key="key" class="form-group col-md-6 " v-if="key=='it'"
                         v-show="curLang==key">
                        <label for="title">Titolo {{key}}</label>
                        <input type='text' id="title_it" v-model.lazy="contact.title_it"
                               class="form-control mb-1 mr-sm-2">
                    </div>
                    <div v-for="(value, key) in lang" :key="key" class="form-group col-md-6 "
                         v-show="curLang==key">
                        <label for="title">Titolo {{key}}</label>
                        <input type="text" id="key" v-model.lazy="contact.title"
                               class="form-control mb-1 mr-sm-2">
                    </div>


                    <div class="form-group col-md-6 d-none">
                        <label for="link">Link</label>
                        <input id="link" type='text' v-model.lazy="contact.link" class="form-control mb-1 mr-sm-2">
                    </div>

                    <div class="form-group col-12 d-none">
                        <label for="template_id">Template</label>
                        <select name="" id="" v-model="contact.template_id" class="form-control"
                                @change="onChange($event)">
                            <option selected="true">Select template</option>
                            <option v-for="template in templates" :value="template.id">{{ template.title }}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12" v-show="this.curLang=='en'">
                        <label for="description">Description</label>
                        <editor id="description" v-model="contact.description"></editor>
                    </div>

                    <div class="form-group col-md-12" v-show="this.curLang=='it'">
                        <label for="description_it">Description IT</label>
                        <editor id="description_it" v-model="contact.description_it"></editor>
                    </div>
                </div>


                <div class="row form-group d-none">
                    <div class="col-12">
                        <label for="Image File Manager">Image File Manager</label>
                        <input id="image_media_id" name="image_media_id"
                               ref="image_media_id"
                               type="hidden 1" value="4" class=" form-control ">
                        <div class="media-cont">
                            <div class="media-input">
                                <a href="#" data-input="image_media_id" class="btn btn-default filemanager-select">
                                    <i class="fas fa-upload "></i> Upload file
                                </a></div>
                            <div id="box_image_media_id_1" class="media-saved">
                                <div><a href="http://magutticms.test/media/images/esn-website-comingsoon.jpeg"
                                        target="_blank"><img
                                        src="/media/images/cache/esn-website-comingsoon_jpeg_100_100_cover_50.jpg"
                                        class="img-thumb pull-right"></a></div>
                                <a id="delete-image_media_id-1" data-locale="" href="#" rel="tooltip"
                                   data-original-title="Delete this item" onclick="window.Cms.deleteImages(this)"
                                   class="btn btn-danger media-delete"><i class="fas fa-trash "></i></a></div>
                        </div>
                    </div>
                </div>

                <div class="form-row bg d-none">

                    <div class="form-group col-md-1">
                        <label for="sort">Sort</label>
                        <input id="sort" type='text' v-model.lazy="contact.sort" class="form-control mb-1 mr-sm-2">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="pub">Status</label>
                        <input id="pub" type='text' v-model.lazy="contact.pub" class="form-control mb-1 mr-sm-2">
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
                        <td>Id</td>
                        <td>Title</td>
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
                        <td>{{ contact.id }}</td>
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
    import {HTTP} from './../../mixins/http-common';
    import inputComponent from './InputComponent';

    export default {
        props: ['items', 'selects', 'lang'],
        components: {
            'editor': Editor,
            inputComponent
        },
        data() {
            return {
                contact: {},
                errors: [],
                selectedItem: '',
                template: '',
                isEdit: false,
                list: [],
                templates: [],
                curLang: null
            }
        },
        created() {
            this.list = this.items;
            this.templates = this.selects;
            this.curLang = Object.keys(this.lang)[0];
        },
        methods: {
            onChange(event) {
                console.log(event.target.value);
                this.contact.template = this.templates[event.target.selectedIndex - 1].title;
                console.log(this.contact.template_id);
            },
            changeLang(locale) {
                this.curLang = locale;
            },
            addItem() {
                if (!this.checkForm(this.contact)) return;
                let url = "/admin/api/create/block";
                this.contact.model_id = 2;
                this.contact.model_type = "App\\Article";
                let self = this;
                let data = this.contact;

                HTTP.post(url, this.contact)
                    .then(function (response) {
                        self.contact.id = response.data.id;

                        self.list.push(Object.assign({}, self.contact));
                        self.clearForm();
                    })
                    .catch(e => {
                        //self.errors.push(e)
                        alert(e.message)
                        //self.showMessage(e.message, self.ERROR_CLASS);
                    })

            },
            deleteItem(index) {
                let self = this;
                let id = self.list[index].id
                let url = window.urlAjaxHandlerCms + 'delete/block/' + id;
                bootbox.setLocale(_LOCALE);
                bootbox.confirm("<h4>Are you sure?</h4>", function (confirmed) {
                    if (confirmed) {
                        console.log(self.list[index].id);
                        HTTP.get(url)
                            .then(function (response) {
                                // handle success
                                console.log(response);
                                if (response.data.status == 'ok') {
                                    self.list.splice(index, 1);
                                    self.clearForm();
                                } else alert(response.data.status);

                            })
                            .catch(function (error) {
                                // handle error
                                console.log(error);
                            })
                            .finally(function () {
                                // always executed
                            });
                    }
                });
            },
            updateItem() {

                alert(this.contact.title);
                if (!this.checkForm(this.contact)) return;
                this.contact.image_media_id = this.$refs.image_media_id.value;
                this.list[this.selectedItem] = Object.assign({}, this.contact);

                this.clearForm();
            },
            aggiorna(a) {
                this.checkForm(a)
            },
            editItem(index) {
                this.selectedItem = index;
                this.contact = Object.assign({}, this.list[this.selectedItem]);
                this.updateTiny(this.contact.description);
                this.$refs.image_media_id.value = this.contact.image_media_id;
                this.isEdit = true;

            },
            clearForm() {
                this.contact = {};
                this.template = "";
                this.isEdit = false;
                this.errors = [];
                this.updateTiny('');
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
                if (this.errors.length > 0) alert('validate');
                else return true;

                //e.preventDefault();
            },
            setFocus: function () {
                // Note, you need to add a ref="search" attribute to your input.
                this.$refs.name.focus();
            },
            updateTiny: function (content) {
                tinymce.get('description').setContent(content);
            }
        },
        mounted() {
            console.log('LIST')
        },
    }
</script>
