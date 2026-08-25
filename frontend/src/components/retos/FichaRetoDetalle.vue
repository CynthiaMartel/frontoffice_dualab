<script setup>
defineProps({
  reto: { type: Object, required: true },
})
</script>

<template>
  <div class="space-y-10">
      <!-- ── FICHA TÉCNICA DEL RETO ── -->
      <div class="bg-white rounded-[2rem] shadow-[0_20px_50px_rgb(0,0,0,0.06)]
                  overflow-hidden border border-gray-100">

        <!-- Cabecera -->
        <div class="relative bg-gray-50 border-b border-gray-100 overflow-hidden">
          <div class="relative z-10 px-6 py-8 md:px-14 md:pt-12 md:pb-10 max-w-4xl">

            <p class="text-[#00A859] font-bold text-[10px] tracking-[0.2em] uppercase mb-4
                      flex items-center gap-2">
              DuaLab · Ficha de Reto
            </p>

            <h1 class="text-2xl sm:text-3xl md:text-5xl font-black text-[#1F2937]
                       tracking-tight leading-tight mb-3">
              {{ reto.titulo }}
            </h1>
            <h2 class="text-base md:text-xl text-gray-500 font-medium leading-relaxed mb-8">
              {{ reto.subtitulo }}
            </h2>

            <div class="flex flex-wrap gap-2 md:gap-3">
              <span class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-[#1F2937] text-white rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider shadow-sm">
                {{ reto.empresa_nombre }}
              </span>

              <span v-if="reto.empresa_es_simulada != null"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-amber-50 border border-amber-200 text-amber-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                {{ reto.empresa_es_simulada ? 'Empresa ficticia' : 'Empresa real' }}
              </span>

              <span v-if="reto.es_simulado"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-rose-50 border border-rose-200 text-rose-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                Info simulada
              </span>

              <span v-if="reto.familia"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-sky-50 border border-sky-200 text-sky-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                {{ reto.familia }}
              </span>

              <span v-if="reto.nivel_grupo"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-violet-50 border border-violet-200 text-violet-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                Nivel: {{ reto.nivel_grupo }}
              </span>

              <span v-if="reto.ciclo"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-teal-50 border border-teal-200 text-teal-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                {{ reto.ciclo }}
              </span>

              <span v-if="reto.curso"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-blue-50 border border-blue-200 text-blue-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                {{ reto.curso === 'ambos_cursos' ? 'Ambos Cursos: 1º y 2º' : reto.curso + 'º Curso' }}
              </span>

              <span v-if="reto.multimodulo"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                Multi-módulo
              </span>

              <span v-if="reto.empresa?.sector"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-gray-50 border border-gray-200 text-gray-600 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                {{ reto.empresa.sector }}
              </span>
              <span v-if="reto.empresa?.tamano"
                    class="flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2
                           bg-gray-50 border border-gray-200 text-gray-600 rounded-lg
                           text-[10px] md:text-xs font-bold uppercase tracking-wider">
                {{ reto.empresa.tamano }}
              </span>
            </div>
          </div>
        </div>

        <!-- Cuerpo -->
        <div class="px-6 py-8 md:px-14 md:py-12 space-y-10 md:space-y-14">

          <!-- Datos recogidos de la empresa -->
          <div class="bg-gradient-to-br from-orange-50 to-white border-2 border-orange-200
                      rounded-2xl p-5 md:p-7 shadow-sm">
            <h3 class="text-orange-700 font-black uppercase text-xs md:text-sm tracking-[0.15em] mb-5">
              Datos recogidos de la empresa
            </h3>
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
            </div>
          </div>

          <!-- Quién es / Día a día -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 lg:gap-10">
            <div v-if="reto.quien_es">
              <h3 class="section-title text-[#00A859]">¿Quién es {{ reto.empresa_nombre }}?</h3>
              <p class="text-gray-600 text-sm leading-relaxed">{{ reto.quien_es }}</p>
            </div>
            <div v-if="reto.dia_a_dia">
              <h3 class="section-title text-[#00A859]">Su día a día</h3>
              <p class="text-gray-600 text-sm leading-relaxed">{{ reto.dia_a_dia }}</p>
            </div>
          </div>

          <!-- Dificultades -->
          <div v-if="reto.dificultades?.length">
            <h3 class="section-title text-yellow-600">Dificultades</h3>
            <ul class="space-y-2 pl-1">
              <li v-for="(item, i) in reto.dificultades" :key="i"
                  class="flex items-start gap-3 text-sm text-gray-700">
                <span class="text-yellow-500 font-black mt-0.5 shrink-0">•</span>
                <span>{{ item }}</span>
              </li>
            </ul>
          </div>

          <!-- Pregunta del reto -->
          <div class="bg-gradient-to-r from-gray-50 to-white border-l-4 border-[#00A859]
                      p-6 md:p-8 rounded-r-2xl shadow-sm border-y border-r border-gray-100">
            <h3 class="text-[#00A859] font-black uppercase text-[10px] tracking-[0.2em] mb-3">
              Pregunta del Reto
            </h3>
            <p class="text-lg md:text-2xl font-bold text-[#1F2937] leading-snug">
              {{ reto.pregunta_reto }}
            </p>
          </div>

          <!-- Qué necesitan / Limitaciones -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 lg:gap-10">
            <div v-if="reto.que_necesitan?.length">
              <h3 class="section-title text-[#00A859]">Qué necesitan</h3>
              <ul class="space-y-2 pl-1">
                <li v-for="(item, i) in reto.que_necesitan" :key="i"
                    class="flex items-start gap-3 text-sm text-gray-700">
                  <span class="text-[#00A859] font-black mt-0.5 shrink-0">•</span>
                  <span>{{ item }}</span>
                </li>
              </ul>
            </div>
            <div v-if="reto.limitaciones?.length">
              <h3 class="section-title text-red-500">Limitaciones</h3>
              <ul class="space-y-2 pl-1">
                <li v-for="(item, i) in reto.limitaciones" :key="i"
                    class="flex items-start gap-3 text-sm text-gray-700">
                  <span class="text-red-500 font-black mt-0.5 shrink-0">•</span>
                  <span>{{ item }}</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Prototipos / ODS -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 lg:gap-10">
            <div v-if="reto.prototipos?.length">
              <h3 class="section-title text-[#00A859]">Ejemplos de Prototipos</h3>
              <ul class="space-y-2 pl-1">
                <li v-for="(item, i) in reto.prototipos" :key="i"
                    class="flex items-start gap-3 text-sm text-gray-700">
                  <span class="text-[#00A859] font-black mt-0.5 shrink-0">•</span>
                  <span>{{ item }}</span>
                </li>
              </ul>
            </div>
            <div v-if="reto.ods_sugeridos?.length">
              <h3 class="section-title text-blue-600">ODS Sugeridos</h3>
              <ul class="space-y-2 pl-1">
                <li v-for="ods in reto.ods_sugeridos" :key="ods"
                    class="text-sm font-semibold text-[#1F2937]">{{ ods }}</li>
              </ul>
            </div>
          </div>

          <!-- Soft skills -->
          <div v-if="reto.soft_skills?.length">
            <h3 class="flex items-center gap-2 text-purple-600 font-black text-[11px]
                       uppercase tracking-[0.15em] mb-3">
              Soft skills
            </h3>
            <div class="flex flex-wrap gap-2">
              <span v-for="(skill, i) in reto.soft_skills" :key="i"
                    class="px-3 py-1 bg-purple-50 border border-purple-200 text-purple-700
                           rounded-full text-xs font-semibold">
                {{ skill }}
              </span>
            </div>
          </div>

          <!-- RA / CE -->
          <div v-if="reto.evaluacion_oficial?.length" class="pt-2">
            <h3 class="flex items-center gap-2 text-[#1F2937] font-bold uppercase text-xs
                       tracking-widest border-b-2 border-gray-200 pb-2 mb-6">
              Módulos + RA/CE seleccionados
            </h3>
            <div class="space-y-4 md:space-y-6">
              <div v-for="evalObj in reto.evaluacion_oficial" :key="evalObj.modulo"
                   class="bg-white border border-gray-200 p-5 md:p-6 rounded-2xl shadow-sm">
                <div class="flex items-center justify-between flex-wrap gap-2 mb-4">
                  <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Módulo</p>
                    <p class="font-black text-[#1F2937] text-base md:text-lg">{{ evalObj.modulo }}</p>
                  </div>
                  <span v-if="evalObj.curso" class="shrink-0 px-3 py-1 bg-blue-50 border border-blue-200
                              text-blue-700 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                    {{ evalObj.curso }}º Curso
                  </span>
                </div>
                <div class="mb-4">
                  <p class="text-[10px] uppercase font-bold text-[#00A859] mb-1">Resultado de Aprendizaje</p>
                  <p class="text-sm font-semibold text-gray-700 bg-gray-50 p-4 rounded-xl border border-gray-100">
                    {{ evalObj.ra }}
                  </p>
                </div>
                <div class="mb-4">
                  <p class="text-[10px] uppercase font-bold text-gray-500 mb-2">Criterios de Evaluación</p>
                  <ul class="space-y-1.5">
                    <li v-for="(ce, i) in evalObj.ce" :key="i"
                        class="text-sm text-gray-600 flex items-start gap-2">
                      <span class="text-[#00A859] font-bold mt-0.5 shrink-0">✓</span>
                      <span>{{ ce }}</span>
                    </li>
                  </ul>
                </div>
                <div v-if="evalObj.aplicacion" class="mt-4 pt-4 border-t border-gray-100">
                  <p class="text-sm text-gray-500 italic">
                    <span class="font-bold not-italic text-[#1F2937]">Aplicación: </span>
                    {{ evalObj.aplicacion }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Variantes -->
          <div v-if="reto.variantes?.length" class="pt-2">
            <h3 class="section-title text-[#00A859]">Variantes</h3>
            <ul class="space-y-3">
              <li v-for="(varItem, i) in reto.variantes" :key="i"
                  class="text-sm text-gray-700 bg-gray-50 border border-gray-200 p-4 rounded-xl shadow-sm">
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

      <!-- GUÍA DOCENTE -->
      <div v-if="reto.tips_profesorado?.length"
           class="relative mt-10 bg-gray-50 rounded-[2rem] shadow-sm
                  border border-gray-200 px-6 py-8 md:px-14 md:py-12">

        <div class="absolute top-0 right-0 bg-white border-b border-l border-gray-200
                    text-gray-400 px-5 py-2 font-black text-[9px] tracking-widest uppercase
                    rounded-bl-2xl shadow-sm">
          Uso Exclusivo Docente
        </div>

        <h2 class="text-xl md:text-2xl font-black text-[#1F2937] mb-1 mt-2">
          Guía de Implementación
        </h2>
        <p class="text-gray-500 text-sm mb-8">
          Recomendaciones pedagógicas para dinamizar el reto.
        </p>

        <div class="grid grid-cols-1 gap-4 md:gap-6">
          <div v-for="(tip, i) in reto.tips_profesorado" :key="i"
               class="bg-white p-5 md:p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="text-sm text-gray-700 leading-relaxed">
              <template v-if="tip.includes(':')">
                <strong class="text-[#00A859] flex items-center gap-1.5 mb-2
                               uppercase tracking-wider text-[10px]">
                  {{ tip.split(':')[0] }}
                </strong>
                <span class="block text-gray-600">
                  {{ tip.substring(tip.indexOf(':') + 1).trim() }}
                </span>
              </template>
              <template v-else>
                <span class="text-gray-600">{{ tip }}</span>
              </template>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

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
