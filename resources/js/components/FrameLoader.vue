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
                    <!--/b-row>

                    <b-row-->
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
    export default {

        props: {
            token: '',
        },

        components: {},

        mixins: [],

        data() {
            return {
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    dob: '',
                    ssn: '',
                    token: this.token
                },
                formattedSSN: '',
                formattedDOB: ''

            }
        },

        computed: {

        },

        methods: {
            submitRequest(){
                //console.log("Submitting request");
                axios.post('request-record', this.form)
                    .then((response)=>{
                        console.log(response);
                    })
            },
        },

        mounted() {

            //console.log(this.token);
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
