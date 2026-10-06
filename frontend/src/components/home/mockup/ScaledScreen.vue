<template>
  <!-- Renderiza el contenido a su tamaño real (width × height px) y lo escala
       para ocupar exactamente el ancho del contenedor (pantalla del portátil o
       del móvil), conservando las proporciones del panel original. -->
  <div ref="frame" class="relative w-full overflow-hidden" :style="{ aspectRatio: `${width} / ${height}` }">
    <div
      class="absolute top-0 left-0 origin-top-left"
      :style="{ width: `${width}px`, height: `${height}px`, transform: `scale(${scale})` }"
    >
      <slot />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  width: { type: Number, required: true },
  height: { type: Number, required: true },
})

const frame = ref(null)
const scale = ref(0)
let observer = null

function update() {
  if (frame.value) scale.value = frame.value.clientWidth / props.width
}

onMounted(() => {
  update()
  observer = new ResizeObserver(update)
  observer.observe(frame.value)
})
onUnmounted(() => observer?.disconnect())
</script>
