<template>
    <div>
        <p @click="itsOpen" v-show="!show">добавить категорию</p>
        <div v-show="show">
            <p v-if="menu">{{menu.name}} </p>
            <input class="input" v-model="newMenu" @keyup.enter="sendForm">
            {{newMenu}}
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                newMenu: ''
            }
        },
        props: ['show', 'menu', 'bus']
        , methods: {
            itsOpen: function () {
                this.bus.$emit('open-form', this.model);
            },
            sendForm() {
                this.bus.$emit('add-category', {menu: this.menu, newMenu: this.newMenu});
                this.bus.$emit('open-form', this.model);
                this.newMenu = '';
            }
        }
    }
</script>
