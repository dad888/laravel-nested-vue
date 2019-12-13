<template>
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img :src="product.image" alt="Placeholder image">
            </figure>
        </div>
        <form @submit.prevent="submitForm" method="POST">
            <div class="card-content">

                <div class="media">
                    <div class="media-content">
                        <p class="title is-4 has-text-centered">{{product.name}}</p>
                        <input class="input" type="text" name="product.name" v-model="product.name" v-if="showForm">
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <button class="card-footer-item" v-if="showForm" type="submit" value="Submit"
                        @click.prevent="submitForm">Save
                </button>
                <a href="#" class="card-footer-item" @click="editProduct">Edit</a>
                <a href="#" class="card-footer-item" @click="deleteProduct">Delete</a>
            </footer>
        </form>
    </div>

</template>
<script>
    export default {
        props: {
            product: Object,
            index: Number,
        },
        data() {
            return {
                showForm: false
            }
        },
        methods: {
            deleteProduct() {
                this.$http.delete('/api/product/' + this.product.id,).then(() => {
                    this.$emit('del-product', this.index)
                })
            },
            editProduct() {
                this.showForm = !this.showForm;
            },
            submitForm() {
                let formData = new FormData();
                formData.append('name', this.product.name);
                this.$http.patch('/api/product/' + this.product.id, formData)
                    .then(() => {
                        this.editProduct()
                    })
                    .catch((error) => {
                        console.log(error.body.message)
                    });
            }
        }
    }
</script>
