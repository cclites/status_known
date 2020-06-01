<template>
    <div>
        <b-form-group label="User Select" class="pt-3">
            <div >
                <b-form-select v-model="user">
                    <option value="">No user Selected</option>
                    <option v-for="item in items" value="item.id">{{ item.name }}</option>
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
                user: '',
                items: [],
                url: 'users-view'
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
