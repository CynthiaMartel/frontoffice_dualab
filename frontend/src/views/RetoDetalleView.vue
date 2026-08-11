<template>
  <div class="max-w-2xl mx-auto px-6 py-12">
    <div v-if="loading" class="text-center py-16 text-gray-400">Cargando reto…</div>
    <template v-else-if="reto">

      <!-- Breadcrumb -->
      <RouterLink :to="{ name: 'familia-detalle', params: { slug: familiaSlug } }"
                  class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium mb-5 hover:text-primary-700 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver a {{ reto.familia?.nombre }}
      </RouterLink>

      <div class="flex items-center gap-2 mb-3">
        <span class="text-xs font-semibold bg-primary-50 text-primary-700 px-2.5 py-0.5 rounded-full border border-primary-200">
          {{ reto.familia?.nombre }}
        </span>
        <span :class="nivelbadge(reto.nivel)">{{ capitalize(reto.nivel) }}</span>
      </div>

      <h1 class="text-2xl font-extrabold text-gray-900 mb-2">{{ reto.titulo }}</h1>
      <p class="flex items-center gap-1.5 text-sm text-gray-400 mb-10">
        <ClockIcon class="w-4 h-4" /> {{ reto.duracion }}
      </p>

      <!-- Descripción -->
      <div class="card mb-5">
        <div class="flex items-center gap-2 font-semibold text-gray-900 mb-3">
          <DocumentTextIcon class="w-5 h-5 text-primary-600" />
          Descripción del Reto
        </div>
        <p class="text-sm text-gray-600 leading-relaxed">{{ reto.descripcion }}</p>
      </div>

      <!-- Objetivos -->
      <div class="card mb-5">
        <div class="flex items-center gap-2 font-semibold text-gray-900 mb-4">
          <CheckCircleIcon class="w-5 h-5 text-primary-600" />
          Objetivos
        </div>
        <ol class="space-y-3">
          <li v-for="(obj, i) in reto.objetivos" :key="obj.id" class="flex items-center gap-3">
            <div class="w-5 h-5 bg-primary-600 rounded-full text-white text-xs font-bold flex items-center justify-center flex-shrink-0">
              {{ i + 1 }}
            </div>
            <span class="text-sm text-gray-700">{{ obj.descripcion }}</span>
          </li>
        </ol>
      </div>

      <!-- Recursos -->
      <div class="card mb-8">
        <div class="flex items-center gap-2 font-semibold text-gray-900 mb-4">
          <WrenchScrewdriverIcon class="w-5 h-5 text-primary-600" />
          Recursos Necesarios
        </div>
        <div class="flex flex-wrap gap-2">
          <span v-for="r in reto.recursos" :key="r.id"
                class="bg-gray-100 text-gray-700 text-xs px-3 py-1.5 rounded-full">{{ r.nombre }}</span>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-primary-50 border border-primary-200 rounded-xl p-6">
        <h3 class="font-bold text-primary-800 text-base mb-2">¿Listo para aceptar el reto?</h3>
        <p class="text-sm text-primary-700 mb-4">Crea una cuenta o inicia sesión para comenzar a trabajar en este microreto.</p>
        <div class="flex gap-3">
          <RouterLink v-if="auth.isLoggedIn" :to="{ name: 'dashboard' }" class="btn-primary">
            Aceptar el reto
            <ArrowRightIcon class="w-4 h-4" />
          </RouterLink>
          <RouterLink v-else :to="{ name: 'register' }" class="btn-primary">
            Crear cuenta
            <ArrowRightIcon class="w-4 h-4" />
          </RouterLink>
          <RouterLink :to="{ name: 'login' }"
                      class="border border-primary-600 text-primary-600 px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-primary-50 transition">
            Iniciar sesión
          </RouterLink>
        </div>
      </div>
    </template>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import api from '@/services/api'
import { useAuthStore } from '@/stores/auth'
import {
  ChevronLeftIcon,
  ClockIcon,
  DocumentTextIcon,
  CheckCircleIcon,
  WrenchScrewdriverIcon,
  ArrowRightIcon,
} from '@heroicons/vue/24/outline'

const route   = useRoute()
const auth    = useAuthStore()
const reto    = ref(null)
const loading = ref(true)

const familiaSlug = computed(() =>
  reto.value?.familia?.nombre.toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g,'').replace(/\s+/g,'-') ?? ''
)

onMounted(async () => {
  try {
    const { data } = await api.get(`/retos/${route.params.id}`)
    reto.value = data
  } finally {
    loading.value = false
  }
})

function nivelbadge(n) {
  return { basico: 'badge-basico', intermedio: 'badge-intermedio', avanzado: 'badge-avanzado' }[n] ?? ''
}
function capitalize(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : '' }
</script>
