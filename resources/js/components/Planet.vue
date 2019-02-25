<template lang="pug">
    div#planet-page
        h1 Planet # {{planetId}} page
        img#loader(src="../assets/loader.gif" v-show="isLoaderVisible")
        #info-block
            div Название: {{planet.name}}
            div url: {{planet.url}}
        button(@click="goToList") Назад к списку

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
                    .catch(error => this.$router.push("/"))
            },
            goToList() {
                this.$router.push('/');
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

    button
        border none
        background #3d8aec
        padding 10px
        font-size 12px
        text-transform uppercase
        color: white
        margin-top 20px
        cursor pointer
</style>