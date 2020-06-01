<template>

    <div>
        <b-form-group label="Select Business">
            <div >
                <b-form-select v-model="business" @change="emit">
                    <option value="">No Business Selected</option>
                    <option v-for="item in items" :value="item.business_id" :key="item.business_id">{{ item.business_name }}</option>
                </b-form-select>
            </div>
        </b-form-group>
    </div>

</template>

<script>

    import EventBus from '../../classes/eventBus';

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

        methods: {
            emit(){
                EventBus.$emit('BUSINESS_FILTER_EVENT', this.business);
            }
        },

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
</style>
