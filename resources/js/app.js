import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';
import '@fullcalendar/timegrid/main.css';
import '@fullcalendar/list/main.css';

function formatDate() {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

document.addEventListener('DOMContentLoaded', function() {
    
    var calendarEl = document.getElementById('calendar');

    if ( calendarEl ) {
        
        var calendar = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin ],
            header: {
                right: 'prev,next',
                center: 'title',
                left: 'dayGridMonth'
            },
            defaultDate: formatDate(),
            editable: true,
            navLinks: true,
            eventLimit: true,
            eventColor: '#3498db',
            eventBorderColor: '#2980b9',
            eventTextColor: 'white',
            events: {
                url: '/events',
                failure: function() {
                    //document.getElementById('script-warning').style.display = 'block'
                    console.log('failed to load events');
                }
            },
            eventClick: function(info) {
                console.log(info.event);
                // window.location.href= "/board";
            },
        });
    
        calendar.render();
    }
    
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./timer.js');
//require('./custom');
//require('feather-icons/dist/feather.js');

//const feather = require('feather-icons');

window.Vue = require('vue');

//eather.replace();




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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
