<template>
  <!-- Teléfono con prefijo fijo +34 (España) como en los diseños -->
  <div class="flex rounded-lg border border-gray-300 focus-within:border-primary-500 focus-within:ring-2 focus-within:ring-primary-100 transition overflow-hidden bg-white">
    <span class="flex items-center gap-1.5 px-3 text-xs font-semibold text-gray-600 bg-gray-50 border-r border-gray-200 shrink-0" aria-hidden="true">
      <span class="w-4 h-3 rounded-[2px] overflow-hidden flex flex-col"><span class="h-1/4 bg-red-600" /><span class="h-1/2 bg-yellow-400" /><span class="h-1/4 bg-red-600" /></span>
      +34
    </span>
    <input
      :id="id"
      v-model="model"
      type="tel"
      inputmode="tel"
      autocomplete="tel-national"
      pattern="[0-9 ]{9,11}"
      title="9 dígitos"
      placeholder="612 345 678"
      class="flex-1 min-w-0 px-3.5 py-2.5 text-sm text-gray-900 outline-none"
      required
    />
  </div>
</template>

<script setup>
defineProps({ id: String })
const model = defineModel({ type: String, default: '' })
</script>
