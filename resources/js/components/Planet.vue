<template lang="pug">
    div#planet-page
        h1 Planet # {{planetId}} page
        img#loader(src="../assets/loader.gif" v-show="isLoaderVisible")
        #info-block
            div Название: {{planet.name}}
            div url: {{planet.url}}

</template>

<script>
    export default {
        data() {
            return {
                planet: {},
                isLoaderVisible: false
            }
        },
        computed: {
            planetId() {
                return this.$route.params.id;
            },
        },
        methods: {
            getData() {
                this.isLoaderVisible = true;
                this.$store.dispatch('getPlanetData', this.planetId)
                    .then(result => {
                        this.planet = result;
                        this.isLoaderVisible = false;
                    })
            }
        },
        created() {
            this.getData();
        }
    }
</script>

<style scoped lang="stylus">
    #planet-page
        position relative
        margin 0 auto
        width max-content

    #loader
        width 50px
        position absolute
        left 135px
</style>