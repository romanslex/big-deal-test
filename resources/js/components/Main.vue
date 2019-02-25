<template lang="pug">
    .container
        ul#planet-list
            li.planet-list-item(v-for="planet in planets" :key="planet.url")
                | {{planet.name}}
        ul#pagination
            li.pagination-item(v-for="n in lastPage" :class="{'current': n === currentPage}") {{n}}
</template>

<script>
    export default {
        data(){
            return {
                planets: [],
                lastPage: 1,
                currentPage: 1,
            }
        },
        mounted() {
            axios
                .get('/data/planets')
                .then(response => {
                    console.log(response.data);
                    this.lastPage = response.data.last_page;
                    this.currentPage = response.data.current_page;
                    this.planets = response.data.data;
                })
                .catch(error => console.log(error));
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
