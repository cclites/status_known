<template>
    <div>
        <b-card header=""
                header-text-variant="white"
                header-bg-variant="info"
                class="w-100"
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
                        <b-btn @click="submitRequest()" class="submitRequest" variant="info" :disabled="disabled">Submit Request</b-btn>
                    </b-col>
                </b-row>

            </b-container>

        </b-card>
    </div>

</template>

<script>

    /*
    import Messages from "../mixins/messages.js";

    export default {

        props: {
            token: '',
            business: {},
        },

        components: {},

        mixins: [Messages],

        form: {
            first_name: 'awd',
            middle_name: 'afafe',
            last_name: 'dtyhhfygy',
            dob: '',
            ssn: '123456789',
            provider_id: 1,
            business_id: 1,
        },
        */
        /*
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
                disabled: false,
            }
        },*/

    /*
        computed: {
        },

        methods: {
            submitRequest(){

                this.disabled = true;
                let self = this;

                axios.post('records?token=' + this.token, this.form)
                    .then((response)=>{
                        this.clearForm();
                        //TODO: Display a nice looking status message.
                    }).catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        self.disabled = false;
                    });
            },

            clearForm(){

                return;  //TODO: Remove in production

                this.form.first_name = '';
                this.form.middle_name = '';
                this.form.last_name = '';
                this.form.dob = '';
                this.form.ssn = '';
            }
        },*/


    /*
        mounted() {
            this.$nextTick(
                function()
                {
                    this.businessData = JSON.parse(this.business);
                    this.form.business_id = this.businessData.id;
                }
            );



            if(!document.getElementById('app')){
                var newAppElement = document.createElement('div');
                newAppElement.setAttribute('id', 'app');
                document.body.appendChild(newAppElement);
            }

            window.onload = function () {
                var main = new Vue({
                    el: 'app',
                    components: {}
                });
            }
        },

        watch: {
        },


    }*/
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
