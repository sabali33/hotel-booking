<template>
    <div class="new-room-form-box" v-if="showForm">
        
        <div class="new-room-form">
            
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
                    {{data.name}}
            </div>
            <div class="form-group">
                <label for="room-type">Room Type</label>
                <select class="form-control" id="room-type" v-model="data.type">
                  <option value="">Select Type</option>
                  <option  v-for="type in options.types" :value="type.id">{{type.name}}</option>
                  
                  
                </select>{{data.type}}
            </div>
            <div class="form-group">
                <label for="room-price">Room price</label>
                <select class="form-control" id="room-price" v-model="data.price" ref="price">
                  <option value="">Select Price</option>
                  <option  v-for="price in options.prices" :value="price.id">{{price.regular_price}}</option>
                </select>
                {{data.price}}
            </div>
            <div class="form-group">
                <label for="room-capacity">Room Capacity</label>
                <select class="form-control" id="room-capacity" v-model="data.capacity" ref="capacity">
                  <option value="">Select Capacity</option>
                  <option  v-for="capacity in options.capacities" :value="capacity.id">{{capacity.name}}</option>
                </select>
                {{data.price}}
            </div>
            <div class="form-group">
                <label for="room-image">Room Image</label>
                <input type="file" class="form-control-file" id="room-image"  @change="getImage" >
                {{data.image}}
            </div>
            <div class="row">
                <div class="col-8 offset-3">
                    <button class="btn btn-primary" @click="sendData" >
                        Add New Room
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
        props: ['showForm', 'toggleForm', 'rooms', 'roomTypes'],

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
            console.log('changed');
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
        
        },
        methods:{
            sendData(){
                let data = new FormData();
                data.append('image', this.data.image);
                data.set('data', this.data);
                axios.post('/new-room', this.data).then( resp => {
                    console.log(resp.data);
                    this.toggleForm();
                    window.location = resp.data.redirect;
                }).catch(err =>{
                    console.log(err);
                })
            },
            getImage(image){
                console.log('changed');
                this.data.image = image.target.files;
                
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
                /*axios.get('/api/types').then( resp =>{
                    if(resp.status == 200){
                        this.options.types = resp.data;  
                        e.target.click();
                    }

                }).catch( err => {
                    console.log(err);
                })*/
            }
        },
        computed:{
            closeModal: function(){
                
                this.showModal = !this.showModal;
            },
            
        }
    }
</script>