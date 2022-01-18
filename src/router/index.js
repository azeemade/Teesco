import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "Index",
    component: () =>
      import("../views/Index.vue"),
  },

  {
    path: "/product/:id",
    name: "Product",
    component: () =>
      import("../views/Product.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
