<template>
  <!-- Copia estática de /panel-docente (herramienta DuaLab) a 1280×800, tal como
       se ve en escritorio: TopBar + SidePanel + InicioDocente. Sin clases
       responsive (sm:/lg:): el lienzo es fijo y se escala con ScaledScreen. -->
  <div class="w-[1280px] h-[800px] flex flex-col bg-[#F3F4F6] font-sans text-[#1F2937] overflow-hidden">
    <PdTopBar />
    <div class="flex flex-1 min-h-0">
      <!-- SidePanel -->
      <aside class="w-72 shrink-0 bg-azul-noche border-r border-[#2C3F57] px-3 py-3 space-y-3">
        <div class="px-3 flex items-center gap-1.5 text-[9px] font-black uppercase tracking-[0.2em] text-primary-400">
          <span class="inline-flex items-center justify-center w-4 h-4 rounded-full bg-centros/20 text-primary-400 text-[8px] font-black">D</span>
          Docente
        </div>
        <div class="rounded-2xl border border-centros/20 bg-centros/5 px-2 pt-2 pb-2 space-y-1">
          <template v-for="g in menuLateral" :key="g.grupo ?? 'inicio'">
            <div v-if="g.grupo" class="flex items-center gap-1.5 px-3 py-1.5 mt-2 rounded-lg text-[9px] font-black uppercase tracking-[0.2em] text-primary-400 bg-centros/15">
              <span class="inline-flex items-center justify-center w-4 h-4 rounded-full bg-centros/25 text-[8px] font-black">{{ g.num }}</span>
              {{ g.grupo }}
            </div>
            <div v-for="item in g.items" :key="item"
                 class="flex items-center gap-3 px-3 py-2 rounded-xl text-[13px] font-semibold"
                 :class="item === 'Panel docente' ? 'bg-centros text-white shadow-md' : 'text-white/60'">
              <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
              </svg>
              {{ item }}
            </div>
          </template>
        </div>
      </aside>

      <!-- InicioDocente -->
      <main class="flex-1 min-w-0 px-7 py-6 space-y-4 overflow-hidden">
        <PdBienvenida />
        <PdContadores />

        <div class="grid grid-cols-2 gap-4 items-start">
          <!-- Columna visual izquierda: calendario + progreso -->
          <div class="flex flex-col gap-4">
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
              <div class="bg-[#374151] px-5 py-4 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-xl bg-centros/20 border border-centros/25 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-centros" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  </div>
                  <p class="text-white font-black text-sm capitalize">{{ calendario.mes }}</p>
                </div>
                <div class="flex items-center gap-1 text-white/60">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </div>
              </div>
              <div class="px-3 pt-3 pb-2">
                <div class="grid grid-cols-7 mb-1">
                  <div v-for="d in ['L','M','X','J','V','S','D']" :key="d" class="text-center text-[9px] font-black uppercase tracking-widest text-gray-300 pb-1">{{ d }}</div>
                </div>
                <div class="grid grid-cols-7 gap-px">
                  <div v-for="(day, i) in diasCalendario" :key="i" class="min-h-[52px] flex flex-col rounded-lg overflow-hidden">
                    <div v-if="day" class="px-1 pt-1">
                      <span class="w-5 h-5 flex items-center justify-center rounded-full text-[10px] font-bold"
                            :class="day === calendario.hoy ? 'bg-centros text-white' : 'text-gray-600'">{{ day }}</span>
                    </div>
                    <div v-if="day" class="flex-1 px-0.5 pb-0.5 space-y-px mt-0.5">
                      <div v-for="ev in calendario.eventos[day] ?? []" :key="ev.texto"
                           class="rounded px-1 py-px text-[8px] font-bold text-white leading-tight truncate" :class="ev.clase">{{ ev.texto }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-5 py-4">
              <p class="text-xs font-semibold text-gray-500 mb-4">Progreso de proyectos</p>
              <div class="flex items-center gap-5">
                <div class="relative shrink-0 w-24 h-24">
                  <svg viewBox="0 0 100 100" class="w-full h-full -rotate-90">
                    <circle cx="50" cy="50" r="38" fill="none" stroke="#F3F4F6" stroke-width="14" />
                    <circle v-for="seg in donut" :key="seg.label" cx="50" cy="50" r="38" fill="none"
                            :stroke="seg.color" stroke-width="13"
                            :stroke-dasharray="`${seg.dash} ${DONUT_C - seg.dash}`"
                            :transform="`rotate(${seg.rotacion}, 50, 50)`" />
                  </svg>
                  <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-xl font-black text-gray-800 leading-none">{{ donutTotal }}</span>
                    <span class="text-[9px] text-gray-400 font-medium mt-0.5">proyectos</span>
                  </div>
                </div>
                <ul class="flex-1 space-y-2 min-w-0">
                  <li v-for="seg in donut" :key="seg.label" class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full shrink-0" :style="{ backgroundColor: seg.color }" />
                    <span class="text-xs text-gray-500 truncate flex-1">{{ seg.label }}</span>
                    <span class="text-xs font-bold text-gray-700 tabular-nums">{{ seg.valor }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Columna visual derecha: encuentros + alertas + notas -->
          <div class="flex flex-col gap-4">
            <PdEncuentros />
            <PdAlertas />
            <div class="bg-[#FFFDE7] border border-amber-200/60 rounded-xl shadow-lg overflow-hidden"
                 style="background-image: repeating-linear-gradient(transparent, transparent 27px, #fde68a55 27px, #fde68a55 28px); background-position: 0 40px;">
              <div class="px-5 pt-5 pb-2.5 border-b border-amber-200/50">
                <p class="text-[10px] font-black uppercase tracking-widest text-amber-800/50 text-center">Mis notas</p>
              </div>
              <div class="px-4 py-3">
                <div v-for="n in notas" :key="n" class="flex items-start gap-2 border-b border-amber-200/40 py-2 last:border-0">
                  <span class="text-amber-400/60 text-[10px] font-black shrink-0 mt-0.5">—</span>
                  <p class="flex-1 text-xs text-amber-900/80 font-medium leading-snug">{{ n }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import PdTopBar from './PdTopBar.vue'
import PdBienvenida from './PdBienvenida.vue'
import PdContadores from './PdContadores.vue'
import PdEncuentros from './PdEncuentros.vue'
import PdAlertas from './PdAlertas.vue'
import { calendario, donut, donutTotal, DONUT_C, notas, menuLateral } from './panelDocenteDemo'

const diasCalendario = [
  ...Array(calendario.huecos).fill(null),
  ...Array.from({ length: calendario.dias }, (_, i) => i + 1),
]
</script>
