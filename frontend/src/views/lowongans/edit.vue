<script setup>
//import ref
import { ref, onMounted } from "vue";

//import router
import { useRouter, useRoute } from "vue-router";

//import api
import api from "../../api";

//init router
const router = useRouter();

//init route
const route = useRoute();

//define state
const nama = ref("");
const jenis = ref("");
const alamat = ref("");
const errors = ref([]);

//onMounted
onMounted(async () => {
  //fetch detail data lowongan by ID
  await api.get(`/api/lowongans/${route.params.id}`).then((response) => {
    //set response data to state
    nama.value = response.data.data.nama;
    jenis.value = response.data.data.jenis;
    alamat.value = response.data.data.alamat;
  });
});

//method "updatelowongan"
const updatelowongan = async () => {
  //init formData
  let formData = new FormData();

  //assign state value to formData
  formData.append("nama", nama.value);
  formData.append("jenis", jenis.value);
  formData.append("alamat", alamat.value);
  formData.append("_method", "PATCH");

  //store data with API
  await api
    .post(`/api/lowongans/${route.params.id}`, formData)
    .then(() => {
      //redirect
      router.push({ path: "/lowongans" });
    })
    .catch((error) => {
      //assign response error data to state "errors"
      errors.value = error.response.data;
    });
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="updatelowongan()">
              <div class="mb-3">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" class="form-control" v-model="nama" placeholder="Nama lowongan" />
                <div v-if="errors.nama" class="alert alert-danger mt-2">
                  <span>{{ errors.nama[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">jenis</label>
                <input type="text" class="form-control" v-model="jenis" placeholder="jenis lowongan" />
                <div v-if="errors.jenis" class="alert alert-danger mt-2">
                  <span>{{ errors.jenis[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">alamat</label>
                <textarea class="form-control" v-model="alamat" rows="5" placeholder="alamat lowongan"></textarea>
                <div v-if="errors.alamat" class="alert alert-danger mt-2">
                  <span>{{ errors.alamat[0] }}</span>
                </div>
              </div>
              <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
