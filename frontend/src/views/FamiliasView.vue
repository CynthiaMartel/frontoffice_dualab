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
        Diseños prácticos para desarrollar tus habilidades profesionales, organizados por área de conocimiento.
      </p>
    </div>
  </section>

  <section class="bg-gray-50 py-14 px-6">
    <div class="max-w-5xl mx-auto">
      <h2 class="text-lg font-bold text-gray-900 mb-1">Familias Profesionales</h2>
      <p class="text-sm text-gray-500 mb-8">Explora los microretos organizados por áreas de conocimiento</p>

      <div v-if="store.loading" class="text-center py-12 text-gray-400">Cargando…</div>

      <div v-else class="grid md:grid-cols-3 gap-5">
        <div v-for="f in familias" :key="f.id"
             @click="$router.push({ name: 'familia-detalle', params: { slug: f.slug } })"
             class="bg-white border border-gray-200 rounded-xl overflow-hidden cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all">
          <div class="h-40 flex items-center justify-center"
               :style="{ background: lighten(f.color_hex) }">
            <component :is="familiaIcon(f.slug)" class="w-16 h-16" :style="{ color: f.color_hex }" />
          </div>
          <div class="p-4">
            <div class="font-bold text-sm text-gray-900 flex items-center justify-between">
              {{ f.nombre }}
              <ChevronRightIcon class="w-4 h-4 text-primary-600" />
            </div>
            <div class="text-xs text-gray-500 mt-1.5 leading-relaxed">{{ f.descripcion }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useFamiliasStore } from '@/stores/familias'
import {
  ChevronLeftIcon,
  ChevronRightIcon,
  ComputerDesktopIcon,
  BriefcaseIcon,
  PresentationChartBarIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const store   = useFamiliasStore()
const familias = computed(() => store.familias)

onMounted(() => { if (!store.familias.length) store.fetchAll() })

function lighten(hex) { return hex + '18' }

const FAMILIA_ICONS = {
  'administracion-gestion':        BriefcaseIcon,
  'comercio-marketing':            PresentationChartBarIcon,
  'informatica-comunicaciones':    ComputerDesktopIcon,
}
function familiaIcon(slug) {
  return FAMILIA_ICONS[slug] ?? BookOpenIcon
}
</script>
