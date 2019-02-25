<template lang="pug">
    div Planet # {{planetId}} page
</template>

<script>
    export default {
        computed: {
            planetId(){
                return this.$route.params.id;
            }
        },
        methods: {
            getData(){
                this.$store.dispatch('getPlanetData', this.planetId)
                    .then(result => console.log())
            }
        },
        created(){
            this.getData();
        }
    }
</script>

<style scoped lang="stylus">

</style>