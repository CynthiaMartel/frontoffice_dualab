<template>
  <section :id="sectionId" :class="['py-12 px-6', bgGray ? 'bg-gray-50' : 'bg-white']">
    <div
      :class="['max-w-5xl mx-auto grid md:grid-cols-2 gap-10 items-center', reverse ? 'md:[&>*:first-child]:order-2' : '']"
    >
      <!-- Text: entra desde la izquierda (o derecha si reverse) -->
      <div v-reveal class="reveal-init">
        <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-widest text-[#00A859] bg-[#99CC33]/15 border border-[#99CC33]/30 px-4 py-1.5 rounded-full mb-4">
          {{ tag }}
        </span>
        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ title }}</h2>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ description }}</p>
        <ul class="mb-5 space-y-2">
          <li v-for="f in features" :key="f.title" class="flex items-start gap-2.5">
            <div class="w-4.5 h-4.5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
              <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                <path d="M1.5 5l2.5 2.5L8.5 2" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div>
              <div class="font-semibold text-sm text-gray-900">{{ f.title }}</div>
              <div class="text-xs text-gray-500 leading-relaxed">{{ f.desc }}</div>
            </div>
          </li>
        </ul>
        <slot name="actions">
          <button
            class="group inline-flex items-center gap-2.5 px-7 py-3.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_8px_25px_rgba(0,168,89,0.3)] hover:shadow-[0_14px_35px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
            @click="$emit('cta')"
          >
            {{ ctaLabel }}
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
          </button>
        </slot>
      </div>

      <!-- Image: entra con ligero delay -->
      <div v-reveal="180">
        <img :src="image" :alt="title"
             class="w-full h-52 object-cover rounded-xl" loading="lazy" />
      </div>
    </div>
  </section>
</template>

<script setup>
// Directiva local reutilizada en este componente
const vReveal = {
  mounted(el, binding) {
    const delay = typeof binding.value === 'number' ? binding.value : 0
    el.classList.add('reveal-init')
    const io = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setTimeout(() => el.classList.add('reveal-in'), delay)
          io.disconnect()
        }
      },
      { threshold: 0.1 }
    )
    io.observe(el)
  },
}

defineProps({
  sectionId: String,
  tag: String, title: String, description: String,
  features: Array, ctaLabel: String, image: String,
  reverse: Boolean, bgGray: Boolean,
})
defineEmits(['cta'])
</script>
