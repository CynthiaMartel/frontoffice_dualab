<template>
  <!-- Pasos del formulario: completado (check), actual (relleno) o pendiente -->
  <ol class="flex items-center gap-2 overflow-x-auto pb-1" aria-label="Progreso del formulario">
    <li v-for="(paso, i) in pasos" :key="paso" class="flex items-center gap-2 shrink-0">
      <span
        class="w-6 h-6 rounded-full flex items-center justify-center text-[11px] font-bold shrink-0"
        :class="estado(i) === 'hecho' ? 'bg-primary-600 text-white'
          : estado(i) === 'actual' ? 'bg-primary-600 text-white ring-4 ring-primary-100'
          : 'bg-gray-100 text-gray-400'"
        :aria-current="estado(i) === 'actual' ? 'step' : undefined"
      >
        <svg v-if="estado(i) === 'hecho'" class="w-3 h-3" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M1.5 5l2.5 2.5L8.5 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <template v-else>{{ i + 1 }}</template>
      </span>
      <span class="text-[11px] font-semibold whitespace-nowrap" :class="estado(i) === 'pendiente' ? 'text-gray-400' : 'text-azul-noche'">{{ paso }}</span>
      <span v-if="i < pasos.length - 1" class="w-6 h-px bg-gray-200" aria-hidden="true" />
    </li>
  </ol>
</template>

<script setup>
// completados: array de booleanos, uno por paso.
const props = defineProps({ pasos: Array, completados: Array })

function estado(i) {
  if (props.completados[i]) return 'hecho'
  const actual = props.completados.findIndex((c) => !c)
  return i === actual ? 'actual' : 'pendiente'
}
</script>
