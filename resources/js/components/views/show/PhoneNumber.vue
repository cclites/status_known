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

                    <i class="fa fa-pencil-square-o fa-2x"
                       title="Edit Phone Number"
                       @click="editPhoneNumber(row)"
                       aria-hidden="true"
                       v-if="!row.item.edit && !row.item.new">
                    </i>

                    <i class="fa fa-floppy-o fa-2x"
                       title="Save Phone Number"
                       @click="savePhoneNumber(row)"
                       aria-hidden="true"
                       v-if="row.item.edit">
                    </i>

                    <i class="fa fa-floppy-o fa-2x"
                       title="Save Phone Number"
                       @click="updatePhoneNumber(row)"
                       aria-hidden="true"
                       v-if="row.item.new">
                    </i>

                    <i class="fa fa-trash-o fa-2x"
                       title="Delete Phone Number"
                       @click="deletePhoneNumber(row)"
                       aria-hidden="true"
                       v-if="!row.item.edit && !row.item.new">
                    </i>

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

                this.items.push({
                    type: '',
                    number: '',
                    contact_name: '',
                    actions: '',
                    business_id: '',
                    new: true
                });

            },

            editPhoneNumber(row){
                row.item.edit = true;
            },

            savePhoneNumber(row){
                console.log("Save PhoneNumber");
            },

            updatePhoneNumber(row){
                console.log("Update PhoneNumber");
            },

            deletePhoneNumber(row){

                axios.delete('phone-number/' + row.item.id)
                console.log("delete PhoneNumber");
            },

            addFlagsToItems(){

                let self = this;

                //No. Need to be able to update the phone numbers
                this.phone_numbers.every(function(number){
                    number.new = false;
                    number.edit = false;
                    self.items.push(number);
                })

            }
        },

        mounted() {
            this.addFlagsToItems();
        },

        watch: {},
    }
</script>

<style scoped>
    i.fa{
        position: relative;
        top: 5px;
    }

    i.fa:hover{
        color: #bbbbbb;
        cursor: pointer;
        transition-timing-function: ease-in;
    }
</style>
