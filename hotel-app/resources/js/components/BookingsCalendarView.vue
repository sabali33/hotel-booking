<template>
    <div>
        <button class="btn btn-primary mt-3" @click="toggleCalendar">{{ !calendarOpen ? 'View Bookings in Calendar' : 'Close' }}</button>

        <functional-calendar
            v-model='calendarData'
            :markedDates='markedDates'
            :date-format='dateFormat'
            :new-current-date="newDate"
            v-slot:default='props'
            v-if="calendarOpen"
        >
            {{ props.day.day }}
            <span :class="{'date-booked': isDayBooked(props.day.date)}" v-if="isDayBooked(props.day.date)"></span>
        </functional-calendar>
    </div>
</template>

<script>
import {FunctionalCalendar} from 'vue-functional-calendar';


    export default {
        props: ['bookeddays'],
        
        components:{
            FunctionalCalendar
        },
        data(){
            return {
                calendarData: {},
                markedDates: [],
                dateFormat: 'yyyy/mm/dd',
                calendarOpen: false,
                newDate: new Date()
            }
        },
        mounted() {
            
            this.markedDates = JSON.parse(this.bookeddays);
            //console.log(this.markedDates);
        },
        methods:{
            isDayBooked(date){
                //console.log(date);
                const booked = this.markedDates.map( booking =>{
                    return booking.dates.map(dateIn =>{
                        return Date.parse(dateIn);
                    })
                })
                .some(dates =>{

                    return dates.includes(Date.parse(date)) || false;
                });
                return booked;
            },
            toggleCalendar(){
                this.calendarOpen = !this.calendarOpen;
            }
        },
        computed: {
            
        }
        
    }
</script>
<style>
    
</style>