<script setup>
//import ref
import { ref } from "vue";

//import router
import { useRouter } from "vue-router";

//import api
import api from "../../api";

//init router
const router = useRouter();

//define state
const nama = ref("");
const jenis = ref("");
const alamat = ref("");
const errors = ref([]);

//method "storelowongan"
const storeLowongan = async () => {
  //init formData
  let formData = new FormData();

  //assign state value to formData
  formData.append("nama", nama.value);
  formData.append("jenis", jenis.value);
  formData.append("alamat", alamat.value);

  //store data with API
  await api
    .post("/api/lowongans", formData)
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
            <form @submit.prevent="storeLowongan()">
              <div class="mb-3">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" class="form-control" v-model="nama" id="nama" name="nama" placeholder="Nama lowongan" />
                <div v-if="errors.nama" class="alert alert-danger mt-2">
                  <span>{{ errors.nama[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">jenis</label>
                <input type="text" class="form-control" v-model="jenis" id="jenis" name="jenis" placeholder="jenis lowongan" />
                <div v-if="errors.jenis" class="alert alert-danger mt-2">
                  <span>{{ errors.jenis[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">alamat</label>
                <textarea class="form-control" v-model="alamat" id="alamat" name="alamat" rows="5" placeholder="alamat lowongan"></textarea>
                <div v-if="errors.alamat" class="alert alert-danger mt-2">
                  <span>{{ errors.alamat[0] }}</span>
                </div>
              </div>
              <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
