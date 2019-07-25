<template>
    <div>
        <div class="archive d-flex">
    
            <div class="selected-dates d-flex justify-content-between mb-4 p-3" v-if="showModal">
                <span class="sep">From</span>
                <span class="from"></span>
                <span class="sep">to</span>
                <span class="to"></span>
            </div>

           
            
                <div class="listing d-flex justify-content-between" v-for="room in rooms">
                    
                    <img :src="room.room_image" :alt="room.name" class="w-25 h-25">
                    <div class="content ml-4">
                        <div class="name my-2">
                            <h2 class="label">Room {{ room.name }} </h2>
                            
                        </div>
                        <div class="type my-2">
                            <span class="label">Type: {{room.roomType}}</span>
                            
                            <p class="name">{{ room.roomType}}</p>
                        </div>
                        <div class="capacity my-2">
                            <span class="label">Capacity: {{room.roomCapacity}}</span>
                            
                            <p class="name">{{room.roomCapacity}}</p>
                        </div>
                    </div>
                    <div class="button-box w-50 ml-4 align-self-center">
                        <span class="price"><strong>{{room.price}}</strong></span>
                        <booking-form :room="room" :dates="dates" json="false"></booking-form>
                    </div>
                </div>
            
            
        </div>
    </div>
</template>

<script>
    export default {
        props:[ 'rooms', 'dates' ],
        data(){
            return{
                showModal: false,
            }
        },
        mounted() {
            
        }
    }
</script>
