<template lang="pug">
    .container
        img#loader(src="../assets/loader.gif" v-show="isLoaderVisible")
        ul#planet-list
            router-link.planet-list-item(v-for="planet in planets" :key="planet.id" tag="li" :to="'/' + planet.id")
                | {{planet.name}}
        ul#pagination
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

                isLoaderVisible: false,
                isPaginationLocked: false
            }
        },
        methods: {
            onPageChanged(page) {
                if (this.isPaginationLocked)
                    return;
                if (page === this.currentPage)
                    return;

                this.getData(page);
            },
            getData(page) {
                this.planets = [];
                this.isLoaderVisible = true;
                this.isPaginationLocked = true;
                this.$store.dispatch('getPlanets', page)
                    .then(data => {
                        this.isLoaderVisible = false;

                        this.lastPage = data.last_page;
                        this.currentPage = data.current_page;
                        this.planets = data.data;

                        this.isPaginationLocked = false;
                    })
            },
        },
        created() {
            this.getData(1)
        }
    }
</script>

<style scoped lang="stylus">
    .container
        width max-content
        margin 0 auto
        text-align center
        position relative

    #loader
        width 50px
        position absolute
        top 110px

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
