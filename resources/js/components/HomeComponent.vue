<template>
    <div class="container">
        <div class="columns">
            <div class="column is-4 ">
                <list-component></list-component>
            </div>
            <div class="column is-8">
                <product-component :products="items"></product-component>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                items: {},
            }
        },
        watch: {
            $route: 'fetchProduct'
        },
        created: function () {
            this.fetchProduct();
        },
        methods: {
            fetchProduct: function () {
                let id = this.$route.params.id ? this.$route.params.id : '';
                this.$http.get('/api/category/get_products/' + id)
                    .then((response) => {
                        this.items = response.body;
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
        }
    }
</script>
