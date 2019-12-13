<template>
    <div>
        <category-form-component :bus="bus" :show="show" :menu="menu"></category-form-component>
    <ul class="menu-list">
        <item-component v-for="category in categories" class="item" :bus="bus" :model="category" :key="category.id"></item-component>
    </ul>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                categories: [],
                bus: new Vue(),
                show: false,
                menu: null,
            }
        },
        mounted() {
            console.log('path: ' + this.$route.path);
        },
        created() {
            this.fetchCategories();
            this.bus.$on('toggled', (who) => {
                console.log("Toggled", who);
            });
            this.bus.$on('add-category', (who) => {
                console.log(who)
                this.$http.post('/api/category',who).then((response) => {
                    if (!who.menu) {
                        return this.categories.push(response.body)
                    }
                    addCategory(who, response.body, this.categories);
                });

                function addCategory (who,response,items) {
                    items.forEach(function (e) {
                        if(e.id == who.menu.id) {
                            e.children.push(response);

                        }
                        if(e.children && e.children.length){
                            addCategory(who,response,e.children)
                        }
                    });
                }
            });
            this.bus.$on('removeCat', (item) => {
                    this.$http.delete('/api/category/'+item.id,).then((response) => {
                        searchCategory(item, this.categories);
                    });

                function searchCategory (item,items) {
                    items.forEach(function (e,index) {
                        if(e.id == item.id) {
                            items.splice(index, 1);
                        }
                        if(e.children && e.children.length){
                            searchCategory(item,e.children)
                        }
                    });
                }
            });
            this.bus.$on('open-form', (item) => {
                this.menu = item;
                this.show = !this.show;
            });
        },
        methods : {
            fetchCategories() {
                {
                    this.$http.get('/api/category').then((response) => {
                        this.categories = response.body;
                    });
                }
            },
        }
    }
</script>
