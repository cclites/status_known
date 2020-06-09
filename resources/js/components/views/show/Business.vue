<template>
    <div class="w-100">

        <h4>Business Information</h4>

        <b-row>

            <b-col>
                <b-form-group label="Business Name">
                    <b-input v-model="form.name" :disabled="editing"></b-input>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Responsible Agent">
                    <b-select v-model="form.responsible_agent_id" @change="updateAgentEmail" name="responsible_agent_id" :disabled="editing">
                        <option value="">Select responsible agent</option>
                        <option v-for="user in business.users" :value="user.id">{{ user.name }}</option>
                    </b-select>

                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Agent Email" disabled>
                    <b-input v-model="form.agent_email"></b-input>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Business Email">
                    <b-input v-model="form.email" :disabled="editing"></b-input>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group>
                    <button @click="updateBusinessData" class="btn btn-outline-success update-business-data">Save</button>
                </b-form-group>
            </b-col>

        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            business: {
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
                header: 'Business',

                editing: false,
                form: {
                    name: this.business.name || '',
                    responsible_agent_id: this.business.responsible_agent_id || '',
                    agent_email : this.business.responsible_agent.email || '',
                    email : this.business.email || '',
                    business_id : this.business.id || '',
                }
            }
        },

        computed: {
        },

        methods: {

            updateBusinessData(){

                axios.patch('/business-edit', this.form)
                    .then((response) => {
                        this.items = response.data;
                    }, (error) => {
                        console.log(error);
                    });
            },

            deleteBusinessData(){},

            updateAgentEmail() {

                let self = this;

                self.business.users.every(
                    (user) => {

                        if(user.id === self.form.responsible_agent_id){
                            self.form.agent_email = user.email;
                            return false;
                        }

                        return true;
                    }
                );
            },

        },

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>
    .update-business-data{
        position: relative;
        top: 28px;
    }
</style>
