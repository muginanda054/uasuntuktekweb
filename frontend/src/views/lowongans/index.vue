<script setup>
//import ref and onMounted
import { ref, onMounted } from "vue";

//import api
import api from "../../api";

//define state
const lowongans = ref([]);

//method fetchDatalowongans
const fetchDatalowongans = async () => {
  //fetch data
  await api
    .get("/api/lowongans")

    .then((response) => {
      //set response data to state "lowongans"
      lowongans.value = response.data.data.data;
    });
};

//run hook "onMounted"
onMounted(() => {
  //call method "fetchDatalowongans"
  fetchDatalowongans();
});

//method deletelowongan
const deletelowongan = async (id) => {
  //delete lowongan with API
  await api.delete(`/api/lowongans/${id}`).then(() => {
    //call method "fetchDatalowongans"
    fetchDatalowongans();
  });
};
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <router-link :to="{ name: 'lowongans.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW lowongan</router-link>
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-dark text-white">
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Jenis</th>
                  <th scope="col">Alamat</th>
                  <th scope="col" style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="lowongans.length == 0">
                  <td colspan="4" class="text-center">
                    <div class="alert alert-danger mb-0">Data Belum Tersedia!</div>
                  </td>
                </tr>
                <tr v-else v-for="(lowongan, index) in lowongans" :key="index">
                  <td>{{ lowongan.nama }}</td>
                  <td>{{ lowongan.jenis }}</td>
                  <td>{{ lowongan.alamat }}</td>
                  <td class="text-center">
                    <router-link :to="{ name: 'lowongans.edit', params: { id: lowongan.id } }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                    <button @click.prevent="deletelowongan(lowongan.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
