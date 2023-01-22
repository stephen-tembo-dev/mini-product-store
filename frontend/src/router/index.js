import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [

    {
      path: '/',
      name: 'products',
      component: () => import('../views/ProductsView.vue')
    },
    {
      path: '/add-product',
      name: 'add product',
      component: () => import('../views/AddProductView.vue')
    }
  ]
})

export default router
