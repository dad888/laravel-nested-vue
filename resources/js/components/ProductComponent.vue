<template>
    <div>
        <section class="hero is-info welcome is-small">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title" v-if="products.category">
                        {{products.category.name}}
                    </h1>
                </div>
            </div>
        </section>
        <new-product-component v-if="products.category&&products.category.id" :id="products.category.id" @add-product="addProduct"> </new-product-component>
        <section class="section">
            <div class="container-product">
                <product-item-component v-for="(product,index) in products.products"
                                        :product="product"
                                        :openForm="showForm"
                                        @show-form-toggle="showFormToggle"
                                        :index="(index)"
                                        @del-product="deleteProduct"
                                        :key="product.id">
                </product-item-component>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showForm: true
            }
        },
        props: {
            products: Object
        },
        methods: {
            deleteProduct(id) {
                this.$delete(this.products.products, id)
            },
            showFormToggle() {
                this.showForm = !this.showForm;
            },
            addProduct(item) {
                console.log('add')
                console.log(item)
                this.products.products.push(item);

            }
        }
    }
</script>
<style>
    .container-product {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-gap: 0.5em;
    }

    .card {
        height: max-content;
    }
</style>
