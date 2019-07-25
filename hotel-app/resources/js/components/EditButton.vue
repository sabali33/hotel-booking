<template>
    <div>
        <button class="btn btn-primary ml-3" @click="toggleForm"> Edit </button>
        <edit-room-form :room="roomid" :showForm="showForm" :toggleForm="toggleForm" v-if="showForm" ></edit-room-form>

    </div>
</template>

<script>
    export default {
        props: ['roomid', 'room'],

        data: function(){
            return {
                showForm: false,
            }
        },
        mounted(){
            console.log('mounted');
        },
        computed:{
            
        },
        methods: {
            toggleForm: function(e){
                
                /*axios.get('/room/1/edit').then(res =>{
                    console.log(res.data);
                }).catch( err =>{
                    console.log(err);
                })*/
                //console.log(this.showForm);
                this.showForm = !this.showForm;
            }
        }
        
    }
</script>
