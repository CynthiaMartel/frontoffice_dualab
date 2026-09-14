<template>
  <section class="py-12 px-6 relative overflow-hidden bg-primary-700">
    <RouterLink :to="{ name: 'familias' }"
      class="inline-flex items-center gap-1.5 text-xs bg-white/20 text-white px-3 py-1.5 rounded-md mb-5 hover:bg-white/30 transition-colors">
      <ChevronLeftIcon class="w-3.5 h-3.5" />
      Volver
    </RouterLink>
    <div class="flex items-center gap-4">
      <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-white">
        <component :is="familiaIcon(familiaNombre)" class="w-8 h-8" />
      </div>
      <div>
        <h1 class="text-2xl font-extrabold text-white">{{ familiaNombre || 'Cargando…' }}</h1>
      </div>
    </div>
  </section>

  <section class="bg-white py-14 px-6">
    <div class="max-w-5xl mx-auto">
      <h2 class="font-bold text-gray-900 mb-1">Retos Disponibles</h2>
      <p class="text-sm text-gray-500 mb-8">
        <template v-if="!loading">{{ retos.length }} reto{{ retos.length !== 1 ? 's' : '' }} disponible{{ retos.length !== 1 ? 's' : '' }}</template>
      </p>

      <p v-if="loading" class="text-gray-400 text-sm">Cargando…</p>
      <p v-else-if="!retos.length" class="text-gray-400 text-sm">
        Todavía no hay retos publicados en esta familia.
      </p>
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        <RouterLink v-for="r in retos" :key="r.uuid"
          :to="{ name: 'reto-detalle', params: { id: r.uuid } }"
          class="text-left p-4 rounded-xl border border-gray-200 bg-white hover:border-primary-400 hover:shadow-md hover:-translate-y-0.5 transition-all">
          <p v-if="r.curso" class="text-[9px] font-bold uppercase tracking-widest text-teal-600 mb-1">Curso {{ r.curso }}</p>
          <div class="font-bold text-sm text-gray-900 leading-snug">{{ r.titulo }}</div>
          <p v-if="r.empresa_nombre" class="text-xs text-gray-400 mt-1">{{ r.empresa_nombre }}</p>
        </RouterLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import microretosPublicApi from '@/services/microretosPublicApi'
import {
  ChevronLeftIcon,
  ComputerDesktopIcon,
  BriefcaseIcon,
  PresentationChartBarIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const route = useRoute()
const retos = ref([])
const familiaNombre = ref('')
const loading = ref(true)

onMounted(async () => {
  try {
    const [{ data: retosData }, { data: familiasData }] = await Promise.all([
      microretosPublicApi.get('/public/microretos', { params: { familia_id: route.params.slug } }),
      microretosPublicApi.get('/public/microretos/familias'),
    ])
    retos.value = retosData.data ?? retosData
    const familias = familiasData.data ?? familiasData
    familiaNombre.value = familias.find((f) => String(f.id) === String(route.params.slug))?.nombre ?? ''
  } catch {
    retos.value = []
  } finally {
    loading.value = false
  }
})

const FAMILIA_ICONS = {
  'Administración y Gestión':       BriefcaseIcon,
  'Comercio y Marketing':           PresentationChartBarIcon,
  'Informática y Comunicaciones':   ComputerDesktopIcon,
}
function familiaIcon(nombre) {
  return FAMILIA_ICONS[nombre] ?? BookOpenIcon
}
</script>
