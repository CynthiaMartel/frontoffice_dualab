<template>
  <div class="bg-white/10 border border-white/20 rounded-xl p-5">
    <div class="flex gap-0.5 mb-3 text-yellow-300 text-sm">★★★★★</div>
    <p class="text-white/90 text-sm leading-relaxed mb-4">"{{ quote }}"</p>
    <div class="font-semibold text-white text-sm">{{ name }}</div>
    <div class="text-white/60 text-xs">{{ role }}</div>
  </div>
</template>
<script setup>
defineProps({ quote: String, name: String, role: String })
</script>
