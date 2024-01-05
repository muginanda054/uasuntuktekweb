//import vue router
import { createRouter, createWebHistory } from "vue-router";

//define a routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
  },
  {
    path: "/lowongans",
    name: "lowongans.index",
    component: () => import(/* webpackChunkName: "index" */ "../views/lowongans/index.vue"),
  },
  {
    path: "/lowongans/create",
    name: "lowongans.create",
    component: () => import(/* webpackChunkName: "create" */ "../views/lowongans/create.vue"),
  },
  {
    path: "/edit/:id",
    name: "lowongans.edit",
    component: () => import(/* webpackChunkName: "edit" */ "../views/lowongans/edit.vue"),
  },
  {
    path: "/donasi",
    name: "donasi",
    component: () => import(/* webpackChunkName: "edit" */ "../views/donasi.vue"),
  },
  {
    path: "/kerja",
    name: "kerja",
    component: () => import(/* webpackChunkName: "edit" */ "../views/kerja.vue"),
  },
  {
    path: "/signup",
    name: "signup",
    component: () => import(/* webpackChunkName: "edit" */ "../views/login/signup.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import(/* webpackChunkName: "edit" */ "../views/login/login.vue"),
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: () => import(/* webpackChunkName: "Auth" */ "../views/login/dashboard.vue"),
    meta: {
      requiredAuthorization: true,
      isadmin: false,
    },
  },
  {
    path: "/admin-dashboard",
    name: "admin-dashboard",
    component: () => import(/* webpackChunkName: "Auth" */ "../views/login/admin-dashboard.vue"),
    meta: {
      requiredAuthorization: true,
      isadmin: true,
    },
  },
];

//create router
const router = createRouter({
  history: createWebHistory(),
  routes, // <-- routes,
});

router.beforeEach((to, from, next) => {
  const loggedIn = localStorage.getItem("loggedIn");
  const isAdmin = localStorage.getItem("is_admin");

  if (to.matched.some((record) => record.meta.requiredAuthorization)) {
    // Jika rute memerlukan otorisasi
    if (!loggedIn) {
      // Jika tidak ada login, arahkan ke halaman login
      next({ name: "login" });
    } else {
      // Jika ada login, periksa isAdmin sesuai meta dari rute
      if (to.meta.isadmin && isAdmin !== "true") {
        // Jika rute memerlukan isAdmin true tetapi bukan admin, arahkan ke halaman dashboard biasa
        next({ name: "dashboard" });
      } else {
        // Lanjutkan navigasi sesuai rute yang diminta
        next();
      }
    }
  } else {
    // Jika rute tidak memerlukan otorisasi, lanjutkan navigasi
    next();
  }
});

export default router;
