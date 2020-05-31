<!--
For demonstration purposes only
-->
<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>SSN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ model.first_name }}</td>
                    <td>{{ model.middle_name }}</td>
                    <td>{{ model.last_name }}</td>
                    <td>{{ model.dob }}</td>
                    <td>{{ model.ssn }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>

    //import DraftModelShow from '../utilities/draft-model-show';

    export default {

        props: {
            model: '',
        },

        //components: {DraftModelShow},

        mixins: [],

        data() {
            return {
                items: this.model,
            }
        },

        computed: {
        },

        methods: {},

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
