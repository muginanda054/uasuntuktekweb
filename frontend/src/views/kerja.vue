<script setup>
//import ref and onMounted
import { ref, onMounted } from "vue";

//import api
import api from "../api";

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
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-12">
        <div class="bg-white rounded shadow">
          <div class="p-4">
            <table class="table-auto w-full">
              <tbody>
                <tr v-if="lowongans.length === 0">
                  <td colspan="4" class="text-center py-4">
                    <div class="bg-red-500 text-white px-4 py-2 rounded">Data Belum Tersedia!</div>
                  </td>
                </tr>
                <tr v-else v-for="(lowongan, index) in lowongans" :key="index">
                  <div class="relative flex flex-col items-center justify-center overflow-hidden bg-gray-50 p-6 sm:py-12">
                    <div class="bg-white shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md">
                      <span class="text-purple-800 text-sm">Sektor Jasa</span>
                      <td class="font-bold mt-px">{{ lowongan.nama }}</td>
                      <div class="flex items-center gap-3 mt-2">
                        <td class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">{{ lowongan.jenis }}</td>
                        <td class="text-slate-600 text-sm flex gap-1 items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                          {{ lowongan.alamat }}
                        </td>
                      </div>
                    </div>
                  </div>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
