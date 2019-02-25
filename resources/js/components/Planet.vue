<template lang="pug">
    div
        h1 Planet # {{planetId}} page
        #info-block
            div Название: {{planet.name}}
            div url: {{planet.url}}

</template>

<script>
    export default {
        data() {
            return {
                planet: {}
            }
        },
        computed: {
            planetId() {
                return this.$route.params.id;
            },
        },
        methods: {
            getData() {
                this.$store.dispatch('getPlanetData', this.planetId)
                    .then(result => this.planet = result)
            }
        },
        created() {
            this.getData();
        }
    }
</script>

<style scoped lang="stylus">

</style>