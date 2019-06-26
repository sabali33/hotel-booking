<template>
    <div>
        <button class="btn btn-primary" @bind="showForm" @click="toggleForm">Add New Room 1</button>
        <new-room-form :showForm="showForm" v-if="showForm" :toggleForm="toggleForm"></new-room-form> 
    </div>
</template>

<script>
    export default {
        
        data: function(){
            return {
                showForm: true,
            }
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
