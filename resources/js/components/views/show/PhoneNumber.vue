<template>
    <div>

        <h4>Phone Numbers</h4>

        <b-row class="pl-2">

            <button @click="addNewPhoneNumberRow" class="btn btn-outline-success mb-3">New Phone Number</button>

            <b-table striped hover
                     :items="items"
                     :fields="fields"
            >


                <template v-slot:cell(type)="row">
                    <b-select v-model="row.item.type">
                        <option value="">Select a Type</option>
                        <option v-for="type in types" :value="type">{{ type }}</option>
                    </b-select>
                </template>


                <template v-slot:cell(number)="row">
                    <b-form-input v-model="row.item.number"></b-form-input>
                </template>

                <template v-slot:cell(extension)="row">
                    <b-form-input v-model="row.item.extension"></b-form-input>
                </template>

                <template v-slot:cell(contact_name)="row">
                    <b-form-input v-model="row.item.contact_name"></b-form-input>
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
            phone_numbers: {
                type: Array,
                default: function(){
                    return [];
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {
                items: [],
                header: "",
                form: {
                    type: '',
                    number: '',
                    contact_name: '',
                },
                fields: [
                    {
                        label: 'Type',
                        key: 'type',
                    },
                    {
                        label: 'Phone Number',
                        key: 'number',
                    },
                    {
                        label: 'Extension',
                        key: 'extension'
                    },
                    {
                        label: 'Contact Name',
                        key: 'contact_name'
                    },
                    {
                        label: 'Actions',
                        key: 'actions',
                    }
                ],
                types: [
                    'Primary', 'Secondary'
                ],
                editing: false
            }
        },

        computed: {

        },

        methods: {


            addNewPhoneNumberRow(){

                this.items.push({   //Theoretically this will add a blank row, but I may need to push a set
                    type: '',               //values that match the fields.
                    number: '',
                    contact_name: '',
                    actions: '',
                    business_id: ''
                });

            },

            savePhoneNumber(){

            },

            updatePhoneNumber(){

            },

            deletePhoneNumber(){

            }
        },

        mounted() {
            this.items = this.phone_numbers;
        },

        watch: {},
    }
</script>

<style scoped>

</style>
