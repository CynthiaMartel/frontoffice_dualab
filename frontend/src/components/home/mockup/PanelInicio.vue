<template>
  <!-- Copia estática del panel de inicio (/panel-docente de la herramienta DuaLab):
       TopBar + SidePanel + InicioDocente. Es responsive respecto al ancho del lienzo
       (`ancho`, que da ScaledScreen) y no al de la ventana: la misma maqueta se ve como
       escritorio en el portátil grande, como tablet en el portátil pequeño y como
       móvil en el teléfono, con los mismos tramos que la herramienta real. -->
  <div class="h-full flex flex-col bg-[#F3F6FA] font-sans text-azul-noche overflow-hidden" :style="{ width: `${ancho}px` }">
    <PdTopBar :compacto="l.compacto" :hamburguesa="!l.sidebar" />
    <div class="flex flex-1 min-h-0">
      <!-- SidePanel: fijo en escritorio; en pantallas menores es un cajón cerrado (menú hamburguesa) -->
      <aside v-if="l.sidebar" class="w-60 shrink-0 flex flex-col bg-azul-noche border-r border-[#2C3F57] px-3 py-3 shadow-[6px_0_32px_rgba(0,0,0,0.25)]">
        <template v-for="g in menuLateral" :key="g.grupo ?? 'inicio'">
          <p v-if="g.grupo" class="px-3 pt-4 pb-1.5 text-[10px] font-bold uppercase tracking-[0.18em] text-white/40">{{ g.grupo }}</p>
          <div class="space-y-0.5">
            <div v-for="item in g.items" :key="item.label"
                 class="flex items-center gap-2.5 rounded-2xl px-3 py-2.5 text-sm font-bold"
                 :class="item.activa ? 'bg-[#6BA4D5]/20 text-[#6BA4D5] shadow-[inset_3px_0_0_#6BA4D5]' : 'text-white/70'">
              <svg class="h-[18px] w-[18px] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path :d="ICONOS[item.icon]" /></svg>
              {{ item.label }}
            </div>
          </div>
        </template>
        <div class="relative mt-auto h-24 overflow-hidden rounded-2xl border border-white/15 bg-gradient-to-br from-[#2E5F8F] via-[#24486E] to-[#1B3553] px-4 py-3 shadow-[0_8px_24px_rgba(0,0,0,0.25)]">
          <svg class="absolute inset-x-0 bottom-0 h-12 w-full" viewBox="0 0 240 48" preserveAspectRatio="none">
            <path d="M0 30 C60 14 120 46 240 22 V48 H0Z" fill="#FF8920" opacity="0.85" />
            <path d="M0 38 C70 26 140 50 240 34 V48 H0Z" fill="#3FC7C8" opacity="0.9" />
            <path d="M0 44 C80 38 160 52 240 44 V48 H0Z" fill="#ffffff" opacity="0.35" />
          </svg>
          <img src="@/assets/logo_colores.png" alt="" class="absolute right-3 top-1/2 h-16 w-auto -translate-y-1/2 object-contain drop-shadow-[0_4px_10px_rgba(0,0,0,0.35)]" />
          <p class="relative text-base font-black tracking-wide text-white">DUALAB</p>
          <p class="relative mt-1 max-w-[8.5rem] text-xs font-semibold leading-snug text-white/85">Un ecosistema de oportunidades</p>
        </div>
      </aside>

      <main class="flex-1 min-w-0 overflow-hidden" :class="l.compacto ? 'px-4 py-5' : 'px-8 py-5'">
        <!-- Escritorio: columna principal + columna lateral de 300px -->
        <div v-if="l.lateral" class="grid grid-cols-[minmax(0,1fr)_300px] gap-4">
          <div class="flex min-w-0 flex-col gap-4">
            <PdBienvenida />
            <PdResumen />
            <div class="grid grid-cols-[minmax(0,1.45fr)_minmax(0,1fr)] gap-4">
              <PdImpacto />
              <PdEstados />
            </div>
            <div class="grid grid-cols-[minmax(0,1.45fr)_minmax(0,1fr)] gap-4">
              <PdProyectos />
              <PdHerramientas />
            </div>
          </div>
          <div class="flex min-w-0 flex-col gap-4">
            <PdEncuentros />
            <PdTareas />
            <PdEmpresas />
          </div>
        </div>

        <!-- Tablet y móvil: una columna en el orden de prioridad de la herramienta;
             las parejas siguen lado a lado mientras quepan -->
        <div v-else class="flex flex-col gap-4">
          <PdBienvenida :compacto="!l.bienvenidaAncha" />
          <PdResumen :compacto="!l.kpis4" />
          <div class="grid gap-4" :class="l.parejas ? 'grid-cols-[minmax(0,1.45fr)_minmax(0,1fr)]' : 'grid-cols-1'">
            <PdImpacto />
            <PdEstados />
          </div>
          <div class="grid gap-4" :class="l.parejas ? 'grid-cols-2' : 'grid-cols-1'">
            <PdEncuentros />
            <PdTareas />
          </div>
          <div class="grid gap-4" :class="l.parejas ? 'grid-cols-[minmax(0,1.45fr)_minmax(0,1fr)]' : 'grid-cols-1'">
            <PdProyectos :compacto="!l.parejas" />
            <PdHerramientas />
          </div>
          <PdEmpresas />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import PdTopBar from './PdTopBar.vue'
import PdBienvenida from './PdBienvenida.vue'
import PdResumen from './PdResumen.vue'
import PdImpacto from './PdImpacto.vue'
import PdEstados from './PdEstados.vue'
import PdEncuentros from './PdEncuentros.vue'
import PdProyectos from './PdProyectos.vue'
import PdHerramientas from './PdHerramientas.vue'
import PdTareas from './PdTareas.vue'
import PdEmpresas from './PdEmpresas.vue'
import { ICONOS, menuLateral } from './panelDocenteDemo'

const props = defineProps({ ancho: { type: Number, required: true } })

// Tramos de la maqueta según el ancho del lienzo (px sin escalar)
const l = computed(() => {
  const w = props.ancho
  const sidebar  = w >= 1200                       // SidePanel fijo (lg+ en la herramienta)
  const compacto = w < 640                         // TopBar de móvil y márgenes reducidos
  const contenido = w - (sidebar ? 240 : 0) - (compacto ? 32 : 64)
  return {
    sidebar, compacto,
    lateral: contenido >= 1000,                    // columna lateral de 300px
    bienvenidaAncha: contenido >= 560,             // foto a la derecha del saludo
    kpis4: contenido >= 600,                       // contadores en una fila de 4
    parejas: contenido >= 620,                     // gráfica|donut, encuentros|tareas, proyectos|herramientas
  }
})
</script>
