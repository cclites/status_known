@php
/**
 * This snippet is embedded into the website.
 **/
@endphp

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>

    <script src="https://unpkg.com/vue/dist/vue.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>

</head>
<body>
    <header>
        <div>
            <b-col>
                <h4>App Name</h4>
            </b-col>
        </div>
    </header>

    <div id="loader_app" class="w-100">
        <b-container style="max-width: 100% !important;">
            <b-row class="w-100" class="container-lg">
                <b-col>
                    <b-form-group label="First Name" for="first_name">
                        <b-input id="first_name" v-model="data.form.first_name"></b-input>
                        <small v-if="!data.form.first_name">First name is required.</small>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Middle Name" for="middle_name">
                        <b-input id="middle_name" v-model="data.form.middle_name"></b-input>
                        <small v-if="data.middle_name"></small>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Last Name" for="last_name">
                        <b-input id="last_name" v-model="data.form.last_name"></b-input>
                        <small v-if="!data.form.last_name">Last name is required.</small>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Date of Birth" for="dob">
                        <b-input id="dob"
                                 v-model="data.form.dob"
                                 type="date"
                                 placeholder="mm/dd/yyyy"
                                 state="data.dob"
                        >
                        </b-input>
                        <small v-if="!data.form.dob">Date of birth is required</small>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Social Security Number" for="ssn">
                        <b-input id="ssn"
                                 v-model="data.form.ssn"
                        >
                        </b-input>
                        <small v-if="data.form.ssn"></small>
                    </b-form-group>
                </b-col>
                <b-col class="">
                    <b-btn @click="submitRequest()" class="submit_request" variant="info" :disabled="data.disabled">Submit Request</b-btn>
                </b-col>
            </b-row>

            <b-row>
                <b-alert
                    v-model="data.show_success_message"
                    dismissable="true"
                    fade
                    variant="success"
                    @click="data.show_success_message = 0"
                >
                    Your request has been completed. Your report will be emailed to you when it is ready.
                </b-alert>

                <b-alert
                    v-model="data.show_error_message"
                    dismissable="true"
                    fade
                    variant="danger"
                    @click="data.show_error_message = 0"
                >
                    Unable to complete your request.
                </b-alert>

                <b-alert
                    v-model="data.show_incomplete"
                    dismissable="true"
                    fade
                    variant="warning"
                    @click="data.show_error_message = 0"
                >
                    Unable to complete your request.
                </b-alert>

            </b-row>

        </b-container>

    </div>

    <script>


        var data = {
            form : {
                first_name: 'awd',
                middle_name: 'afafe',
                last_name: 'dtyhhfygy',
                dob: '',
                ssn: '123456789',
                provider_id: 1,
                business_id: 1,
            },
            disabled: false,
            token: '{{ $token }}',
            business: '{{ $business->name }}',
            show: true,
            show_success_message: false,
            show_error_message: false,
            message: '',
            show_message: false,
            errors: '',
            api_base_path: '{{ env('API_BASE_PATH') }}',
        };



        var vm = new Vue({
                    el: "#loader_app",
                    data: data
                });

        function submitRequest(){

            if(!hasRequiredInfo()){
                alert("Please provide all required data.");
                return;
            }

            data.disabled = true;
            let self = this;

            axios.post(this.api_base_path + '/records?api_token=' + data.token, data.form)
                .then((response)=>{

                    if(response.status == '200'){
                        clearForm();
                        data.show_success_message = 5;
                    }else{
                        console.log("Incorrect status message");
                        data.show_error_message = 5;
                    }

                }).catch(function (error) {
                    console.log("Catching the error");
                    data.show_error_message = 5;
                })
                .then(function () {
                    data.disabled = false;
                });
        }

        function clearForm(){

            console.log("Clear form");
            data.form.first_name = '';
            data.form.middle_name = '';
            data.form.last_name = '';
            data.form.dob = '';
            data.form.ssn = '';
        }

        function hasRequiredInfo(){

            if(!data.form.first_name || !data.form.last_name || !data.form.dob){
                return false;
            }

            return true;
        }

    </script>

    <style scoped>
        .submit_request{
            position: relative;
            top: 30px;
        }

        #loader_app{
            padding-top: 6px;
            margin: 0 auto;
        }

        .alert-success,
        .alert-danger{
            position: absolute;
            top: 10px;
            left: 16px;
        }

        h4{
            margin-top:4px;
            margin-bottom: 0;
            padding-left: 16px;
        }

        small{
            color: darkred;
        }

    </style>

</body>



