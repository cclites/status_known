<template>

    <div>
        <b-form-group label="Business Select" class="pt-3">
            <div >
                <b-form-select v-model="business">
                    <option value="">No Business Selected</option>
                    <option v-for="item in items" value="item.business_id">{{ item.business_name }}</option>
                </b-form-select>
            </div>
        </b-form-group>
    </div>

</template>

<script>

    export default {

        props: {},

        components: {},

        mixins: [],

        data() {
            return {
                business: '',
                items: [],
                url: 'business-view'
            }
        },

        computed: {},

        methods: {},

        mounted() {
            axios.get(this.url)
                .then((response) => {
                    this.items = response.data;
                }, (error) => {
                    console.log(error);
                });
        },

        watch: {},
    }
</script>

<style scoped>
    select{
        position: relative;
        top: 4px;
    }
</style>
