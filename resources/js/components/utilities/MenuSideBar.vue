<template>
    <div class="sidebar">
        <!-- TODO: figure out how I want to populate sidebar -->
        <ul class="text-left">
            <li>
                <a href="/home" class="text-primary">Dashboard</a>
            </li>
            <li>
                <a href="#" class="text-primary">Reports</a>
            </li>
            <li v-if="user.business || user.business_id">
                <a :href="href" class="text-primary">Settings</a>
            </li>
        </ul>
        <ul class="fixed-bottom">
            <li>
                <a href="#" @click="logout" class="text-primary">Logout</a>
            </li>
        </ul>
    </div>
</template>

<script>

    export default {

        props: {

        },

        components: {},

        mixins: [],

        data() {
            return {
                user: window.User,
            }
        },

        computed: {
            href(){
                return 'business-edit/' +  this.user.business_id;
            }
        },

        methods: {
            logout: function(){
                axios.post('/logout');
                window.location = '/login';
            },

            getUser: function(){
                //axios.get('user')
            },
        },

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>
    .sidebar{
        padding-top: 8px;
        height: 100%;
    }

    li:hover{
        color: #000;
    }

    a{
        text-decoration: none;
    }

    ul,
    li{
        padding-left: 0;
        margin-left: 0;
    }

    ul.fixed-bottom{
        left: 10px;
    }

    .sidebar ul li{
        list-style-type: none;
    }
</style>
