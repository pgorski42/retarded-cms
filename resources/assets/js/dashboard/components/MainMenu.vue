<template>
    <nav class="navbar rcms-menu" id="mainMenu">
        <router-link class="rcms-logo" :to="{ name: 'main'}">R</router-link>
        <nav class="navbar-nav mr-auto">
            <router-link v-for="entry in menu" :key="entry.routeName" class="nav-link" :to="{ name: entry.routeName}">
                <div>{{ entry.button }}</div>
            </router-link>
        </nav>
        <section class="rcms-menu-bottom">
            <transition name="fade">
                <router-view name="submenu"></router-view>
            </transition>
        </section>
    </nav>
</template>

<script>
    export default {
        computed: {
            menu: function () {
                return this.$store.getters['ui/menu'];
            }
        }
    }
</script>