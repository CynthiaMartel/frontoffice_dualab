import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/HomeView.vue'),
  },
  {
    path: '/noticias',
    name: 'noticias',
    component: () => import('@/views/NoticiasView.vue'),
  },
  {
    path: '/empresas',
    name: 'empresas',
    component: () => import('@/views/EmpresasView.vue'),
  },
  {
    path: '/centros',
    name: 'centros',
    component: () => import('@/views/CentrosView.vue'),
  },
  {
    path: '/familias',
    name: 'familias',
    component: () => import('@/views/FamiliasView.vue'),
  },
  {
    path: '/familias/:slug',
    name: 'familia-detalle',
    component: () => import('@/views/FamiliaDetalleView.vue'),
  },
  {
    path: '/retos/:id',
    name: 'reto-detalle',
    component: () => import('@/views/RetoDetalleView.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/auth/LoginView.vue'),
    meta: { guestOnly: true },
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('@/views/auth/RegisterView.vue'),
    meta: { guestOnly: true },
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('@/views/DashboardView.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/',
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (!from.name) return { top: 0, left: 0 }
    if (savedPosition) return savedPosition
    if (to.hash) return new Promise(resolve => setTimeout(() => resolve({ el: to.hash, behavior: 'smooth' }), 80))
    return { top: 0 }
  },
})

router.beforeEach(async (to) => {
  const auth = useAuthStore()

  // Solo comprueba la sesión una vez por carga de página
  if (!auth.isInitialized) {
    await auth.init()
  }

  if (to.meta.requiresAuth && !auth.isLoggedIn) {
    return { name: 'login', query: { redirect: to.fullPath } }
  }
  if (to.meta.guestOnly && auth.isLoggedIn) {
    return { name: 'dashboard' }
  }
})

export default router
