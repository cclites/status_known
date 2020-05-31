<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
                    class="w-100"
            >
                <div>
                    <table class="w-100">
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
                            <td>{{ record.first_name }}</td>
                            <td>{{ record.middle_name }}</td>
                            <td>{{ record.last_name }}</td>
                            <td>{{ record.dob }}</td>
                            <td>{{ record.ssn }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                    </table>
                </div>

                <div>
                    <b-button @click="print" variant="outline-primary" class="text-right">Print</b-button>
                    <!--b-button variant="outline-secondary">Update</b-button-->
                </div>
            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            record: {
                type: Object,
                default: function() {
                    return {
                    }
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {
                header: "",
                print_url: '/record-print'
            }
        },

        computed: {},

        methods: {

            print(){
                window.location = this.print_url + "/" + this.record.id;
            }
        },

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
