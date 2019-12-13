<template>
    <li @click.stop.prevent="isExpanded">
        <router-link :to="'/'+model.id">{{model.name}} {{model.id}}
            <div class="dropdown is-pulled-right is-bottom-left is-mobile-modal is-active"
                 @click.stop.prevent="toggleDropdown">
                <div role="button" aria-haspopup="true" class="dropdown-trigger"><span class="icon">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </span>
                </div>
                <div v-if="showDropdown" v-on:mouseleave="toggleDropdown" class="dropdown-menu">
                    <div class="dropdown-content">
                        <p class="dropdown-item" @click="removeModel">
                            Удалить
                        </p>
                        <p class="dropdown-item" @click="openForm">
                            Добавить Категорию
                        </p>
                    </div>
                </div>
            </div>
        </router-link>
        <ul v-if="isFolder" v-show="expanded">
            <item-component class="item" :bus="bus" v-for="model in model.children" :model="model" :key="model.id">
            </item-component>
        </ul>
    </li>
</template>

<script>
    export default {
        props: {
            model: Object,
            bus: Object,

        },
        data: function () {
            return {
                expanded: false,
                showDropdown: false,
                open: false,
            }
        },
        computed: {
            isFolder: function () {
                return this.model.children &&
                    this.model.children.length
            }
        },
        methods: {
            tetst: function () {
                console.log()
            },

            isExpanded: function () {
                console.log('isExpanded')
                this.expanded = !this.expanded;
            },
            toggle: function () {
                if (this.isFolder) {
                    this.open = !this.open;
                    this.bus.$emit('toggled', this.id);
                }
            },
            changeType: function () {
                if (!this.isFolder) {
                    this.addChild();
                    this.open = true
                }
            },
            addChild: function () {


                this.bus.$emit('add-category', this.model);

            },
            removeModel: function () {
                this.bus.$emit('removeCat', this.model);
            },
            toggleDropdown(e) {

                this.showDropdown = !this.showDropdown
            },
            openForm() {
                this.bus.$emit('open-form', this.model);
            }
        }
    }

</script>
