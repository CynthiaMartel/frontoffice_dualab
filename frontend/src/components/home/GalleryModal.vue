<template>
  <Teleport to="body">
    <Transition name="modal-fade">
      <div
        v-if="open"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        aria-label="Galería de fotos DuaLab"
      >
        <div class="absolute inset-0 bg-gray-900/80 backdrop-blur-sm" @click="$emit('close')" />

        <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full">
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

          <div class="relative bg-gray-900 rounded-t-2xl overflow-hidden aspect-[4/3] md:aspect-[16/9]">
            <img :src="images[index]" alt="Foto de DuaLab" class="w-full h-full object-contain" />

            <button
              type="button"
              class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center rounded-full bg-white/80 hover:bg-white text-gray-700 shadow transition-colors"
              aria-label="Foto anterior"
              @click="prev"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button
              type="button"
              class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center rounded-full bg-white/80 hover:bg-white text-gray-700 shadow transition-colors"
              aria-label="Foto siguiente"
              @click="next"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
          </div>

          <div class="flex items-center justify-between px-6 py-4">
            <span class="text-sm font-semibold text-gray-500">{{ index + 1 }} / {{ images.length }}</span>
            <div class="flex gap-1.5 overflow-x-auto max-w-[70%]">
              <button
                v-for="(_, i) in images"
                :key="i"
                class="shrink-0 rounded-full transition-all duration-300"
                :class="index === i ? 'w-6 h-2 bg-[#00A859]' : 'w-2 h-2 bg-gray-300 hover:bg-gray-400'"
                :aria-label="`Ir a la foto ${i + 1}`"
                @click="index = i"
              />
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, watch, onUnmounted } from 'vue'

const props = defineProps({
  open: Boolean,
  images: { type: Array, default: () => [] },
})
const emit = defineEmits(['close'])

const index = ref(0)

function next() {
  index.value = (index.value + 1) % props.images.length
}
function prev() {
  index.value = (index.value - 1 + props.images.length) % props.images.length
}

function handleKeydown(e) {
  if (e.key === 'Escape') emit('close')
  if (e.key === 'ArrowRight') next()
  if (e.key === 'ArrowLeft') prev()
}

watch(() => props.open, (isOpen) => {
  document.body.style.overflow = isOpen ? 'hidden' : ''
  if (isOpen) {
    index.value = 0
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
