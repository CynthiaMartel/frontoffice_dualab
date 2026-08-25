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
      <h2 class="font-bold text-gray-900 mb-1">Retos Disponibles</h2>
      <p class="text-sm text-gray-500 mb-8">{{ retos.length }} reto{{ retos.length !== 1 ? 's' : '' }} disponible{{ retos.length !== 1 ? 's' : '' }} de ejemplo</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mb-10">
        <button v-for="r in retos" :key="r.id" @click="seleccionarReto(r.id)"
          class="text-left p-4 rounded-xl border transition-all"
          :class="retoActivoId === r.id
            ? 'border-primary-600 bg-primary-50 shadow-sm'
            : 'border-gray-200 bg-white hover:border-primary-400 hover:shadow-md hover:-translate-y-0.5'">
          <p class="text-[9px] font-bold uppercase tracking-widest text-teal-600 mb-1">{{ r.ciclo }}</p>
          <div class="font-bold text-sm text-gray-900 leading-snug">{{ r.titulo }}</div>
          <p class="text-xs text-gray-400 mt-1">{{ r.empresa_nombre }}</p>
        </button>
      </div>

      <FichaRetoDetalle v-if="retoActivo" :reto="retoActivo" />
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import { familiaPorSlug } from '@/data/familias'
import { fichasRetoDemoPorFamiliaSlug } from '@/data/fichasRetoDemo'
import FichaRetoDetalle from '@/components/retos/FichaRetoDetalle.vue'
import {
  ChevronLeftIcon,
  ComputerDesktopIcon,
  BriefcaseIcon,
  PresentationChartBarIcon,
  BookOpenIcon,
} from '@heroicons/vue/24/outline'

const route   = useRoute()
const familia = computed(() => familiaPorSlug(route.params.slug))
const retos   = computed(() => fichasRetoDemoPorFamiliaSlug(route.params.slug))

const retoActivoId = ref(null)
const retoActivo = computed(() =>
  retos.value.find((r) => r.id === retoActivoId.value) ?? null
)
function seleccionarReto(id) {
  retoActivoId.value = retoActivoId.value === id ? null : id
}

const FAMILIA_ICONS = {
  'administracion-gestion':        BriefcaseIcon,
  'comercio-marketing':            PresentationChartBarIcon,
  'informatica-comunicaciones':    ComputerDesktopIcon,
}
function familiaIcon(slug) {
  return FAMILIA_ICONS[slug] ?? BookOpenIcon
}
</script>
