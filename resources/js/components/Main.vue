<template lang="pug">
    .container
        #planet-list
            .planet-list-item(v-for="planet in planets" :key="planet.url")
                | {{planet.name}} - {{planet.url}}
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
        width 1000px
        margin 0 auto
</style>
