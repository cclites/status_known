<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
                    class="w-100"
            >
                <section>
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
                            <td>{{ record_data.first_name }}</td>
                            <td>{{ record_data.middle_name }}</td>
                            <td>{{ record_data.last_name }}</td>
                            <td>{{ record_data.dob }}</td>
                            <td>{{ record_data.ssn }}</td>
                        </tr>
                        </tbody>
                    </table>
                </section>
                <section>
                    <h4>Addresses</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="record in record_data.data.addresses">
                                <td>{{ record.address_1 }}</td>
                                <td>{{ record.city }}</td>
                                <td>{{ record.state }}</td>
                                <td>{{ record.zip }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section>
                    <h4>Charges</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>County</th>
                                <th>Date</th>
                                <th>Disposition</th>
                                <th>State</th>
                                <th>Violation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="record in record_data.data.criminal">
                                <td>{{ record.county }}</td>
                                <td>{{ record.date }}</td>
                                <td>{{ record.disposition }}</td>
                                <td>{{ record.state }}</td>
                                <td>{{ record.violation }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section>
                    <h4>Driving Infractions</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>County</th>
                                <th>Date</th>
                                <th>State</th>
                                <th>Violation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="record in record_data.data.criminal">
                                <td>{{ record.county }}</td>
                                <td>{{ record.date }}</td>
                                <td>{{ record.state }}</td>
                                <td>{{ record.violation }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <div>
                    <b-button
                        variant="outline-primary"
                        class="text-right"
                        @click="print"
                    >
                        Print
                    </b-button>
                </div>
            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            record: {
                type: String,
                default: ''
            }
        },

        components: {},

        mixins: [],

        data() {
            return {
                header: "",
                print_url: '/record-print',
                record_data: JSON.parse(this.record),
            }
        },

        computed: {
            url(){
                return this.print_url + "/" + this.record_data.id;
            },

            filename(){
                return this.record.last_name + "_" + this.record.first_name + '.pdf'
            }
        },

        methods: {

            print(){
                axios(this.url, {
                    method: 'get',
                    responseType: 'blob'
                })
                .then(response => {
                    let blob = new Blob([response.data], { type: 'application/pdf' });
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = this.filename;
                    link.click();
                })
                .catch(error => {
                    console.log(error);
                });
            }
        },

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
