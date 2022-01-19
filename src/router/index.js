import { createRouter, createWebHistory } from "vue-router";
import New from '../views/New.vue'
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

  {
    path: "/new",
    name: "New",
    component: New,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
