<template>
    <div class="p-5">
        <b-row v-for="(value, key) in items" key="key">
           {{ key + ": " + value }}
        </b-row>
    </div>

</template>

<script>

    import DraftModelShow from '../utilities/draft-model-show';

    export default {

        props: {
            model: '',
        },

        components: {DraftModelShow},

        mixins: [],

        data() {
            return {
                items: this.model,
            }
        },

        computed: {},

        methods: {},

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
