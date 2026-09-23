<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <div v-if="loading" class="text-center py-16 text-gray-400">Cargando reto…</div>

    <template v-else-if="reto">
      <RouterLink :to="{ name: 'familias' }"
                  class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium mb-5 hover:text-primary-700 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver a Familias
      </RouterLink>

      <!-- CTA destacada: este reto ya tiene un proyecto real hecho por alumnado -->
      <RouterLink v-if="reto.proyecto_completado_uuid"
                  :to="{ name: 'proyecto-detalle', params: { uuid: reto.proyecto_completado_uuid } }"
                  class="group flex items-center justify-between gap-4 mb-6 px-5 py-4 sm:px-7 sm:py-5 rounded-2xl
                         bg-gradient-to-r from-primary-600 to-primary-700 shadow-lg shadow-primary-600/30
                         hover:shadow-xl hover:shadow-primary-600/40 hover:-translate-y-0.5 transition-all">
        <div class="flex items-center gap-3 sm:gap-4">
          <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
            <RocketLaunchIcon class="w-6 h-6 text-white" />
          </div>
          <div>
            <p class="text-white font-black text-sm sm:text-base leading-tight">Este reto ya tiene un proyecto completado</p>
            <p class="text-primary-100 text-xs sm:text-sm">Descubre cómo lo resolvió un equipo de alumnado real</p>
          </div>
        </div>
        <span class="hidden sm:inline-flex items-center gap-1.5 bg-white text-primary-700 font-black text-xs uppercase
                     tracking-wider px-4 py-2.5 rounded-xl shrink-0 group-hover:bg-primary-50 transition-colors">
          Ver proyecto
          <ArrowRightIcon class="w-4 h-4" />
        </span>
      </RouterLink>

      <!-- ══ Réplica de la ficha de reto de la app DuaLab (MicroretoModal.vue / DetalleMicroreto.vue) ══ -->
      <div class="bg-[#F8FAFC] rounded-[2rem] shadow-2xl border border-gray-200 overflow-hidden font-sans text-[#1F2937]">

        <div class="bg-white border-b border-gray-100 shadow-sm">

          <!-- Cabecera con imagen de fondo -->
          <div class="relative bg-gray-50 overflow-hidden">
            <div class="absolute inset-0 z-0 pointer-events-none">
              <div class="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-50/95 to-transparent z-10" />
              <div class="absolute inset-0 bg-gradient-to-t from-gray-50 via-transparent to-transparent z-10" />
              <img v-if="imagenFondo" :src="imagenFondo" alt="" class="w-full h-full object-cover object-right opacity-30 mix-blend-multiply" />
            </div>

            <div class="relative z-10 px-6 py-8 md:px-12 md:pt-10 md:pb-8 max-w-3xl">
              <p class="text-primary-600 font-bold text-[10px] tracking-[0.2em] uppercase flex items-center gap-2 mb-3">
                <DocumentTextIcon class="w-4 h-4 shrink-0" />
                DuaLab · Ficha de Reto
              </p>
              <h1 class="text-2xl md:text-4xl font-black text-[#1F2937] tracking-tight leading-tight mb-2">{{ reto.titulo }}</h1>
              <h2 v-if="reto.pregunta_reto" class="text-base md:text-lg text-gray-600 font-bold leading-snug mb-2">{{ reto.pregunta_reto }}</h2>
              <h3 v-if="reto.subtitulo" class="text-sm md:text-base text-gray-500 font-medium leading-relaxed mb-6">{{ reto.subtitulo }}</h3>

              <div class="flex flex-wrap gap-2">
                <span v-if="reto.empresa_nombre" class="flex items-center gap-1.5 px-3 py-1.5 bg-[#1F2937] text-white rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm">
                  <BuildingOffice2Icon class="w-3 h-3 shrink-0" />
                  {{ reto.empresa_nombre }}
                </span>
                <span v-if="reto.empresa_es_simulada != null"
                      :class="reto.empresa_es_simulada ? 'bg-amber-50 border-amber-200 text-amber-700' : 'bg-emerald-50 border-emerald-200 text-emerald-700'"
                      class="flex items-center gap-1.5 px-3 py-1.5 border rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  {{ reto.empresa_es_simulada ? 'Empresa ficticia' : 'Empresa real' }}
                </span>
                <span v-if="reto.es_simulado" class="flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  Info simulada
                </span>
                <span v-if="reto.familia" class="flex items-center gap-1.5 px-3 py-1.5 bg-white/80 border border-gray-200 text-[#1F2937] rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  {{ reto.familia }}
                </span>
                <span v-if="reto.ciclo" class="flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 border border-primary-200 text-primary-700 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  {{ reto.ciclo }}
                </span>
                <span v-if="reto.curso" class="flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 border border-indigo-200 text-indigo-700 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  {{ reto.curso }}º Curso
                </span>
                <span v-if="reto.nivel_grupo" class="flex items-center gap-1.5 px-3 py-1.5 bg-white/80 border border-gray-200 text-gray-500 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  Nivel {{ reto.nivel_grupo }}
                </span>
                <span v-if="reto.empresa?.sector" class="flex items-center gap-1.5 px-3 py-1.5 bg-white/80 border border-gray-200 text-gray-500 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  {{ reto.empresa.sector }}
                </span>
                <span v-if="reto.empresa?.tamano" class="flex items-center gap-1.5 px-3 py-1.5 bg-white/80 border border-gray-200 text-gray-500 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                  {{ reto.empresa.tamano }}
                </span>
              </div>
            </div>
          </div>

          <!-- Cuerpo de la ficha -->
          <div class="px-6 py-8 md:px-12 md:py-10 space-y-10">

            <!-- Datos recogidos de la empresa -->
            <div v-if="tieneDatosRecogidos" class="bg-gradient-to-br from-orange-50 to-white border-2 border-orange-200 rounded-2xl p-5 md:p-7 shadow-sm">
              <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-orange-500 flex items-center justify-center shrink-0 shadow-sm">
                  <DocumentTextIcon class="w-5 h-5 text-white" />
                </div>
                <div>
                  <h3 class="text-orange-700 font-black uppercase text-xs md:text-sm tracking-[0.15em]">Datos recogidos de la empresa</h3>
                  <p class="text-[11px] text-orange-400 font-medium">Diagnóstico original, sin resumir por IA</p>
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div v-if="reto.empresa.dia_a_normal" class="bg-white/70 rounded-xl p-4 border border-orange-100">
                  <p class="text-[10px] font-black uppercase tracking-wider text-orange-500 mb-1">Su día a día</p>
                  <p class="text-sm text-gray-700 leading-relaxed">{{ reto.empresa.dia_a_normal }}</p>
                </div>
                <div v-if="reto.empresa.friccion_area || reto.empresa.friccion_problema" class="bg-white/70 rounded-xl p-4 border border-orange-100">
                  <p class="text-[10px] font-black uppercase tracking-wider text-orange-500 mb-1">Fricciones de la empresa</p>
                  <p v-if="reto.empresa.friccion_area" class="text-sm text-gray-700 leading-relaxed">{{ reto.empresa.friccion_area }}</p>
                  <p v-if="reto.empresa.friccion_problema" class="text-sm text-gray-700 leading-relaxed mt-1">{{ reto.empresa.friccion_problema }}</p>
                </div>
                <div v-if="reto.empresa.consecuencias" class="bg-white/70 rounded-xl p-4 border border-orange-100">
                  <p class="text-[10px] font-black uppercase tracking-wider text-orange-500 mb-1">Consecuencias</p>
                  <p class="text-sm text-gray-700 leading-relaxed">{{ reto.empresa.consecuencias }}</p>
                </div>
                <div v-if="reto.empresa.restricciones" class="bg-white/70 rounded-xl p-4 border border-orange-100">
                  <p class="text-[10px] font-black uppercase tracking-wider text-orange-500 mb-1">Restricciones</p>
                  <p class="text-sm text-gray-700 leading-relaxed">{{ reto.empresa.restricciones }}</p>
                </div>
                <div v-if="reto.empresa.lo_que_no_quieren" class="bg-white/70 rounded-xl p-4 border border-orange-100 md:col-span-2">
                  <p class="text-[10px] font-black uppercase tracking-wider text-orange-500 mb-1">Lo que no quieren</p>
                  <p class="text-sm text-gray-700 leading-relaxed">{{ reto.empresa.lo_que_no_quieren }}</p>
                </div>
                <div v-if="reto.empresa.expectativas_alumno" class="bg-white/70 rounded-xl p-4 border border-orange-100 md:col-span-2">
                  <p class="text-[10px] font-black uppercase tracking-wider text-orange-500 mb-1">Qué esperan del alumnado</p>
                  <p class="text-sm text-gray-700 leading-relaxed">{{ reto.empresa.expectativas_alumno }}</p>
                </div>
              </div>
            </div>

            <!-- Resumen de diagnóstico -->
            <div class="space-y-8">
              <h3 class="flex items-center gap-2 text-[#1F2937] font-bold uppercase text-xs tracking-widest border-b-2 border-gray-200 pb-2">
                <DocumentTextIcon class="w-5 h-5 text-primary-600 shrink-0" />
                Resumen de diagnóstico
              </h3>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
                <div v-if="reto.quien_es">
                  <h3 class="section-title text-primary-700">¿Quién es {{ reto.empresa_nombre }}?</h3>
                  <p class="text-gray-600 text-sm leading-relaxed">{{ reto.quien_es }}</p>
                </div>
                <div v-if="reto.dia_a_dia">
                  <h3 class="section-title text-primary-700">Su día a día</h3>
                  <p class="text-gray-600 text-sm leading-relaxed">{{ reto.dia_a_dia }}</p>
                </div>
              </div>

              <div v-if="reto.dificultades?.length">
                <h3 class="section-title text-yellow-600">Dificultades</h3>
                <ul class="space-y-2 pl-1">
                  <li v-for="(item, i) in reto.dificultades" :key="i" class="flex items-start gap-3 text-sm text-gray-700">
                    <span class="text-yellow-500 font-black mt-0.5 shrink-0">•</span><span>{{ item }}</span>
                  </li>
                </ul>
              </div>

              <div class="bg-gradient-to-r from-gray-50 to-white border-l-4 border-primary-600 p-6 rounded-r-2xl shadow-sm border-y border-r border-gray-100">
                <h3 class="text-primary-700 font-black uppercase text-[10px] tracking-[0.2em] mb-3">Este reto consiste en responder a:</h3>
                <p class="text-lg md:text-xl font-bold text-[#1F2937] leading-snug">{{ reto.pregunta_reto }}</p>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
                <div v-if="reto.que_necesitan?.length">
                  <h3 class="section-title text-primary-700">Qué necesitan</h3>
                  <ul class="space-y-2 pl-1">
                    <li v-for="(item, i) in reto.que_necesitan" :key="i" class="flex items-start gap-3 text-sm text-gray-700">
                      <span class="text-primary-600 font-black mt-0.5 shrink-0">•</span><span>{{ item }}</span>
                    </li>
                  </ul>
                </div>
                <div v-if="reto.limitaciones?.length">
                  <h3 class="section-title text-red-500">Limitaciones</h3>
                  <ul class="space-y-2 pl-1">
                    <li v-for="(item, i) in reto.limitaciones" :key="i" class="flex items-start gap-3 text-sm text-gray-700">
                      <span class="text-red-500 font-black mt-0.5 shrink-0">•</span><span>{{ item }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Prototipos / ODS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
              <div v-if="reto.prototipos?.length">
                <h3 class="section-title text-primary-700">Ejemplos de Prototipos</h3>
                <ul class="space-y-2 pl-1">
                  <li v-for="(item, i) in reto.prototipos" :key="i" class="flex items-start gap-3 text-sm text-gray-700">
                    <span class="text-primary-600 font-black mt-0.5 shrink-0">•</span><span>{{ item }}</span>
                  </li>
                </ul>
              </div>
              <div v-if="reto.ods_sugeridos?.length">
                <h3 class="section-title text-blue-600">ODS Sugeridos</h3>
                <ul class="space-y-2 pl-1">
                  <li v-for="ods in reto.ods_sugeridos" :key="ods" class="text-sm font-semibold text-[#1F2937]">{{ ods }}</li>
                </ul>
              </div>
            </div>

            <!-- Soft skills -->
            <div v-if="reto.soft_skills?.length">
              <h3 class="flex items-center gap-2 text-purple-600 font-black text-[11px] uppercase tracking-[0.15em] mb-3">
                <WrenchScrewdriverIcon class="w-4 h-4 shrink-0" />
                Soft skills
              </h3>
              <div class="flex flex-wrap gap-2">
                <span v-for="(skill, i) in reto.soft_skills" :key="i" class="px-3 py-1 bg-purple-50 border border-purple-200 text-purple-700 rounded-full text-xs font-semibold">
                  {{ skill }}
                </span>
              </div>
            </div>

            <!-- RA/CE -->
            <div v-if="reto.evaluacion_oficial?.length" class="pt-2">
              <h3 class="flex items-center gap-2 text-[#1F2937] font-bold uppercase text-xs tracking-widest border-b-2 border-gray-200 pb-2 mb-6">
                <AcademicCapIcon class="w-5 h-5 text-primary-600 shrink-0" />
                RA/CE Seleccionados
              </h3>
              <div class="space-y-4">
                <div v-for="evalObj in reto.evaluacion_oficial" :key="evalObj.modulo" class="bg-white border border-gray-200 p-5 rounded-2xl shadow-sm">
                  <p class="text-[10px] uppercase font-bold text-gray-400 mb-0.5">Módulo</p>
                  <p class="font-black text-[#1F2937] text-base mb-4">{{ evalObj.modulo }}</p>
                  <div class="mb-4">
                    <p class="text-[10px] uppercase font-bold text-primary-700 mb-1">Resultado de Aprendizaje</p>
                    <p class="text-sm font-semibold text-gray-700 bg-gray-50 p-3 rounded-xl border border-gray-100">{{ evalObj.ra }}</p>
                  </div>
                  <div class="mb-4">
                    <p class="text-[10px] uppercase font-bold text-gray-500 mb-2">Criterios de Evaluación</p>
                    <ul class="space-y-1.5">
                      <li v-for="(ce, i) in evalObj.ce" :key="i" class="text-sm text-gray-600 flex items-start gap-2">
                        <span class="text-primary-600 font-bold mt-0.5 shrink-0">✓</span><span>{{ ce }}</span>
                      </li>
                    </ul>
                  </div>
                  <div v-if="evalObj.aplicacion" class="mt-3 pt-3 border-t border-gray-100">
                    <p class="text-sm text-gray-500 italic">
                      <span class="font-bold not-italic text-[#1F2937]">Aplicación: </span>{{ evalObj.aplicacion }}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Variantes -->
            <div v-if="reto.variantes?.length" class="pt-2">
              <h3 class="section-title text-primary-700">Variantes</h3>
              <ul class="space-y-3">
                <li v-for="(varItem, i) in reto.variantes" :key="i" class="text-sm text-gray-700 bg-gray-50 border border-gray-200 p-4 rounded-xl">
                  <template v-if="varItem.includes(':')">
                    <strong class="text-[#1F2937] block mb-1">{{ varItem.split(':')[0] }}</strong>
                    <span>{{ varItem.substring(varItem.indexOf(':') + 1).trim() }}</span>
                  </template>
                  <template v-else>{{ varItem }}</template>
                </li>
              </ul>
            </div>

          </div>
        </div>

        <!-- Guía docente -->
        <div v-if="reto.tips_profesorado?.length" class="relative mx-0 bg-gray-50 border-t border-gray-200 px-6 py-8 md:px-12 md:py-10">
          <div class="absolute top-0 right-0 bg-white border-b border-l border-gray-200 text-gray-400 px-4 py-1.5 font-black text-[9px] tracking-widest uppercase rounded-bl-2xl">
            Uso Exclusivo Docente
          </div>
          <h2 class="text-lg md:text-xl font-black text-[#1F2937] mb-1 mt-2 flex items-center gap-3">
            <LightBulbIcon class="w-5 h-5 text-yellow-500 shrink-0" />
            Guía de Implementación
          </h2>
          <p class="text-gray-500 text-sm mb-6">Recomendaciones pedagógicas para dinamizar el reto.</p>
          <div class="grid grid-cols-1 gap-4">
            <div v-for="(tip, i) in reto.tips_profesorado" :key="i" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
              <div class="text-sm text-gray-700 leading-relaxed">
                <template v-if="tip.includes(':')">
                  <strong class="text-primary-700 flex items-center gap-1.5 mb-2 uppercase tracking-wider text-[10px]">{{ tip.split(':')[0] }}</strong>
                  <span class="block text-gray-600">{{ tip.substring(tip.indexOf(':') + 1).trim() }}</span>
                </template>
                <template v-else><span class="text-gray-600">{{ tip }}</span></template>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- CTA -->
      <div class="bg-primary-50 border border-primary-200 rounded-xl p-6 mt-8">
        <h3 class="font-bold text-primary-800 text-base mb-2">¿Tu empresa o centro quiere participar?</h3>
        <p class="text-sm text-primary-700 mb-4">Cuéntanos tu caso y te contactamos para sumarte a un reto como este.</p>
        <RouterLink :to="{ name: 'contacto' }" class="btn-primary">
          Contactar
          <ArrowRightIcon class="w-4 h-4" />
        </RouterLink>
      </div>
    </template>
    <p v-else class="text-center py-16 text-gray-400">No hemos encontrado este reto.</p>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import microretosPublicApi from '@/services/microretosPublicApi'
import {
  ChevronLeftIcon,
  DocumentTextIcon,
  BuildingOffice2Icon,
  WrenchScrewdriverIcon,
  AcademicCapIcon,
  LightBulbIcon,
  RocketLaunchIcon,
  ArrowRightIcon,
} from '@heroicons/vue/24/outline'

const route   = useRoute()
const reto    = ref(null)
const loading = ref(true)

const imagenFondo = computed(() => {
  if (!reto.value?.familia) return null
  const slug = reto.value.familia
    .toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/\s+/g, '-')
    .replace(/[^a-z0-9-]/g, '')
  const base = microretosPublicApi.defaults.baseURL.replace(/\/api$/, '')
  return `${base}/familias/${slug}.webp`
})

// Datos crudos de la empresa — MicroretoFichaResource ya los filtra sin datos de contacto.
const tieneDatosRecogidos = computed(() => {
  const e = reto.value?.empresa
  if (!e) return false
  return !!(e.dia_a_normal || e.friccion_area || e.friccion_problema
    || e.consecuencias || e.restricciones || e.lo_que_no_quieren || e.expectativas_alumno)
})

onMounted(async () => {
  try {
    const { data } = await microretosPublicApi.get(`/public/microretos/${route.params.id}`)
    reto.value = data.data ?? data
  } catch {
    reto.value = null
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
.section-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.65rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  border-bottom: 1px solid #f3f4f6;
  padding-bottom: 8px;
  margin-bottom: 14px;
}
</style>
