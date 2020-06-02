<template>
    <div>
        <b-row>
            <b-card
                    header-text-variant="white"
                    header-bg-variant="info"
            >

                Invoice ID: {{ invoice.id }}<br>
                Invoice Amount: ${{ invoice.amount }}<br>
                Billed Date: {{ invoice.date }}<br>
                Date Completed: {{ invoice.date_completed }}<br><br>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Date Completed</th>
                            <th>Business</th>
                            <th>Subject</th>
                            <th>By</th>
                            <th>Record Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ invoice.date_completed }}</td>
                            <td>{{ invoice.business_name }}</td>
                            <td>{{ invoice.subject_name }}</td>
                            <td>{{ invoice.by }}</td>
                            <td>{{ invoice.record_date }}</td>
                        </tr>
                    </tbody>

                </table>

            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            invoice: {
                type: Object,
                default: function() {
                    return {}
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {
                header: 'Invoice Number: ' + this.invoice.id,
                sub_header: 'Invoice Date: ' + this.invoice.created_at,
                items: this.itemsArray,
                currentPage: 1,
                item: '',
                fields: [
                {
                    label: 'Date Completed',
                    key: 'date_completed',
                    sortable: true
                },
                {
                    label: 'Business',
                    key: 'business_name',
                    sortable: true,
                },
                {
                    label: 'Subject',
                    key: 'subject_name',
                    sortable: true,
                },
                {
                    label: 'By',
                    key: 'by',
                    sortable: true,
                },
                {
                    label: 'Record Date',
                    key: 'record_date',
                    sortable: true,
                },

            ],
            }
        },

        computed: {
            itemsArray(){

                return {
                    date_completed: invoice.date_completed,
                    business_name: invoice.business_name,
                    by: invoice.by,
                    record_date: invoice.record_date
                }

            }
        },

        methods: {},

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
