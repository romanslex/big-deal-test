<template lang="pug">
    .container
        .row.justify-content-center
            .col-md-8
                .card
                    .card-header Example Component
                    .card-body I'm an example component
</template>

<script>
    export default {
        mounted() {
            axios
                .get('/data/planets')
                .then(response => console.log(response))
                .catch(error => console.log(error));
        }
    }
</script>
