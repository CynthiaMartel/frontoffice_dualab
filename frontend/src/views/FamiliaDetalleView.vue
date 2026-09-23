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

  <section class="bg-gray-50 py-14 px-6">
    <div class="max-w-6xl mx-auto">
      <h2 class="font-bold text-gray-900 mb-1">Retos Disponibles</h2>
      <p class="text-sm text-gray-500 mb-8">
        <template v-if="!loading">{{ retos.length }} reto{{ retos.length !== 1 ? 's' : '' }} disponible{{ retos.length !== 1 ? 's' : '' }}</template>
      </p>

      <p v-if="loading" class="text-gray-400 text-sm">Cargando…</p>
      <p v-else-if="!retos.length" class="text-gray-400 text-sm">
        Todavía no hay retos publicados en esta familia.
      </p>

      <template v-else>
        <!-- ── Cards de reto — mismo diseño que el Explorador de Retos de la app DuaLab ── -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <RouterLink v-for="r in retos" :key="r.uuid"
            :to="{ name: 'reto-detalle', params: { id: r.uuid } }"
            class="bg-white rounded-[1.5rem] border border-gray-100 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] hover:border-primary-200
                   shadow-sm transition-all duration-300 flex flex-col overflow-hidden transform hover:-translate-y-1">

            <div class="p-5 pb-0 flex flex-wrap justify-end gap-1.5">
              <span class="border px-2.5 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-full whitespace-nowrap" :class="nivelClase(r.nivel_grupo)">
                Nivel: {{ r.nivel_grupo || 'N/D' }}
              </span>
            </div>

            <div class="px-6 pb-6 pt-4 flex-1 flex flex-col">
              <h3 class="text-[#1F2937] font-black text-lg leading-tight mb-3 line-clamp-2">{{ r.titulo }}</h3>
              <div class="flex flex-col gap-1.5 mb-4 border-l-2 border-gray-100 pl-3">
                <p v-if="r.empresa_nombre" class="text-[#1F2937] text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                  <BuildingOffice2Icon class="w-4 h-4 shrink-0 text-primary-600" />
                  <span class="truncate">{{ r.empresa_nombre }}</span>
                </p>
                <p v-if="r.centro_educativo" class="text-gray-500 text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                  <AcademicCapIcon class="w-4 h-4 text-gray-400 shrink-0" />
                  <span class="truncate">{{ r.centro_educativo }}</span>
                </p>
              </div>
              <p v-if="r.pregunta_reto" class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-5 flex-1">
                {{ r.pregunta_reto }}
              </p>
              <div class="mt-auto flex flex-wrap items-center gap-2">
                <span v-if="r.ciclo" class="inline-block bg-gray-50 text-gray-600 border border-gray-200 px-3 py-1.5 rounded-lg text-xs font-medium truncate max-w-full">
                  {{ r.ciclo }}
                </span>
                <span v-if="r.curso" class="inline-block bg-gray-50 text-gray-500 border border-gray-200 px-2.5 py-1.5 rounded-lg text-xs font-bold shrink-0">
                  {{ r.curso === 'ambos_cursos' ? 'Ambos Cursos' : r.curso + 'º curso' }}
                </span>
              </div>
            </div>
          </RouterLink>
        </div>
      </template>
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
  BuildingOffice2Icon,
  AcademicCapIcon,
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

function nivelClase(nivel) {
  return {
    Bajo:  'bg-primary-50 border-primary-200 text-primary-700',
    Medio: 'bg-[#F59E0B]/10 border-[#F59E0B]/20 text-[#F59E0B]',
    Alto:  'bg-[#D64545]/10 border-[#D64545]/20 text-[#D64545]',
  }[nivel] || 'bg-gray-100 border-gray-200 text-gray-500'
}

const FAMILIA_ICONS = {
  'Administración y Gestión':       BriefcaseIcon,
  'Comercio y Marketing':           PresentationChartBarIcon,
  'Informática y Comunicaciones':   ComputerDesktopIcon,
}
function familiaIcon(nombre) {
  return FAMILIA_ICONS[nombre] ?? BookOpenIcon
}
</script>
