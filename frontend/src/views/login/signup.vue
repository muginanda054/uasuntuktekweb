<script setup></script>

<template>
  <div class="bg-white rounded-lg py-5">
    <div class="container flex flex-col mx-auto bg-white rounded-lg pt-12 my-5">
      <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
        <div class="flex items-center justify-center w-full lg:p-12">
          <div class="flex items-center xl:p-10">
            <form class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl">
              <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Daftar</h3>
              <p class="mb-4 text-grey-700">Daftarkan email dan kata sandi anda</p>
              <div class="flex items-center mb-3">
                <hr class="h-0 border-b border-solid border-grey-500 grow" />
                <p class="mx-4 text-grey-600">or</p>
                <hr class="h-0 border-b border-solid border-grey-500 grow" />
              </div>
              <label for="name" class="mb-2 text-sm text-start text-grey-900">Nama Lengkap*</label>
              <input
                id="name"
                type="name"
                placeholder="Masukkan Nama Lengkap"
                class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
              />
              <label for="email" class="mb-2 text-sm text-start text-grey-900">Email*</label>
              <input
                id="email"
                type="email"
                placeholder="contoh@student.university.ac.id"
                class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
              />
              <label for="password" class="mb-2 text-sm text-start text-grey-900">Kata Sandi*</label>
              <input
                id="password"
                type="password"
                placeholder="Masukkan Kata Sandi"
                class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
              />
              <label for="password" class="mb-2 text-sm text-start text-grey-900">Konfirmasi Kata Sandi*</label>
              <input
                id="password"
                type="password"
                placeholder="Konfirmasi Kata Sandi"
                class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
              />
              <button class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl hover:bg-purple-blue-600 focus:ring-4 focus:ring-purple-blue-100 bg-purple-blue-500">Buat Akun</button>
              <p class="text-sm leading-relaxed text-grey-900">Sudah punya akun? <a href="" class="font-bold text-grey-700">Masuk</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
