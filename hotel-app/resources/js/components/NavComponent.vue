<template>
    <nav class="navigation py-5">
                
        <ul class="nav-list list-group list-unstyled ">
            <li class="nav-item list-group-item" v-if="isadmin">
                <a href="/settings">Hotel Details</a>
                
            </li>
            <li class="nav-item list-group-item" v-if="isadmin">
                <a href="/rooms">Rooms</a>
                
            </li>
            <li class="nav-item list-group-item" v-if="isadmin">
                <a href="/room-types" >Room Types</a>
                
            </li>
            <li class="nav-item list-group-item" v-if="isadmin">
                <a href="/room-capacities" >Room Capacities</a>
                
            </li>
            <li class="nav-item list-group-item">
                <a href="/bookings">Bookings</a>
                
            </li>
            <li class="nav-item list-group-item" v-if="isadmin">
                <a href="/prices" >Room Prices</a>
                
            </li>
            <li class="nav-item list-group-item" v-if="isadmin">
                <a href="/customers" >Customers</a>
                
            </li>
            <li class="nav-item list-group-item">
                <a href="/customer/profile">Profile</a>
                
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['isadmin'],
        mounted() {
        console.log(this.isadmin);
        }
    }
</script>
