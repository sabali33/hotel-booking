<template>
    <div>
        
            <div class="col-md-12">
                
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ 'First Name' }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name" v-model="data.first_name" autofocus>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ 'Last Name' }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control" name="last_name" value="" v-model="data.last_name">

                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ 'Email Address' }}</label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email" value="" v-model="data.email">

                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ 'Address' }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control " name="address" v-model="data.address"  autocomplete="address">

                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ 'City' }}</label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control" name="city" v-model="data.city" autocomplete="city">

                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label text-md-right">{{ 'Country' }}</label>

                    <div class="col-md-6">
                        <select class="form-control" id="country" name="country">
                            <option value="0">Choose Country</option>
                            <option :value="country.name" v-for="country in countries">{{ country.name}}</option>
                            <!-- @foreach( $countries as $country )

                                <option value="{{$country->name}}">{{$country->name}}</option>

                            @endforeach -->
                            
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8 offset-2">
                         <button class="btn btn-primary updateCustomer" @click="bookNow">Book</button>
                    </div>
                   
                </div>
            </div>
        
    </div>
</template>

<script>
    export default {
        props: ['dates', 'room', 'amount'],
        data: function() {
            return {
                data: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: '',
                    city: '',
                    country: ''
                },
                countries: []
            }
        },
        mounted(){
            axios.get('/countries').then(resp =>{
                if(resp.status == 200){
                    console.log(resp.data);
                    this.countries = resp.data;
                }
            }).catch( err =>{
                console.log(err);
            });
        },

        methods: {
            bookNow(){
                
                let data = {
                    booking:{
                        room_id: this.room.id,
                        start_date: this.dates.in.date,
                        end_date: this.dates.out.date,
                        amount: this.amount
                    },
                    user: this.data
                }
                axios.post('/new-booking', data).then(resp =>{
                    if(resp.data){
                        window.location = resp.data.redirect;
                       
                    }
                }).catch(err =>{
                    window.location = '/';
                    
                   
                })
            }
        }
    }
</script>
