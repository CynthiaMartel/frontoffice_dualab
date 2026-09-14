<template>
  <section class="bg-primary-700 py-16 px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10"
         style="background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=60')" />
    <div class="relative max-w-5xl mx-auto">
      <RouterLink :to="{ name: 'home' }"
                  class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm mb-6 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver al inicio
      </RouterLink>
      <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-wider">
        PLATAFORMA
      </span>
      <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Familias Profesionales</h1>
      <p class="text-white/75 text-base max-w-xl">
        Retos reales de empresas, organizados por área de conocimiento.
      </p>
    </div>
  </section>

  <section class="bg-gray-50 py-14 px-6">
    <div class="max-w-5xl mx-auto">
      <h2 class="text-lg font-bold text-gray-900 mb-1">Familias Profesionales</h2>
      <p class="text-sm text-gray-500 mb-8">Explora los retos organizados por áreas de conocimiento</p>

      <p v-if="loading" class="text-gray-400 text-sm">Cargando…</p>
      <p v-else-if="!familias.length" class="text-gray-400 text-sm">
        Todavía no hay retos publicados en el escaparate.
      </p>
      <div v-else class="grid md:grid-cols-3 gap-5">
        <div v-for="f in familias" :key="f.id"
             @click="$router.push({ name: 'familia-detalle', params: { slug: f.id } })"
             class="bg-white border border-gray-200 rounded-xl overflow-hidden cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all">
          <div class="h-40 flex items-center justify-center bg-primary-50">
            <img v-if="f.imagen_url" :src="f.imagen_url" :alt="f.nombre" class="w-16 h-16 object-contain" />
            <component v-else :is="familiaIcon(f.nombre)" class="w-16 h-16 text-primary-600" />
          </div>
          <div class="p-4">
            <div class="font-bold text-sm text-gray-900 flex items-center justify-between">
              {{ f.nombre }}
              <ChevronRightIcon class="w-4 h-4 text-primary-600" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import microretosPublicApi from '@/services/microretosPublicApi'
import {
  ChevronLeftIcon,
  ChevronRightIcon,
  ComputerDesktopIcon,
  BriefcaseIcon,
  PresentationChartBarIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const familias = ref([])
const loading  = ref(true)

onMounted(async () => {
  try {
    const { data } = await microretosPublicApi.get('/public/microretos/familias')
    familias.value = data.data ?? data
  } catch {
    familias.value = []
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
