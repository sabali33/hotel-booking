<template>
    <div>
        <button class="btn btn-primary ml-2" @click="toggleForm">Edit</button>
        <div class="booking-edit-box position-fixed w-100 h-100" v-if="showForm">
            <div class="form-wrap container mt-5">
                <h2>Edit Booking for room {{showRoom()}}</h2>
                <div class="form-group row">
                    <label for="from" class="col-md-4 col-form-label text-md-right">{{ 'From' }}</label>

                    <div class="col-md-6">
                        <input id="from" type="date" class="form-control " name="from" required autocomplete="from" autofocus placeholder="Today" v-model="data.start_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="to" class="col-md-4 col-form-label text-md-right">{{ 'To' }}</label>

                    <div class="col-md-6">
                        <input id="to" type="date" class="form-control" name="to" required autocomplete="to" autofocus placeholder="Tomorrow" v-model="data.end_date">

                    </div>
                </div>
                <div class="form-group row">
                    <label for="room-id" class="col-md-4 col-form-label text-md-right">{{ 'Room' }}</label>

                    <div class="col-md-6">
                        <select class="form-control" v-model="data.room_id" id="room-id">
                            <option selected>Change room</option>

                            <option :value="room.id" v-for="room in rooms" :selected="data.room_id==room.id">{{room.name}}</option>
                            
                        </select>
                        
                    </div>
                </div>
                <div class="row offset-2">
                    <button class="btn btn-primary" @click="updateBooking"> Update </button>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props: ['booking'],
        data: function() {
            return {
                showForm: false,
                data: {},
                rooms: []
            }
        },
        methods:{
            toggleForm(){
                this.showForm = !this.showForm;
            },
            showRoom(){
                return this.data.room.name;
            },
            updateBooking(){
                console.log(this.data);
                axios.put(`/booking/${this.data.id}/edit`, this.data).then(resp =>{
                    if(resp.status == 200){
                        window.location = resp.data.redirect;
                    }
                })
            }
        },

        mounted() {
            this.data = JSON.parse(this.booking);
            axios.get('/api/rooms').then(resp =>{
                if(resp.status == 200){
                    this.rooms = resp.data;
                    console.log(this.rooms);
                }
            }).catch( err => {
                console.log(err);
            })
        }
    }
</script>
