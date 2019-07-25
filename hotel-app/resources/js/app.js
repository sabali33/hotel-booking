/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const CustomController = require('./custom-controller');
//import {FunctionalCalendar} from 'vue-functional-calendar';
CustomController.CustomController().init();
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('new-room-form', require('./components/NewRoomForm.vue').default);
Vue.component('new-room-button', require('./components/NewRoomButton.vue').default);
Vue.component( 'edit-button', require('./components/EditButton.vue').default );
Vue.component( 'edit-room-form', require('./components/EditRoomForm.vue').default );
Vue.component('admin-nav', require('./components/NavComponent.vue').default);
Vue.component('new-attribute', require('./components/NewAttribute.vue').default);
Vue.component('new-attribute-form', require('./components/NewAttributeForm.vue').default);
Vue.component('edit-booking', require('./components/EditBooking.vue').default);
Vue.component('booking-form', require('./components/BookingForm.vue').default);
Vue.component('new-customer-form', require('./components/NewCustomerForm.vue').default);
Vue.component('home-calendar', require('./components/BookingCalendar.vue').default);
Vue.component('room-listing', require('./components/RoomListing.vue').default);
Vue.component('bookings-calendar-view', require('./components/BookingsCalendarView.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    
});
