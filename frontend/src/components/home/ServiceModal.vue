<template>
  <Teleport to="body">
    <Transition name="modal-fade">
      <div
        v-if="service"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        :aria-labelledby="titleId"
      >
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="$emit('close')" />

        <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[88vh] overflow-y-auto">
          <button
            type="button"
            class="absolute top-4 right-4 z-10 w-9 h-9 flex items-center justify-center rounded-full bg-white/90 text-gray-500 hover:text-gray-700 hover:bg-white shadow transition-colors"
            aria-label="Cerrar"
            @click="$emit('close')"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <div class="grid md:grid-cols-2 gap-8 items-center p-8">
            <div>
              <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-widest text-[#00A859] bg-[#99CC33]/15 border border-[#99CC33]/30 px-4 py-1.5 rounded-full mb-4">
                <component :is="service.icon" class="w-3.5 h-3.5" />
                Servicio
              </span>

              <h3 :id="titleId" class="text-xl font-bold text-gray-900 mb-2">{{ service.title }}</h3>

              <p class="text-gray-500 text-sm leading-relaxed mb-4">
                <template v-for="(part, i) in descriptionParts" :key="i">
                  <strong v-if="part.bold" class="font-bold text-gray-900">{{ part.text }}</strong>
                  <template v-else>{{ part.text }}</template>
                </template>
              </p>

              <ul class="mb-5 space-y-2">
                <li v-for="h in service.highlights" :key="h.title" class="flex items-start gap-2.5">
                  <div class="w-4.5 h-4.5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                      <path d="M1.5 5l2.5 2.5L8.5 2" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  <div>
                    <div class="font-semibold text-sm text-gray-900">{{ h.title }}</div>
                    <div class="text-xs text-gray-500 leading-relaxed">{{ h.desc }}</div>
                  </div>
                </li>
              </ul>

              <RouterLink
                v-if="service.link"
                :to="service.link.to"
                class="group inline-flex items-center gap-2.5 px-6 py-3 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-xs uppercase tracking-widest shadow-[0_8px_25px_rgba(0,168,89,0.3)] hover:shadow-[0_14px_35px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
                @click="$emit('close')"
              >
                {{ service.link.label }}
                <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
              </RouterLink>
            </div>

            <div>
              <img :src="service.image" :alt="service.title"
                   class="w-full h-56 md:h-64 object-cover rounded-xl" loading="lazy" />
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { computed, watch, onUnmounted } from 'vue'

const props = defineProps({ service: Object })
const emit = defineEmits(['close'])

const titleId = computed(() => `service-modal-title-${props.service?.title ?? ''}`)

function parseBold(text) {
  const parts = []
  const regex = /\*\*(.+?)\*\*/g
  let lastIndex = 0
  let match
  while ((match = regex.exec(text))) {
    if (match.index > lastIndex) parts.push({ text: text.slice(lastIndex, match.index), bold: false })
    parts.push({ text: match[1], bold: true })
    lastIndex = regex.lastIndex
  }
  if (lastIndex < text.length) parts.push({ text: text.slice(lastIndex), bold: false })
  return parts
}

const descriptionParts = computed(() => props.service ? parseBold(props.service.description) : [])

function handleKeydown(e) {
  if (e.key === 'Escape') emit('close')
}

watch(() => props.service, (service) => {
  document.body.style.overflow = service ? 'hidden' : ''
  if (service) {
    window.addEventListener('keydown', handleKeydown)
  } else {
    window.removeEventListener('keydown', handleKeydown)
  }
})

onUnmounted(() => {
  document.body.style.overflow = ''
  window.removeEventListener('keydown', handleKeydown)
})
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.25s ease;
}
.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}
</style>
