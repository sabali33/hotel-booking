<template>
    <div>
        <div class="position-fixed w-100 h-100 attribute-modal ">
            <div class="new-capacity-box pt-5 p-3 ">
                <button class="btn btn-danger" @click="toggleForm">close</button>
            <h2 class="p-lg-5">Edit Capacity</h2>
            <!-- <form action="/new-room-capacity" method="POST"> -->
                <!-- @csrf; -->
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ 'Name' }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control " name="name" required autocomplete="name" autofocus v-model="data.name">

                        <!-- @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ 'Description' }}</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control " name="description"  required autocomplete="description" autofocus v-model="data.description">

                        <!-- @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8 offset-2">
                         <button class="btn btn-primary" @click="updateAttribute()">Update</button>
                    </div>
                   
                </div>
            <!-- </form> -->
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: ['showForm', 'toggleForm', 'capacity'],
        data: function(){
            return {
                data: {}
            }
        },
        mounted() {
            
            this.data = JSON.parse(this.capacity);
        },
        methods: {
            updateAttribute(){
                axios.put(`/room-capacity/${this.data.id}/edit`, this.data).then( response =>{
                    console.log(response.data);
                    if(response.status == 200){
                        this.toggleForm();
                        window.location = response.data.redirect;
                    }
                }).catch( err =>{
                    console.log(err);
                })
            }
        }
    }
</script>