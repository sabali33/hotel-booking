<template>
    <div class="new-room-form-box" v-if="showForm">
        
        <div class="new-room-form">
           <!--  <form :action="/room/type.id/edit" method="post" >
                 -->
           
                <button class="btn btn-danger position-absolute close-button" @click="toggleForm">close</button>  
                <div class="form-group">
                    <label for="room-name">Room Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="room-name" 
                        aria-describedby="Room" 
                        placeholder="Enter room name"
                        v-model="data.name">
                        
                </div>
                <div class="form-group">
                    <label for="room-type">Room Type</label>
                    <select class="form-control" id="room-type" v-model="data.type">
                      <option value="">Select Type</option>
                      <option  v-for="type in options.types" :value="type.id" :selected="type==data.type">{{type.name}}</option>
                      
                      
                    </select>
                </div>
                <div class="form-group">
                    <label for="room-price">Room price</label>
                    <select class="form-control" id="room-price" v-model="data.price" ref="price">
                      <option value="">Select Price</option>
                      <option  v-for="price in options.prices" :value="price.id" :selected="price.id==room.price_manager_id">{{price.regular_price}} </option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="room-capacity">Room Capacity</label>
                    <select class="form-control" id="room-capacity" v-model="data.capacity" ref="capacity">
                      <option value="">Select Capacity</option>
                      <option  v-for="capacity in options.capacities" :value="capacity.id" :selected="capacity==data.capacity">{{capacity.name}}</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="room-image">Room Image</label>
                    <input type="file" class="form-control-file" id="room-image"  @change="getImage" ref="files" >
                    <div class="image-preview">
                        <img :src="data.image" :alt="data.name" class="w-25">
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 offset-3">
                        <button class="btn btn-primary" @click="sendData" >
                            Add New Room
                        </button>
                    </div>
                </div>
           <!--  </form> -->
        </div>

    </div>
</template>

<script>
    export default {
        
        props: ['showForm', 'toggleForm', 'room', 'roomTypes'],

        data: function(){
            
            return {
                showModal: false,
                data:{
                    name: '',
                    type: '',
                    price: '',
                    image: '',
                    capacity: ''
                },
                options:{
                    types: [ ],
                    capacities: [ ],
                    prices:[]
                }

            }
        },
        mounted(){
            
            this.getAttributes().then(resp =>{
                if(resp){
                    resp.forEach((res)=>{
                        if(res.status == 200 ){
                            let url = new URL(res.request.responseURL);

                            if(url.pathname == '/api/types'){
                                
                                this.options.types = res.data;
                            }else if(url.pathname == '/api/prices'){
                                this.options.prices = res.data;
                            }else if(url.pathname == '/api/capacities'){
                                this.options.capacities = res.data;
                            }
                        }
                        
                    })
                }
            }).catch(err =>{
                console.log(err);
            });

            this.roomParsed = JSON.parse(this.room);
            this.data = {
                name: this.roomParsed.name,
                type: this.roomParsed.room_type_id,
                capacity: this.roomParsed.room_capacity_id,
                price: this.roomParsed.price_manager_id,
                image: this.roomParsed.room_image
            };
            //
        
        },
        methods:{
            sendData(){
                
                axios.put(`/room/${this.roomParsed.id}/edit`, this.data
                    ).then( resp => {
                    console.log(resp);
                    
                    this.toggleForm();
                    window.location = resp.data.redirect;
                }).catch(err =>{
                    console.log(err);
                })
            },
            getImage(image){
                
                this.data.image = this.$refs.files.files[0];
                
            },
            getAttributes(){
                let endpoints = [
                    '/api/types',
                    '/api/capacities',
                    '/api/prices'
                ];
                const promises = endpoints.map(endpoint =>{
                    return axios.get(endpoint);
                })
                return Promise.all(promises);
                /**/
            },
            loadRoom(){
                axios.get(`/api/room/${this.room}`).then( resp =>{
                    if(resp.status == 200){
                        let data = {
                            name: resp.data.name,
                            type: resp.data.room_type_id,
                            capacity: resp.data.room_capacity_id,
                            price: resp.data.room_price_id,
                            image: resp.data.room_image
                        };
                        this.data = data;  
                        
                    }

                }).catch( err => {
                    console.log(err);
                })
            },
            isSelected(value, data){
                if(!value || !data){
                    return false;
                }
                return data.includes(value);
            }

        },
        
        computed:{
            closeModal: function(){
                
                this.showModal = !this.showModal;
            }
        }
    }
</script>