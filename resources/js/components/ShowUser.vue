<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                show Client
            </div>
            <div class="card-body">
                <table
                    id="myTable"
                    class="table table-striped table-bordered"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th>action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import $ from "jquery";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.css"; //kalian bisa import ini di main.js agar dapat digunakan secara global
import "datatables.net-bs4"; //kalian bisa import ini di main.js agar dapat digunakan secara global
export default {
    methods:{
        coba(){
            alert("alert dari coba")
        },
       getuser(){
           axios.get("https://jsonplaceholder.typicode.com/users").then((response) => {
               $("#myTable").DataTable({
                   data: response.data,
                   columns: [
                       { data: "id" },
                       { data: "name" },
                       { data: "username" },
                       { data: "email" },
                       { data: "phone" },
                       { data: "website" },
                       {
                           data: null,
                           render: function(data){
                                return "<button class='btn btn-info' id='edit'>edit </button>"
                           }
                       },
                   ]
               });
               $(document).on("click", '#edit', function (){
                   this.coba()
               })
           });
       },

    },

    mounted() {
       this.getuser()
    },

};

</script>

<style>
</style>
