<template>
  <button
    type="button"
    class="w-full text-center md:text-left group focus:outline-none"
    @click="$emit('click')"
  >
    <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-[#99CC33]/15 text-[#00A859] border border-[#99CC33]/30 mb-3 transition-all duration-300 group-hover:bg-[#00A859] group-hover:text-white group-hover:-translate-y-0.5 group-focus-visible:ring-2 group-focus-visible:ring-[#00A859] group-focus-visible:ring-offset-2">
      <component :is="icon" class="w-5.5 h-5.5" />
    </div>
    <h4 class="font-bold text-sm text-gray-900 leading-snug group-hover:text-[#00A859] transition-colors">{{ title }}</h4>
    <p class="text-xs text-gray-500 leading-relaxed mt-1">{{ desc }}</p>
  </button>
</template>

<script setup>
defineProps({ icon: Object, title: String, desc: String })
defineEmits(['click'])
</script>
