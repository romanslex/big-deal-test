<template lang="pug">
    .container
        input#search(@keyup.enter="search" v-model="s" :disabled="isActionsLocked" placeholder="Поиск (enter)")
        img#loader(src="../assets/loader.gif" v-show="isLoaderVisible")
        #not-found(v-show="!isLoaderVisible && planets.length === 0") Нет таких планет
        ul#planet-list
            router-link.planet-list-item(v-for="planet in planets" :key="planet.id" tag="li" :to="'/' + planet.id")
                | {{planet.name}}
        ul#pagination(v-show="lastPage > 1")
            li.pagination-item(
            v-for="n in lastPage" :key="n"
            :class="{'current': n === currentPage}"
            @click="onPageChanged(n)"
            ) {{n}}
</template>

<script>
    export default {
        data() {
            return {
                planets: [],
                lastPage: 1,
                currentPage: 1,

                s: "",

                isLoaderVisible: false,
                isActionsLocked: false
            }
        },
        methods: {
            onPageChanged(page) {
                if (this.isActionsLocked)
                    return;
                if (page === this.currentPage)
                    return;

                this.getData(page, this.s);
            },
            search() {
                this.getData(1, this.s);
            },
            getData(page, searchStr) {
                this.planets = [];
                this.isLoaderVisible = true;
                this.isActionsLocked = true;
                this.$store.dispatch('getPlanets', {
                    page: page,
                    search: searchStr
                })
                    .then(data => {
                        this.isLoaderVisible = false;

                        this.lastPage = data.last_page;
                        this.currentPage = data.current_page;
                        this.planets = data.data;

                        this.isActionsLocked = false;
                    })
            },
        },
        created() {
            this.getData(1, this.s)
        }
    }
</script>

<style scoped lang="stylus">
    .container
        width max-content
        margin 0 auto
        text-align center
        position relative

    #search
        padding 5px 10px
        font-size 20px
        font-weight 100
        font-family 'Open Sans'

    #loader
        width 50px
        position absolute
        top 173px
        left 50%
        transform translate(-50%)

    ul
        padding 0

    ul#planet-list
        list-style none
        height 280px

        li
            cursor pointer

    ul#pagination
        display flex
        justify-content center
        list-style none

        li
            display grid
            height 35px
            width 35px
            font-size 12px
            align-content center
            justify-content center
            cursor pointer

            &.current
                border solid 1px #3497dc
                border-radius 50%

</style>
