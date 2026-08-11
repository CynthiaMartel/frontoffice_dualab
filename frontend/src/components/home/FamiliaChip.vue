<template>
  <div @click="$emit('click')"
       class="bg-white border border-gray-200 rounded-xl p-4 text-center cursor-pointer transition hover:shadow-md hover:-translate-y-0.5">
    <div class="flex justify-center mb-2 text-primary-600">
      <component :is="icon" class="w-7 h-7" />
    </div>
    <div class="font-semibold text-xs text-gray-800">{{ label }}</div>
  </div>
</template>

<script setup>
defineProps({ icon: Object, label: String })
defineEmits(['click'])
</script>
