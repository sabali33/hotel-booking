<template>
    <div>
        <button class="btn btn-primary w-100" @click="toggleModal">Book Now</button>
        <div class="booking-modal-box position-fixed w-50 h-auto" v-if="showModal">
            <button class="btn btn-primary" @click="toggleModals" v-if="showRegisterModal">back</button>
            <button class="btn btn-danger position-absolute close-button" @click="toggleModal">close</button>
            <div class="bookingform-box position-relative" v-if="!showRegisterModal">
                
                <div class="room-details">
                    <img :src="data.room_image" :alt="data.name" class="w-25">
                    <h2 class="pt-3">{{data.name}}</h2>
                    <span>Price: {{data.price.regular_price}}</span>
                </div>
                <div class="form-group pt-3">
                    <label for="in">From</label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="in" 
                        @input="updateDate"
                        aria-describedby="in" 
                        placeholder="start on"
                        v-model="dateData.in.date" 
                        disabled="true"
                        >
                        
                    <label for="out">To</label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="out" 
                        @input="updateDate"
                        aria-describedby="out"
                        placeholder="Out on"
                        disabled="true" 
                        v-model="dateData.out.date" >
                </div>
                <div class="form-group pt-3">
                    <label for="room-name">Number of nights</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="nights" 
                        @input="updateAmount"
                        aria-describedby="nights"
                        min="1" 
                        placeholder="Enter Days to Stay"
                        v-model="nights" >
                        
                </div>
                <span class="amount"><strong>Amount:</strong> {{ amount}}</span>

                <div class="form-group pt-3">
                    <button class="btn btn-primary" @click="next">Next</button>
                </div>
            </div>
            <div class="customer-register-form position-relative"  v-if="showRegisterModal">
                <h2 class="mb-5">Personal Details</h2>
                <new-customer-form :room="data" :dates="dateData" :amount="amount"></new-customer-form>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        props: ['room', 'dates', 'json'],
        data: function(){
            return {
                data: '',
                showModal: false,
                showRegisterModal: false,
                dateData: '',
                amount: 0,
                nights: 1,

            }
        },
        methods:{

            toggleModal(){
                this.showModal = !this.showModal;
                
            },
            next(){

                this.showRegisterModal = !this.showRegisterModal
            },
            updateDate(){},
            updateAmount(){

                this.amount = this.nights * this.data.price.regular_price;
            },
            toggleModals(){
                this.showRegisterModal = false;
                this.showModal = true;
            }
        },
        mounted() {
            
            this.data = this.json ? JSON.parse(this.room) : this.room;
            
            this.dateData = this.json ? JSON.parse(this.dates) : this.dates;
            this.nights = this.dateData.nights.days;
            this.amount = this.data.price.regular_price * this.nights;
            
            
            
        },
        computed: {
            
        }
    }
</script>
