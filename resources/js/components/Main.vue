<template lang="pug">
    .container
        ul#planet-list
            li.planet-list-item(v-for="planet in planets" :key="planet.url")
                | {{planet.name}}
</template>

<script>
    export default {
        data(){
            return {
                planets: []
            }
        },
        mounted() {
            axios
                .get('/data/planets')
                .then(response => {
                    console.log(response.data);
                    this.planets = response.data.data
                })
                .catch(error => console.log(error));
        }
    }
</script>

<style scoped lang="stylus">
    .container
        width 400px
        margin 0 auto

    ul#planet-list
        list-style none
        li
            cursor pointer
</style>
