<template>
  <div class="flex gap-4 items-start p-5 rounded-2xl transition-colors" :class="cardClass">
    <div
      class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-black text-lg shadow-md"
      :class="badgeClass"
    >
      {{ number }}
    </div>
    <div>
      <h4 class="font-bold text-lg" :class="titleClass">{{ title }}</h4>
      <p class="text-sm leading-relaxed mt-1" :class="descClass">{{ desc }}</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({ number: String, icon: Object, title: String, desc: String })

const n = computed(() => Number(props.number))

const cardClass = computed(() =>
  n.value === 2 ? 'bg-[#99CC33]/10 border border-[#99CC33]/20' : 'hover:bg-white'
)
const badgeClass = computed(() => {
  if (n.value === 1) return 'bg-[#1F2937] text-white'
  if (n.value === 2) return 'bg-[#99CC33] text-[#121212]'
  return 'bg-[#00A859] text-white shadow-[#00A859]/30'
})
const titleClass = computed(() => n.value === 2 ? 'text-[#00A859]' : 'text-[#1F2937]')
const descClass  = computed(() => n.value === 2 ? 'text-gray-600' : 'text-gray-500')
</script>
