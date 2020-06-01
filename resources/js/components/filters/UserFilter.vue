<template>
    <div>
        <b-form-group label="Select User">
            <div >
                <b-form-select v-model="user" @change="emit">
                    <option value="">No user Selected</option>
                    <option v-for="item in items" :value="item.user_id" :key="item.user_id">{{ item.name }}</option>
                </b-form-select>
            </div>
        </b-form-group>
    </div>

</template>

<script>

    import EventBus from "../../classes/eventBus";

    export default {

        props: {},

        components: {},

        mixins: [],

        data() {
            return {
                user: '',
                items: [],
                url: 'users-view',

            }
        },

        computed: {},

        methods: {
            emit(){
                EventBus.$emit('USER_FILTER_EVENT', this.user);
            },

            getUsers(){
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
                    }, (error) => {
                        console.log(error);
                    });
            },

        },

        mounted() {
            this.getUsers();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
