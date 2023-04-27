<template>
  <div>
    <h1>Customers</h1>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(customer, index) in customers" :key="customer.id">
          <td>{{ customer.name }}</td>
          <td>{{ customer.email }}</td>
          <td>
            <button @click="editCustomer(index)">Edit</button>
            <button @click="deleteCustomer(index)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="addCustomer">Add Customer</button>
    <div v-if="showModal">
      <h2>{{ modalTitle }}</h2>
      <form>
        <div>
          <label>Name:</label>
          <input type="text" v-model="currentCustomer.name" />
        </div>
        <div>
          <label>Email:</label>
          <input type="email" v-model="currentCustomer.email" />
        </div>
      </form>
      <button @click="saveCustomer">Save</button>
      <button @click="closeModal">Cancel</button>
    </div>
    <div v-if="showPagination">
      <button :disabled="page == 1" @click="previousPage">Previous</button>
      <button :disabled="page == lastPage" @click="nextPage">Next</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Customers",
  data() {
    return {
      customers: [],
      showModal: false,
      modalTitle: "",
      currentCustomer: { name: "", email: "" },
      currentPage: 1,
      perPage: 10,
      totalCustomers: 0,
    };
  },
  computed: {
    showPagination() {
      return this.totalCustomers > this.perPage;
    },
    lastPage() {
      return Math.ceil(this.totalCustomers / this.perPage);
    },
  },
  mounted() {
    this.loadCustomers();
  },
  methods: {
    loadCustomers() {
      axios
        .get("/api/customers?page=" + this.currentPage)
        .then((response) => {
          this.customers = response.data.data;
          this.totalCustomers = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addCustomer() {
      this.currentCustomer = { name: "", email: "" };
      this.modalTitle = "Add Customer";
      this.showModal = true;
    },
    editCustomer(index) {
      this.currentCustomer = { ...this.customers[index] };
      this.modalTitle = "Edit Customer";
      this.showModal = true;
    },
    saveCustomer() {
      const isNew = !this.currentCustomer.id;
      const method = isNew ? "post" : "put";
      const url = isNew ? "/api/customers" : "/api/customers/" + this.currentCustomer.id;

      axios({
        method: method,
        url: url,
        data: this.currentCustomer,
      })
        .then((response) => {
          this.showModal = false;
          this.loadCustomers();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteCustomer(index) {
      const id = this.customers[index].id;

      axios
        .delete("/api/customers/${id}")
        .then(response => {
          this.loadCustomers();
          this.errors = [];
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
