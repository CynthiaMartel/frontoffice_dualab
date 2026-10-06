import { createRouter, createWebHistory } from 'vue-router'

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
    // Path distinto (no /empresas a secas): la herramienta ya usa /empresas
    // para su propia gestión interna de empresas — mismo dominio, tienen que
    // no chocar. El `name` se queda igual, así ningún RouterLink/$router.push
    // por nombre necesita tocarse.
    path: '/empresas-asociadas',
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
    // Path distinto (no /retos/:id a secas): la herramienta ya usa /retos/:id
    // para la ficha interna de un microreto — mismo dominio, tienen que no
    // chocar. El `name` se queda igual.
    path: '/retos-destacados/:id',
    name: 'reto-detalle',
    component: () => import('@/views/RetoDetalleView.vue'),
  },
  {
    // "Ver proyecto" de un reto: en vez de mostrar el proyecto completado en
    // abierto, se pide una demo.
    path: '/retos-destacados/:id/solicitar-demo',
    name: 'reto-solicitar-demo',
    component: () => import('@/views/SolicitarDemoProyectoView.vue'),
  },
  {
    // El proyecto ya no se muestra en abierto (ProyectoDetalleView se conserva
    // por si se vuelve a activar): los enlaces antiguos van a contacto.
    path: '/proyectos-destacados/:uuid',
    name: 'proyecto-detalle',
    redirect: { name: 'contacto' },
  },
  {
    // Reemplaza a /login, /register y /dashboard: no hay un portal propio de
    // alumno/empresa/centro que mantener — el login real vive en dualab.es
    // (la herramienta). Esto es solo un formulario de contacto/lead.
    path: '/contacto',
    name: 'contacto',
    component: () => import('@/views/ContactoView.vue'),
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

export default router
