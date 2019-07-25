
<template>
    <div>
        <div class="calendar-box d-flex align-items-center justify-content-between">
            <span>Starting on</span>
            <functional-calendar
                :is-date-range='true'
                v-slot:default="props"
                v-model="calendar"
                ref="Calendar"
                :is-modal='true' 
                :is-date-picker='true'
                :isTypeable="true"
                dateFormat="yyyy/mm/dd"
                :newCurrentDate="currentDate"
                :isAutoCloseable="true"
                :marked-dates="markedDates"

            >
                {{ props.day.day }}
                <span  
                :class="{
                'green-point': props.day.day === 5, 
                'orange-point': props.day.day === 9, 
                'green-line': props.day.day === 11
                }"></span>
            </functional-calendar>
            <span>Ending on</span>
        </div>
            
        <div class="form-group row mt-5">
            <label for="room-type" class="col-md-4 col-form-label text-md-right offset-1">{{ 'Room Type' }}</label>

            <div class="col-md-6">
               
               <select name="room_type" id="room-type" class="form-control" v-model="selectedType">
                    <option value="0" selected> Any </option>
                    option
                   <option :value="type.id" v-for="type in types" :selected="type.id == selectedType"> {{type.name}} </option>
                   
               </select>

            </div>
        </div>
        <div class="form-group row offset-4">
            <button class="btn btn-primary" @click="findRoom">Find Room</button>
        </div>
        
        <div class="results" ref="Results">
            
            <room-listing :dates="calendar" :rooms="foundRooms"></room-listing>

        </div>
        
        
    </div>
</template>

<script>
import {FunctionalCalendar} from 'vue-functional-calendar';

    export default {
        props:[ 'roomtypes'],
        name:"App",
        components:{
            FunctionalCalendar
        },
        data(){
            return{
                markedDates: ["16/4/2019", "18/4/2019", "20/4/2019", "21/4/2019"],
                clickedToday: true,
                calendar: {},
                markedDateRange:{},
                types: {},
                selectedType: 0,
                foundRooms: {},
                currentDate: new Date()
            }
        },
        mounted(){
            let fn = jQuery('input[title="Start Date"]').attr('name', 'start_date');
            let en = jQuery('input[title="End Date"]').attr('name', 'end_date');
                fn.attr('placeholder', 'Today');
                en.attr('placeholder', 'Tomorrow');
            
            this.types = JSON.parse(this.roomtypes);
        },
        
        methods: {
            findRoom(e){
                //e.preventDefault();
                
                if(!this.calendar){
                    return;
                }
                let data = {
                    start_date: this.calendar.dateRange.start.date,
                    end_date: this.calendar.dateRange.end.date,
                    room_type: this.selectedType
                }
                axios.post('/find-rooms', data).then(resp =>{
                    if(resp.status ==200){
                        
                        //this.foundRooms = resp.data;
                        console.log(this.foundRooms)

                    }
                }).catch( err =>{
                    console.log(err);
                })
            }
        }
    }
</script>
