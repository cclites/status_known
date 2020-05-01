<template>
    <b-card header=""
            header-text-variant="white"
            header-bg-variant="info"
    >
        <b-container>
            <b-row>
                <b-col>
                    <b-form-group label="First Name" for="first_name">
                        <b-input id="first_name" v-model="form.first_name"></b-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Middle Name" for="middle_name">
                        <b-input id="middle_name" v-model="form.middle_name"></b-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Last Name" for="last_name">
                        <b-input id="last_name" v-model="form.last_name"></b-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Date of Birth" for="dob">
                        <b-input id="dob"
                                 v-model="form.dob"
                                 type="date"
                                 placeholder="mm/dd/yyyy"
                        >
                        </b-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Social Security Number" for="ssn">
                        <b-input id="ssn"
                                 v-model="form.ssn"
                        >
                        </b-input>
                    </b-form-group>
                </b-col>
                <b-col class="">
                    <b-btn @click="submitRequest()" class="submitRequest" variant="info">Submit Request</b-btn>
                </b-col>
            </b-row>

        </b-container>

    </b-card>

</template>

<script>

    import Messages from "../mixins/messages.js";

    export default {

        props: {
            token: '',
            business: {},
        },

        components: {},

        mixins: [Messages],

        data() {
            return {
                form: {
                    first_name: 'awd',
                    middle_name: 'afafe',
                    last_name: 'dtyhhfygy',
                    dob: '',
                    ssn: '123456789',
                    provider_id: 1,
                    business_id: 1,
                },
                formattedSSN: '',
                formattedDOB: '',
                businessData: '',
            }
        },

        computed: {
        },

        methods: {
            submitRequest(){
                //console.log("Submitting request");
                axios.post('records?token=' + this.token, this.form)
                    .then((response)=>{
                        this.responseMessage(response);
                    })
            },
        },

        mounted() {

            this.$nextTick(
                function()
                {
                    this.businessData = JSON.parse(this.business);
                    this.form.business_id = this.businessData.id;
                }
            );

        },

        watch: {

            'form.ssn'(oldVal, newVal){
                console.log(oldVal);
                console.log(newVal);

            },

            'form.dob'(oldVal, newVal){
                console.log(oldVal);
                console.log(newVal);

            }
        },
    }
</script>

<style scoped>
    div.container{
        max-width:none;
    }

    .submitRequest{
        position: relative;
        top: 30px;
    }
</style>
