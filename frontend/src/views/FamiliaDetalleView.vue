<template>
  <section class="py-12 px-6 relative overflow-hidden" :style="{ background: familia?.color_hex || '#16a34a' }">
    <RouterLink :to="{ name: 'familias' }"
      class="inline-flex items-center gap-1.5 text-xs bg-white/20 text-white px-3 py-1.5 rounded-md mb-5 hover:bg-white/30 transition-colors">
      <ChevronLeftIcon class="w-3.5 h-3.5" />
      Volver
    </RouterLink>
    <div class="flex items-center gap-4">
      <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-white">
        <component :is="familiaIcon(familia?.slug)" class="w-8 h-8" />
      </div>
      <div>
        <h1 class="text-2xl font-extrabold text-white">{{ familia?.nombre }}</h1>
        <p class="text-white/75 text-sm mt-1">{{ familia?.descripcion }}</p>
      </div>
    </div>
  </section>

  <section class="bg-white py-14 px-6">
    <div class="max-w-5xl mx-auto">
      <h2 class="font-bold text-gray-900 mb-1">Microretos Disponibles</h2>
      <p class="text-sm text-gray-500 mb-8">{{ retos.length }} reto{{ retos.length !== 1 ? 's' : '' }} disponible{{ retos.length !== 1 ? 's' : '' }}</p>

      <div v-if="loading" class="text-center py-12 text-gray-400">Cargando…</div>
      <div v-else class="grid md:grid-cols-3 gap-5">
        <RouterLink v-for="r in retos" :key="r.id"
          :to="{ name: 'reto-detalle', params: { id: r.id } }"
          class="card hover:shadow-md hover:-translate-y-0.5 transition-all no-underline">
          <div class="flex items-start justify-between gap-2 mb-3">
            <div class="font-bold text-sm text-gray-900">{{ r.titulo }}</div>
            <span :class="nivelbadge(r.nivel)" class="flex-shrink-0">{{ capitalize(r.nivel) }}</span>
          </div>
          <p class="text-xs text-gray-500 leading-relaxed mb-4 line-clamp-3">{{ r.descripcion }}</p>
          <div class="flex gap-4 text-xs text-gray-400">
            <span class="flex items-center gap-1">
              <ClockIcon class="w-3.5 h-3.5" /> {{ r.duracion }}
            </span>
            <span class="flex items-center gap-1">
              <CheckCircleIcon class="w-3.5 h-3.5" /> {{ r.objetivos?.length ?? 0 }} objetivos
            </span>
          </div>
        </RouterLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import api from '@/services/api'
import {
  ChevronLeftIcon,
  ClockIcon,
  CheckCircleIcon,
  ComputerDesktopIcon,
  BriefcaseIcon,
  PresentationChartBarIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const route   = useRoute()
const familia = ref(null)
const retos   = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    const { data } = await api.get(`/familias/${route.params.slug}`)
    familia.value = data
    retos.value   = data.retos ?? []
  } finally {
    loading.value = false
  }
})

const FAMILIA_ICONS = {
  'administracion-gestion':        BriefcaseIcon,
  'comercio-marketing':            PresentationChartBarIcon,
  'informatica-comunicaciones':    ComputerDesktopIcon,
}
function familiaIcon(slug) {
  return FAMILIA_ICONS[slug] ?? BookOpenIcon
}

function nivelbadge(n) {
  return { basico: 'badge-basico', intermedio: 'badge-intermedio', avanzado: 'badge-avanzado' }[n] ?? ''
}
function capitalize(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : '' }
</script>
