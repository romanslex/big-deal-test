<template lang="pug">
    .container
        ul#planet-list
            li.planet-list-item(v-for="planet in planets" :key="planet.url")
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
            }
        },
        methods: {
            onPageChanged(page){
                if(page === this.currentPage)
                    return;

                this.getData(page);
            },
            getData(page) {
                this.$store.dispatch('getPlanets', page)
                    .then(data => {
                        console.log(data);
                        this.lastPage = data.last_page;
                        this.currentPage = data.current_page;
                        this.planets = data.data;
                    })
            }
        },
        created(){
            this.getData(1)
        }
    }
</script>

<style scoped lang="stylus">
    .container
        width max-content
        margin 0 auto
        text-align center

    ul#planet-list
        list-style none

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
