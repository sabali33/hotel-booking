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
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>{{data.type}}
            </div>
            <div class="form-group">
                <label for="room-price">Room price</label>
                <select class="form-control" id="room-price" v-model="data.price">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                {{data.price}}
            </div>
            <div class="form-group">
                <label for="room-capacity">Room Capacity</label>
                <select class="form-control" id="room-capacity" v-model="data.capacity">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
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
        
        props: ['showForm', 'toggleForm'],

        data: function(){
            
            return {
                showModal: false,
                data:{
                    name: '',
                    type: '',
                    price: '',
                    image: '',
                    capacity: ''
                }

            }
        },
        methods:{
            sendData(){
                let data = new FormData();
                data.append('image', this.data.image);
                data.set('data', this.data);
                axios.post('/new-room', this.data).then( resp => {
                    console.log(resp.data);
                }).catch(err =>{
                    console.log(err);
                })
            },
            getImage(image){
                
                this.data.image = image.target.files;
                
            }
        },
        computed:{
            closeModal: function(){
                
                this.showModal = !this.showModal;
            }
        }
    }
</script>