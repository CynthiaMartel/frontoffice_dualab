<template>
  <div class="max-w-3xl mx-auto px-6 py-12">
    <div v-if="loading" class="text-center py-16 text-gray-400">Cargando proyecto…</div>

    <template v-else-if="proyecto">
      <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
        <RouterLink :to="{ name: 'familias' }"
                    class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium hover:text-primary-700 transition-colors">
          <ChevronLeftIcon class="w-4 h-4" />
          Volver a Familias
        </RouterLink>
        <button v-if="equipos.length" @click="irAResolucion"
                class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider
                       text-primary-700 bg-primary-50 border border-primary-200 px-3.5 py-2 rounded-xl
                       hover:bg-primary-600 hover:text-white hover:border-primary-600 transition-all">
          <UserGroupIcon class="w-4 h-4" />
          Ver resolución del alumnado
          <ChevronDownIcon class="w-3.5 h-3.5" />
        </button>
      </div>

      <img v-if="proyecto.imagen_portada_url" :src="proyecto.imagen_portada_url" :alt="proyecto.titulo"
           class="w-full h-48 sm:h-64 object-cover rounded-2xl mb-5" />

      <!-- ══ Hoja de cuaderno — mismo diseño que la ficha de proyecto en la app DuaLab ══ -->
      <div class="notebook-page">
        <div class="notebook-margin" aria-hidden="true" />
        <div class="notebook-holes" aria-hidden="true">
          <div class="notebook-hole" /><div class="notebook-hole" /><div class="notebook-hole" />
          <div class="notebook-hole" /><div class="notebook-hole" />
        </div>

        <div class="flex items-center gap-2 mb-3">
          <span v-if="proyecto.familia" class="text-xs font-semibold bg-primary-50 text-primary-700 px-2.5 py-0.5 rounded-full border border-primary-200">
            {{ proyecto.familia }}
          </span>
        </div>

        <h1 class="text-2xl md:text-3xl font-black tracking-tight text-[#121212] mb-2 leading-tight">
          {{ proyecto.titulo }}
        </h1>
        <p v-if="proyecto.diseno_reto?.pregunta_reto" class="text-base md:text-lg font-bold italic mb-5 leading-snug text-primary-700">
          "{{ proyecto.diseno_reto.pregunta_reto }}"
        </p>

        <!-- Meta-band: empresa / centro / ciclo -->
        <div v-if="proyecto.empresa_nombre || proyecto.centro_nombre || proyecto.ciclo_nombre" class="meta-band">
          <div v-if="proyecto.empresa_nombre" class="meta-cell">
            <div class="meta-icon bg-primary-50 border-primary-200 text-primary-600">
              <BuildingOffice2Icon class="w-5 h-5" />
            </div>
            <div>
              <p class="meta-label">Empresa</p>
              <p class="meta-value">{{ proyecto.empresa_nombre }}</p>
            </div>
          </div>
          <div v-if="proyecto.centro_nombre" class="meta-cell">
            <div class="meta-icon bg-blue-50 border-blue-200 text-blue-500">
              <AcademicCapIcon class="w-5 h-5" />
            </div>
            <div>
              <p class="meta-label">Centro educativo</p>
              <p class="meta-value">{{ proyecto.centro_nombre }}</p>
            </div>
          </div>
          <div v-if="proyecto.ciclo_nombre" class="meta-cell">
            <div class="meta-icon bg-emerald-50 border-emerald-200 text-emerald-600">
              <CheckBadgeIcon class="w-5 h-5" />
            </div>
            <div>
              <p class="meta-label">Ciclo formativo</p>
              <p class="meta-value">{{ proyecto.ciclo_nombre }}</p>
            </div>
          </div>
        </div>

        <!-- El reto -->
        <div v-if="proyecto.diseno_reto?.descripcion || proyecto.fundamentacion?.contexto"
             class="flex flex-wrap items-center justify-between gap-2">
          <p class="group-header !mb-0">El reto</p>
          <RouterLink v-if="proyecto.microreto_uuid"
                      :to="{ name: 'reto-detalle', params: { id: proyecto.microreto_uuid } }"
                      class="px-3 py-1.5 rounded-xl border-2 border-primary-200 text-[10px] font-black uppercase
                             tracking-wider text-primary-700 bg-primary-50 hover:bg-primary-600 hover:text-white
                             hover:border-primary-600 transition-all mb-3">
            📎 Ver ficha reto original
          </RouterLink>
        </div>
        <div v-if="proyecto.diseno_reto?.descripcion || proyecto.fundamentacion?.contexto"
             class="grid gap-4 sm:grid-cols-2 mb-6">
          <div v-if="proyecto.diseno_reto?.descripcion" class="card-section sm:col-span-2">
            <p class="reto-section-title">Diseño del reto</p>
            <p class="text-sm text-gray-600 leading-relaxed">{{ proyecto.diseno_reto.descripcion }}</p>
            <div v-if="proyecto.diseno_reto.restricciones" class="mt-3 pt-3 border-t border-gray-100">
              <p class="reto-subsection-label">Restricciones</p>
              <p class="text-xs text-gray-500">{{ proyecto.diseno_reto.restricciones }}</p>
            </div>
            <div v-if="proyecto.diseno_reto.entregables" class="mt-3 pt-3 border-t border-gray-100">
              <p class="reto-subsection-label">Entregables</p>
              <p class="text-xs text-gray-500">{{ proyecto.diseno_reto.entregables }}</p>
            </div>
          </div>

          <div v-if="proyecto.fundamentacion?.contexto || proyecto.fundamentacion?.justificacion || proyecto.fundamentacion?.innovacion"
               class="card-section sm:col-span-2">
            <p class="reto-section-title">Fundamentación</p>
            <div v-if="proyecto.fundamentacion.contexto" class="mb-3">
              <p class="reto-subsection-label">Contexto de partida</p>
              <p class="text-sm text-gray-600 leading-relaxed">{{ proyecto.fundamentacion.contexto }}</p>
            </div>
            <div v-if="proyecto.fundamentacion.justificacion" class="mb-3">
              <p class="reto-subsection-label">Justificación pedagógica</p>
              <p class="text-sm text-gray-600 leading-relaxed">{{ proyecto.fundamentacion.justificacion }}</p>
            </div>
            <div v-if="proyecto.fundamentacion.innovacion">
              <p class="reto-subsection-label">Elemento innovador</p>
              <p class="text-sm text-gray-600 leading-relaxed">{{ proyecto.fundamentacion.innovacion }}</p>
            </div>
          </div>
        </div>

        <!-- Currículo -->
        <p v-if="proyecto.modulos_seleccionados?.length || raCeBlocks.length || proyecto.ra_ce?.trim()"
           class="group-header">Currículo</p>
        <div v-if="proyecto.modulos_seleccionados?.length || raCeBlocks.length || proyecto.ra_ce?.trim()"
             class="grid gap-4 mb-6">
          <div v-if="proyecto.modulos_seleccionados?.length" class="card-section">
            <p class="section-label">Módulos ({{ proyecto.modulos_seleccionados.length }})</p>
            <div class="flex flex-wrap gap-1.5">
              <span v-for="(m, i) in proyecto.modulos_seleccionados" :key="i"
                    class="text-xs border border-primary-200 bg-primary-50 text-primary-700 px-2.5 py-1 rounded-full">
                {{ m }}
              </span>
            </div>
          </div>

          <!-- RA/CE — desplegable -->
          <div v-if="raCeBlocks.length || proyecto.ra_ce?.trim()" class="card-section">
            <button @click="raCeAbierto = !raCeAbierto" type="button" class="w-full flex items-center justify-between text-left">
              <p class="section-label !mb-0">Resultados de Aprendizaje y Criterios de Evaluación</p>
              <ChevronDownIcon :class="['w-4 h-4 text-gray-400 transition-transform duration-200 shrink-0', raCeAbierto ? 'rotate-180' : '']" />
            </button>
            <Transition enter-active-class="transition-all duration-200 ease-out" enter-from-class="opacity-0 -translate-y-1"
                        leave-active-class="transition-all duration-150 ease-in" leave-to-class="opacity-0 -translate-y-1">
              <div v-if="raCeAbierto" class="pt-3">
                <div v-if="raCeBlocks.length" class="space-y-4">
                  <div v-for="(block, i) in raCeBlocks" :key="i" class="border border-gray-100 rounded-xl p-3.5">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-1 text-primary-700">{{ block.modulo }}</p>
                    <p class="text-sm font-semibold text-[#1F2937] mb-2">{{ block.ra }}</p>
                    <ul v-if="block.ces.length" class="space-y-1 pl-1">
                      <li v-for="(ce, j) in block.ces" :key="j" class="flex items-start gap-2 text-xs text-gray-500">
                        <span class="text-amber-400 shrink-0 font-bold mt-0.5">•</span>{{ ce }}
                      </li>
                    </ul>
                  </div>
                </div>
                <p v-else class="text-sm text-gray-600 leading-relaxed whitespace-pre-wrap">{{ proyecto.ra_ce }}</p>
              </div>
            </Transition>
          </div>
        </div>

        <!-- Propuesta: fases -->
        <p v-if="proyecto.fases?.length || proyecto.metodologia" class="group-header">Propuesta</p>
        <div v-if="proyecto.fases?.length || proyecto.metodologia" class="grid gap-4 sm:grid-cols-2 mb-6">
          <div v-if="proyecto.fases?.length" class="card-section sm:col-span-2">
            <p class="section-label">Fases del proyecto</p>
            <ol class="space-y-2.5">
              <li v-for="(f, i) in proyecto.fases" :key="i" class="flex items-start gap-2.5 text-sm">
                <span class="w-5 h-5 rounded-full font-black text-[10px] flex items-center justify-center shrink-0 mt-0.5 bg-primary-100 text-primary-700">
                  {{ i + 1 }}
                </span>
                <div>
                  <p class="font-bold text-[#1F2937]">{{ f.nombre }}</p>
                  <p v-if="f.descripcion" class="text-gray-400 text-xs mt-0.5">{{ f.descripcion }}</p>
                </div>
              </li>
            </ol>
          </div>
          <div v-if="proyecto.metodologia" class="card-section sm:col-span-2">
            <p class="section-label">Metodología</p>
            <p class="text-sm text-gray-600 leading-relaxed">{{ proyecto.metodologia }}</p>
          </div>
        </div>

        <!-- Objetivos / KPIs -->
        <p v-if="proyecto.objetivos?.length || proyecto.kpis?.length" class="group-header">Objetivos</p>
        <div v-if="proyecto.objetivos?.length || proyecto.kpis?.length" class="grid gap-4 sm:grid-cols-2 mb-6">
          <div v-if="proyecto.objetivos?.length" class="card-section">
            <p class="section-label">Objetivos</p>
            <ul class="space-y-1.5">
              <li v-for="(obj, i) in proyecto.objetivos" :key="i" class="flex items-start gap-2 text-sm text-gray-600">
                <span class="shrink-0 mt-0.5 font-bold text-primary-600">›</span> {{ obj }}
              </li>
            </ul>
          </div>
          <div v-if="proyecto.kpis?.length" class="card-section">
            <p class="section-label">KPIs ({{ proyecto.kpis.length }})</p>
            <ul class="space-y-1.5 pt-1">
              <li v-for="(kpi, i) in proyecto.kpis" :key="i" class="flex items-start gap-2 text-sm text-gray-600">
                <span class="shrink-0 mt-0.5 text-primary-600">✓</span> {{ kpi }}
              </li>
            </ul>
          </div>
        </div>

        <!-- Resumen -->
        <p v-if="proyecto.resumen" class="group-header">Resumen</p>
        <div v-if="proyecto.resumen" class="card-section mb-6">
          <p class="text-sm text-gray-600 leading-relaxed">{{ proyecto.resumen }}</p>
        </div>

        <!-- Recursos adjuntos -->
        <p v-if="proyecto.videos?.length || proyecto.documentos?.length" class="group-header">Recursos adjuntos</p>
        <div v-if="proyecto.videos?.length || proyecto.documentos?.length" class="card-section space-y-5">
          <div v-if="proyecto.videos?.length">
            <p class="section-label">Vídeos</p>
            <div class="space-y-2">
              <a v-for="(v, i) in proyecto.videos" :key="i" :href="v.url" target="_blank" rel="noopener"
                 class="flex items-center gap-2 p-2.5 bg-gray-50 rounded-xl border border-gray-100 hover:border-primary-200 hover:bg-primary-50/40 transition-colors">
                <span class="w-7 h-7 rounded-lg bg-primary-50 shrink-0 flex items-center justify-center">
                  <PlayCircleIcon class="w-4 h-4 text-primary-500" />
                </span>
                <span class="flex-1 min-w-0 text-left">
                  <p class="text-xs font-bold text-gray-700 truncate">{{ v.label || v.filename }}</p>
                </span>
              </a>
            </div>
          </div>
          <div v-if="proyecto.documentos?.length">
            <p class="section-label">Documentos, imágenes, etc.</p>
            <div class="space-y-2">
              <a v-for="(d, i) in proyecto.documentos" :key="i" :href="d.url" target="_blank" rel="noopener"
                 class="flex items-center gap-2 p-2.5 bg-gray-50 rounded-xl border border-gray-100 hover:border-primary-200 hover:bg-primary-50/40 transition-colors">
                <span class="w-7 h-7 rounded-lg bg-primary-50 shrink-0 flex items-center justify-center">
                  <DocumentIcon class="w-4 h-4 text-primary-500" />
                </span>
                <span class="flex-1 min-w-0 text-left">
                  <p class="text-xs font-bold text-gray-700 truncate">{{ d.label || d.filename }}</p>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- ══ Resolución del alumnado — recorte aparte, como en la app DuaLab ══ -->
      <div v-if="equipos.length" id="resolucion-alumnado" class="ficha-recortable">
        <div class="ficha-recortable__corte" />
        <h2 class="text-lg font-black text-[#1F2937] mb-4 flex items-center gap-2">
          <UserGroupIcon class="w-5 h-5 text-primary-600" />
          Resolución del alumnado
        </h2>
        <div class="space-y-5">
          <div v-for="(eq, i) in equipos" :key="i" class="ficha-recortable__card p-5">
            <p class="text-sm font-black text-[#1F2937] mb-3">{{ eq.nombre }}</p>

            <div v-if="eq.miembros?.length" class="flex flex-wrap gap-1.5 mb-4">
              <span v-for="(m, j) in eq.miembros" :key="j"
                    class="text-xs bg-primary-50 border border-primary-200 text-primary-700 px-2.5 py-1 rounded-full">
                {{ m.alias }}<span v-if="m.rol" class="text-primary-400"> · {{ m.rol }}</span>
              </span>
            </div>

            <div v-if="eq.diagnostico_final?.resumen" class="card-section mb-3">
              <p class="section-label">Diagnóstico final</p>
              <p class="text-sm text-gray-600 leading-relaxed mb-3">{{ eq.diagnostico_final.resumen }}</p>
              <div class="grid gap-3 sm:grid-cols-2">
                <div v-if="eq.diagnostico_final.fortalezas?.length">
                  <p class="reto-subsection-label">Fortalezas</p>
                  <ul class="space-y-1">
                    <li v-for="(f, k) in eq.diagnostico_final.fortalezas" :key="k" class="text-xs text-gray-600 flex items-start gap-1.5">
                      <span class="text-emerald-500 shrink-0">✓</span>{{ f }}
                    </li>
                  </ul>
                </div>
                <div v-if="eq.diagnostico_final.areas_mejora?.length">
                  <p class="reto-subsection-label">Áreas de mejora</p>
                  <ul class="space-y-1">
                    <li v-for="(a, k) in eq.diagnostico_final.areas_mejora" :key="k" class="text-xs text-gray-600 flex items-start gap-1.5">
                      <span class="text-amber-500 shrink-0">›</span>{{ a }}
                    </li>
                  </ul>
                </div>
              </div>
              <p v-if="eq.diagnostico_final.conclusion" class="text-xs text-gray-500 italic mt-3 pt-3 border-t border-gray-100">
                {{ eq.diagnostico_final.conclusion }}
              </p>
            </div>

            <div v-if="eq.reflexion_grupal?.length" class="card-section mb-3">
              <p class="section-label">Reflexión grupal</p>
              <div class="space-y-2.5">
                <div v-for="(r, k) in eq.reflexion_grupal" :key="k">
                  <p class="text-xs font-bold text-gray-700">{{ r.pregunta }}</p>
                  <p class="text-sm text-gray-600 leading-relaxed">{{ r.respuesta }}</p>
                </div>
              </div>
            </div>

            <div v-if="eq.reflexiones_individuales?.length" class="card-section">
              <p class="section-label">Reflexiones individuales</p>
              <div class="grid gap-3 sm:grid-cols-2">
                <div v-for="(respuestas, k) in eq.reflexiones_individuales" :key="k" class="border border-gray-100 rounded-xl p-3">
                  <p class="text-[10px] font-black uppercase tracking-wider text-primary-600 mb-2">Alumno/a {{ k + 1 }}</p>
                  <div class="space-y-2">
                    <div v-for="(r, j) in respuestas" :key="j">
                      <p class="text-[11px] font-bold text-gray-700">{{ r.pregunta }}</p>
                      <p class="text-xs text-gray-500 leading-relaxed">{{ r.respuesta }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-primary-50 border border-primary-200 rounded-xl p-6 mt-2">
        <h3 class="font-bold text-primary-800 text-base mb-2">¿Tu empresa o centro quiere participar?</h3>
        <p class="text-sm text-primary-700 mb-4">Cuéntanos tu caso y te contactamos para sumarte a un proyecto como este.</p>
        <RouterLink :to="{ name: 'contacto' }" class="btn-primary">
          Contactar
          <ArrowRightIcon class="w-4 h-4" />
        </RouterLink>
      </div>
    </template>

    <p v-else class="text-center py-16 text-gray-400">No hemos encontrado este proyecto.</p>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import microretosPublicApi from '@/services/microretosPublicApi'
import {
  ChevronLeftIcon,
  ChevronDownIcon,
  BuildingOffice2Icon,
  AcademicCapIcon,
  CheckBadgeIcon,
  PlayCircleIcon,
  DocumentIcon,
  UserGroupIcon,
  ArrowRightIcon,
} from '@heroicons/vue/24/outline'

const route = useRoute()
const proyecto = ref(null)
const equipos = ref([])
const loading = ref(true)
const raCeAbierto = ref(false)

// Mismo parseo que StartupDayDetalle.vue en la app DuaLab: ra_ce es texto libre
// con bloques separados por línea en blanco ("[Módulo]\nRA: ...\n\n• CE\n• CE").
const raCeBlocks = computed(() => {
  const texto = proyecto.value?.ra_ce
  if (!texto?.trim()) return []
  return texto.split('\n\n').map(block => {
    const lines = block.split('\n')
    const modulo = lines[0]?.replace(/^\[|\]$/g, '').trim() || ''
    const ra     = lines[1]?.replace(/^RA:\s*/, '').trim() || ''
    const ces    = lines.slice(3).map(l => l.replace(/^\s*•\s*/, '').trim()).filter(Boolean)
    return { modulo, ra, ces }
  }).filter(b => b.modulo)
})

function irAResolucion() {
  document.getElementById('resolucion-alumnado')?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

onMounted(async () => {
  try {
    const { data } = await microretosPublicApi.get(`/public/microproyectos/${route.params.uuid}`)
    proyecto.value = data.data ?? data
  } catch {
    proyecto.value = null
  } finally {
    loading.value = false
  }

  try {
    const { data } = await microretosPublicApi.get(`/public/microproyectos/${route.params.uuid}/equipos`)
    equipos.value = data.data ?? data
  } catch {
    equipos.value = []
  }
})
</script>

<style scoped>
/* Réplica del look "hoja de cuaderno" de la ficha de proyecto en la app DuaLab
   (frontend-microretos/src/views/StartupDayDetalle.vue) — CSS en crudo, sin
   depender de los tokens de color propios de esa app (centros/empresas). */
.notebook-page {
  position: relative;
  overflow: hidden;
  background-color: #fefef8;
  background-image:
    linear-gradient(90deg, #eef1f5 0, #eef1f5 3.75rem, transparent 3.75rem),
    repeating-linear-gradient(transparent, transparent 31px, #c8d9f0 31px, #c8d9f0 32px);
  padding: 2rem 1.75rem 2.5rem 5.5rem;
  border-radius: 0.75rem;
  border: 1px solid #dde3ed;
  box-shadow: 0 4px 24px -4px rgba(0,0,0,0.08), 0 1px 4px rgba(0,0,0,0.04), 2px 0 0 0 #d1dae8 inset;
  margin-bottom: 2rem;
}
.notebook-margin { position: absolute; top: 0; bottom: 0; left: 4.3rem; width: 1.5px; background: #fca5a5; pointer-events: none; }
.notebook-holes { position: absolute; left: 1.25rem; top: 0; bottom: 0; display: flex; flex-direction: column; justify-content: space-around; padding: 1.75rem 0; pointer-events: none; z-index: 2; }
.notebook-hole { width: 1.1rem; height: 1.1rem; border-radius: 50%; background: white; border: 1.5px solid #c4cdd9; box-shadow: inset 0 1px 3px #b8c2cc; }

.meta-band { display: flex; flex-wrap: wrap; border-radius: 0.875rem; margin-bottom: 1.75rem; overflow: hidden; border: 1px solid #dde3ed; background: linear-gradient(135deg, #f8fafd 0%, #f1f5fb 100%); box-shadow: 0 1px 4px rgba(0,0,0,0.05); }
.meta-cell { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.875rem 1rem; flex: 1; min-width: 145px; border-right: 1px solid #dde3ed; }
.meta-cell:last-child { border-right: none; }
.meta-icon { width: 2.25rem; height: 2.25rem; border-radius: 0.75rem; border-width: 1px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.meta-label { display: block; font-size: 0.625rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.15em; color: #9ca3af; margin-bottom: 0.125rem; }
.meta-value { display: block; font-size: 0.875rem; font-weight: 700; color: #1f2937; line-height: 1.35; }

.card-section { background: #fff; border: 1px solid #e5e7eb; border-radius: 1rem; box-shadow: 0 1px 2px rgba(0,0,0,0.04); padding: 1.25rem; }
.section-label { font-size: 0.625rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; color: #9ca3af; margin-bottom: 0.5rem; }
.group-header { font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.25em; margin-bottom: 0.75rem; padding-left: 0.75rem; border-left: 4px solid rgba(var(--color-primary-600, 37 99 235) / 0.4); color: #1d4ed8; }
.reto-section-title { font-size: 0.875rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; color: #1d4ed8; margin-bottom: 0.75rem; padding-bottom: 0.5rem; border-bottom: 2px solid rgba(29,78,216,0.15); }
.reto-subsection-label { font-size: 0.625rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; color: #1d4ed8; margin-bottom: 0.25rem; }

/* Resolución del alumnado: recorte aparte, igual que en StartupDayDetalle.vue —
   línea de corte punteada + tarjetas con borde punteado naranja, para marcar que es
   un documento distinto (datos de equipos) del proyecto en sí. */
.ficha-recortable { margin-top: 1.75rem; }
.ficha-recortable__corte { border-top: 2px dashed #c7cddb; margin-bottom: 1.25rem; }
.ficha-recortable__card {
  background: #fff;
  border: 2px dashed #FFD2A6;
  border-radius: 1.5rem;
  box-shadow: 0 4px 20px -4px rgba(255, 137, 32, 0.15), 0 1px 4px rgba(0, 0, 0, 0.03);
}

@media (max-width: 640px) {
  .notebook-page { padding: 1.5rem 1rem 2rem 4.5rem; }
  .meta-cell { flex: 1 0 100%; border-right: none; border-bottom: 1px solid #dde3ed; }
  .meta-cell:last-child { border-bottom: none; }
}
</style>
