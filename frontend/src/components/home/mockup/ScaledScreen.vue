<template>
  <!-- Pantalla de la maqueta: dibuja el panel a un ancho de lienzo y lo escala para
       ocupar exactamente el ancho del marco (portátil o móvil), con la proporción
       width × height. Si el marco es estrecho, en vez de encoger el panel por debajo
       de `minScale` se usa un lienzo más estrecho (nunca menor que `minWidth`) y el
       panel se recoloca como en ese ancho real: el slot recibe `ancho` para ello. -->
  <div ref="frame" class="relative w-full overflow-hidden" :style="{ aspectRatio: `${width} / ${height}` }">
    <div
      v-if="lienzo"
      class="absolute top-0 left-0 origin-top-left"
      :style="{ width: `${lienzo}px`, height: `${lienzo * height / width}px`, transform: `scale(${scale})` }"
    >
      <slot :ancho="lienzo" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  width: { type: Number, required: true },      // ancho de lienzo ideal (y máximo)
  height: { type: Number, required: true },
  minWidth: { type: Number, default: null },    // lienzo mínimo; por defecto = width (sin recolocar)
  minScale: { type: Number, default: 0 },       // escala por debajo de la cual se estrecha el lienzo
})

const frame = ref(null)
const marco = ref(0)
let observer = null

// Ancho del lienzo: el ideal si cabe a escala ≥ minScale; si no, el que da esa escala,
// limitado entre minWidth y width. Se redondea a decenas para no recolocar en cada píxel.
const lienzo = computed(() => {
  if (!marco.value) return 0
  const min = props.minWidth ?? props.width
  const porEscala = props.minScale ? Math.round(marco.value / props.minScale / 10) * 10 : props.width
  return Math.min(props.width, Math.max(min, porEscala))
})
const scale = computed(() => (lienzo.value ? marco.value / lienzo.value : 0))

function update() {
  if (frame.value) marco.value = frame.value.clientWidth
}

onMounted(() => {
  update()
  observer = new ResizeObserver(update)
  observer.observe(frame.value)
})
onUnmounted(() => observer?.disconnect())
</script>
