<template>
    <div>
        <button class="btn btn-danger" @click="deleteAttribute">Delete</button>
        <button class="btn btn-primary" @click="toggleForm">Edit</button>
         <new-attribute-form :showForm="showForm" v-if="showForm" :toggleForm="toggleForm" :capacity="capacity"></new-attribute-form>
    </div>
</template>

<script>
    export default {
        props: [ 'capacity' ],
        data: function(){
            return{
                showForm: false,

            }
        },
        
        methods: {
            deleteAttribute(){
                let confirmed = confirm(` Do you want to delete this capacity?`);
                if(confirmed){
                    let capacity = JSON.parse(this.capacity);
                    axios.get(`/room-capacity/${capacity.id}`).then( resp =>{
                        if(resp.status == 200){
                            window.location = resp.data.redirect;
                        }
                    });
                }
            },
            toggleForm: function(){
                this.showForm = !this.showForm;
            }
        },
        computed:{
            
        }
    }
</script>