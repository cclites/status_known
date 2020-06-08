<template>
    <div>
        <h4>Addresses</h4>
        <b-row class="pl-2">

            <button @click="addNewAddressRow" class="btn btn-outline-success mb-3">New Address</button>

            <b-table striped hover
                     :items="items"
                     :fields="fields"
                     responsive
            >
                <template v-slot:cell(type)="data">
                    <b-select v-model="form.type">
                        <option value="">Select a Type</option>
                        <option v-for="type in types"
                                :value="type.type">{{ type }}</option>
                    </b-select>
                </template>

                <template v-slot:cell(address_1)="data">
                    <b-input v-model="form.address_1"
                             :value="data.address_1"
                    >
                    </b-input>
                </template>

                <template v-slot:cell(address_2)="data">
                    <b-input v-model="form.address_2"
                             :value="data.address_2"
                    >
                    </b-input>
                </template>

                <template v-slot:cell(city)="data">
                    <b-input v-model="form.city"
                             :value="data.city"
                    >
                    </b-input>
                </template>

                <template v-slot:cell(state)="data">
                    <b-input v-model="form.state"
                             :value="data.state"
                    >
                    </b-input>
                </template>

                <template v-slot:cell(zip)="data">
                    <b-input v-model="form.zip"
                             :value="data.zip"
                    >
                    </b-input>
                </template>

                <template v-slot:cell(actions)="data">
                    <!-- save, edit, delete -->
                </template>

            </b-table>

        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            addresses: {
                type: Array,
                default: function() {
                    return [];
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {
                header: '',
                items: [],
                form: {
                    type: '',
                    address_1: '',
                    address_2: '',
                    city: '',
                    state: '',
                    zip: ''
                },
                fields: [
                    {
                        label: 'Type',
                        key: 'type',
                    },
                    {
                        label: 'Street Address',
                        key: 'address_1',
                    },
                    {
                        label: 'Suite/Apt',
                        key: 'address_2',
                    },
                    {
                        label: 'City',
                        key: 'city',
                    },
                    {
                        label: 'State',
                        key: 'state',
                    },
                    {
                        label: 'Zip Code',
                        key: 'zip',
                    },
                    {
                        label: 'Actions',
                        key: 'actions'
                    }
                ],
                types: ['Primary', 'Mailing', 'Secondary'],
            }
        },

        computed: {},

        methods: {
            addAddress(){

            },

            updateAddress(){

            },

            deleteAddress(){

            },

            addNewAddressRow(){
                this.items.push({   //Theoretically this will add a blank row, but I may need to push a set
                    type: '',               //values that match the fields.
                    address_1: '',
                    address_2: '',
                    city: '',
                    state: '',
                    zip: ''
                });

            }
        },

        mounted() {
            this.items = this.addresses;
        },

        watch: {},
    }
</script>

<style scoped>

</style>
