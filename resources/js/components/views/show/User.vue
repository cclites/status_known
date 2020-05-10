<template>
    <div>
        <b-row>
            <b-card header=""
                    header-text-variant="white"
                    header-bg-variant="info"
            >

                <h3 class="text-center">User Model View</h3>

            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            user: {
                type: Object,
                default: function() {
                    return {}
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {}
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
