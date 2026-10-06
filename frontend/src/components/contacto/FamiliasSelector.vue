<template>
  <!-- Selector múltiple de familias profesionales (máximo `max`) -->
  <div ref="root" class="relative">
    <button
      :id="id"
      type="button"
      class="form-input bg-white flex items-center justify-between gap-2 text-left"
      :aria-expanded="abierto"
      @click="abierto = !abierto"
    >
      <span v-if="!model.length" class="text-gray-400">Selecciona las familias profesionales</span>
      <span v-else class="flex flex-wrap gap-1">
        <span v-for="f in model" :key="f" class="inline-flex items-center gap-1 bg-primary-100 text-primary-700 rounded-full px-2 py-0.5 text-[11px] font-semibold">
          {{ f }}
          <span role="button" tabindex="0" class="hover:text-red-500" :aria-label="`Quitar ${f}`"
                @click.stop="quitar(f)" @keydown.enter.stop.prevent="quitar(f)">×</span>
        </span>
      </span>
      <svg class="w-4 h-4 text-gray-500 shrink-0 transition-transform" :class="abierto ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>
    <div v-if="abierto" class="absolute z-20 mt-1 w-full max-h-64 overflow-y-auto bg-white border border-gray-200 rounded-lg shadow-lg p-2">
      <label v-for="f in opciones" :key="f"
             class="flex items-center gap-2 px-2 py-1.5 rounded text-sm"
             :class="!model.includes(f) && model.length >= max ? 'text-gray-300 cursor-not-allowed' : 'text-gray-700 hover:bg-primary-50 cursor-pointer'">
        <input type="checkbox" class="accent-primary-600" :value="f" :checked="model.includes(f)"
               :disabled="!model.includes(f) && model.length >= max" @change="alternar(f)" />
        {{ f }}
      </label>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

defineProps({ id: String, opciones: Array, max: { type: Number, default: 4 } })
const model = defineModel({ type: Array, default: () => [] })

const abierto = ref(false)
const root = ref(null)

function alternar(f) {
  model.value = model.value.includes(f) ? model.value.filter((x) => x !== f) : [...model.value, f]
}
function quitar(f) {
  model.value = model.value.filter((x) => x !== f)
}

// Cerrar al hacer clic fuera
function onDocClick(e) {
  if (root.value && !root.value.contains(e.target)) abierto.value = false
}
onMounted(() => document.addEventListener('click', onDocClick))
onUnmounted(() => document.removeEventListener('click', onDocClick))
</script>
