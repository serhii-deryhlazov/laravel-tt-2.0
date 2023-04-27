import './bootstrap';

import Vue from 'vue';
import $ from 'jquery';
import 'datatables.net';

import CustomersComponent from './components/Customers.vue';

Vue.component('customers-component', CustomersComponent);

const app = new Vue({
    el: '#app',
    components: {
        'customers-component': CustomersComponent,
    }
});

$(document).ready(function() {
    $('#customers').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/customers',
            dataSrc: 'data'
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'id',
              render: function ( data, type, row, meta ) {
                  return '<a href="#" onclick="editCustomer(' + data + ')">Edit</a> | <a href="#" onclick="deleteCustomer(' + data + ')">Delete</a>';
              }
            }
        ]
    });
});

function editCustomer(id) {
    // Implement edit customer logic here
}

function deleteCustomer(id) {
    // Implement delete customer logic here
}
