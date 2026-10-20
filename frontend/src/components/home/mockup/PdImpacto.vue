<template>
  <!-- "Impacto acumulado del curso" de InicioDocente.vue: 4 líneas acumuladas en el
       mismo eje, área suave bajo la más alta y leyenda debajo. Como en la herramienta,
       el SVG se dibuja al ancho real de la tarjeta (en px del lienzo, sin la escala). -->
  <article class="flex h-full min-w-0 flex-col rounded-2xl bg-white p-4 shadow-sm ring-1 ring-gray-200/70">
    <div class="mb-3">
      <p class="font-heading text-lg font-bold text-azul-noche">Impacto acumulado del curso</p>
      <p class="text-sm text-gray-500">Curso 2025/2026 · evolución de septiembre a junio</p>
    </div>
    <div ref="caja" class="w-full">
      <svg :width="CH.w" :height="CH.h" :viewBox="`0 0 ${CH.w} ${CH.h}`" class="block">
        <defs>
          <linearGradient :id="idArea" x1="0" x2="0" y1="0" y2="1">
            <stop offset="0%" stop-color="#FF8920" stop-opacity="0.16" />
            <stop offset="100%" stop-color="#FF8920" stop-opacity="0" />
          </linearGradient>
        </defs>
        <g v-for="t in ticks" :key="t">
          <line :x1="CH.l" :x2="CH.w - CH.r" :y1="y(t)" :y2="y(t)" stroke="#EEF0F3" />
          <text :x="CH.l - 8" :y="y(t) + 4" text-anchor="end" font-size="11" fill="#9CA3AF">{{ t }}</text>
        </g>
        <!-- Con poco hueco por mes, solo se rotula uno de cada dos (como la herramienta) -->
        <template v-for="(m, i) in MESES" :key="m">
          <text v-if="paso >= 32 || i % 2 === 0" :x="x(i)" :y="CH.h - 6" text-anchor="middle" font-size="11" fill="#6B7280">{{ m }}</text>
        </template>
        <path :d="area" :fill="`url(#${idArea})`" />
        <g v-for="s in curvas" :key="s.corto">
          <path :d="s.linea" fill="none" :stroke="s.color" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" />
          <circle v-for="(p, i) in s.pts" :key="i" :cx="p[0]" :cy="p[1]" r="3.5" :fill="s.color" stroke="white" stroke-width="1.5" />
        </g>
      </svg>
    </div>
    <ul class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1 px-1 text-xs text-gray-600">
      <li v-for="s in impacto" :key="s.corto" class="flex items-center gap-1.5 whitespace-nowrap">
        <span class="h-2.5 w-2.5 rounded-full" :style="{ background: s.color }" />{{ s.corto }}
      </li>
    </ul>
  </article>
</template>

<script>
// Ids de degradado únicos: portátil y móvil pintan la gráfica a la vez en la misma página
let siguienteId = 0
</script>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { MESES, impacto, Y_MAX } from './panelDocenteDemo'

const idArea = `pd-imp-${siguienteId++}`

// offsetWidth = ancho de maquetación, sin la escala del transform de ScaledScreen
const caja = ref(null)
const ancho = ref(560)
let observer = null
onMounted(() => {
  const medir = () => { ancho.value = Math.max(240, caja.value.offsetWidth) }
  medir()
  observer = new ResizeObserver(medir)
  observer.observe(caja.value)
})
onUnmounted(() => observer?.disconnect())

const CH = computed(() => ({ w: ancho.value, h: 200, l: 36, r: 16, t: 12, b: 26 }))
const ticks = [0, 175, 350, 525, 700]
const paso = computed(() => (CH.value.w - CH.value.l - CH.value.r) / (MESES.length - 1))
const x = (i) => CH.value.l + i * paso.value
const y = (v) => CH.value.t + (1 - v / Y_MAX) * (CH.value.h - CH.value.t - CH.value.b)

const curvas = computed(() => impacto.map(s => {
  const pts = s.acum.map((v, i) => [x(i), y(v)])
  return { ...s, pts, linea: pts.map(([px, py], i) => `${i ? 'L' : 'M'}${px},${py}`).join(' ') }
}))
const area = computed(() => {
  const top = curvas.value[0].pts
  return `M${top[0][0]},${y(0)} ` + top.map(([px, py]) => `L${px},${py}`).join(' ') + ` L${top.at(-1)[0]},${y(0)} Z`
})
</script>
