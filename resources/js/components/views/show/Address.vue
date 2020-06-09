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
                <template v-slot:cell(type)="row">
                    <b-select v-model="row.item.type">
                        <option value="">Select a Type</option>
                        <option v-for="type in types" :value="type">{{ type }}</option>
                    </b-select>
                </template>

                <template v-slot:cell(address_1)="row">
                    <b-form-input v-model="row.item.address_1"></b-form-input>
                </template>

                <template v-slot:cell(address_2)="row">
                    <b-form-input v-model="row.item.address_2"></b-form-input>
                </template>

                <template v-slot:cell(city)="row">
                    <b-form-input v-model="row.item.city"></b-form-input>
                </template>

                <template v-slot:cell(state)="row">
                    <b-form-input v-model="row.item.state"></b-form-input>
                </template>

                <template v-slot:cell(zip)="row">
                    <b-form-input v-model="row.item.zip"></b-form-input>
                </template>


                <template v-slot:cell(actions)="row">
                    <i class="fa fa-pencil-square-o fa-2x" title="Edit" aria-hidden="true"></i>
                    <i class="fa fa-floppy-o fa-2x" title="Save" aria-hidden="true"></i>
                    <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
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
