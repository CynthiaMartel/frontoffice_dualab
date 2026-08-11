<!-- ─── StatItem.vue ───────────────────────────────────────────────────────── -->
<template>
  <div ref="root">
    <div class="text-3xl font-bold text-primary-600 leading-none">{{ displayed }}</div>
    <div class="text-xs text-gray-500 mt-1">{{ label }}</div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({ number: String, label: String })

// "15+" → { value: 15, suffix: '+' }, "100%" → { value: 100, suffix: '%' }
const parsed = computed(() => {
  const m = props.number.match(/^(\d+(?:\.\d+)?)(.*)$/)
  return m ? { value: parseFloat(m[1]), suffix: m[2] } : { value: 0, suffix: props.number }
})

const current = ref(0)
const displayed = computed(() => Math.round(current.value) + parsed.value.suffix)

const root = ref(null)
let observer = null
let raf = null

function animateTo(target) {
  const duration = 1600
  const start = performance.now()

  function step(now) {
    const t = Math.min((now - start) / duration, 1)
    const eased = 1 - (1 - t) ** 3  // ease-out cubic
    current.value = eased * target
    if (t < 1) {
      raf = requestAnimationFrame(step)
    } else {
      current.value = target
    }
  }

  raf = requestAnimationFrame(step)
}

onMounted(() => {
  observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        animateTo(parsed.value.value)
        observer.disconnect()
      }
    },
    { threshold: 0.3 }
  )
  if (root.value) observer.observe(root.value)
})

onUnmounted(() => {
  observer?.disconnect()
  if (raf) cancelAnimationFrame(raf)
})
</script>
