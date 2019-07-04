<template>
    <div>
        <button class="btn btn-primary" @bind="showForm" @click="toggleForm"> Add New{{ label }} </button>
        <new-room-form 
        :showForm="showForm" 
        v-if="showForm" 
        :toggleForm="toggleForm" 
        :rooms="rooms"
        :roomTypes="roomTypes"></new-room-form> 
        
    </div>
</template>

<script>
    export default {
        props: ['label', 'rooms', 'roomTypes'],

        data: function(){
            return {
                showForm: false,
            }
        },
        mounted(){
            console.log(this.roomTypes);
        },
        computed:{
            
        },
        methods: {
            toggleForm: function(){
                
                this.showForm = !this.showForm;
            }
        }
        
    }
</script>
