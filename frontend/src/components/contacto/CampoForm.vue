<template>
  <!-- Etiqueta + control (slot) + error del backend, con el estilo de los diseños -->
  <div :class="$attrs.class">
    <label :for="id" class="flex items-baseline justify-between gap-2 text-xs font-semibold text-azul-noche mb-1.5">
      <span>{{ label }}<span v-if="required" class="text-red-500"> *</span></span>
      <span v-if="hint" class="text-[10px] font-normal text-gray-400">{{ hint }}</span>
    </label>
    <slot />
    <p v-if="error" class="text-[11px] text-red-600 mt-1">{{ error }}</p>
  </div>
</template>

<script setup>
defineOptions({ inheritAttrs: false })
defineProps({ id: String, label: String, required: Boolean, hint: String, error: String })
</script>
