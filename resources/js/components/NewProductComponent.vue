<template>
    <section class="product-form has-text-centered">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <button class="button" @click="isOpenForm">Новый товар</button>
                    <div v-if="isOpen">
                        <form method="POST" action="/admin/image" enctype="multipart/form-data">
                            <div class="field">
                                <label class="label"></label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="название" v-model="name">
                                </div>
                            </div>
                            <div class="file is-centered">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="image" @change="onImageSelected">
                                    <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                    <span class="file-label">картинка</span>
                                </span>
                                </label>
                            </div>
                            <div class="column">
                            <button type="submit" class="button is-success"
                                    @click.prevent="sendForm"
                                    :disabled="!name || this.selectedImage.length"
                            >Сохранить
                            </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                isOpen: false,
                selectedImage: '',
                name: '',
            }
        },
        props: {
            id: Number
        },
        computed: {
            isDisabled: function () {
                console.log(this.name)

                return this.name;
            }
        },
        methods: {
            isOpenForm: function () {
                this.isOpen = !this.isOpen
            },
            sendForm() {

                console.log(this.selectedImage)
                let formData = new FormData();
                formData.append('id', this.id);
                formData.append('name', this.name);
                formData.append('image', this.selectedImage);
                this.$http.post('api/product', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        this.$emit('add-product',response.body)
                        this.clear();
                    })
                    .catch((error) => {
                        console.log(error.body.message)
                    });
                console.log(this.name, this.selectedImage, this.id)
            },
            onImageSelected(event) {
                this.selectedImage = event.target.files[0];
            },
            clear() {
                this.selectedImage = '';
                this.name = '';
                this.isOpenForm()
            }
        }
    }
</script>
<style>
    .product-form {
        margin-top: 40px;
    }
</style>
