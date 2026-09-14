<template>
  <div class="max-w-2xl mx-auto px-6 py-12">
    <div v-if="loading" class="text-center py-16 text-gray-400">Cargando reto…</div>
    <template v-else-if="reto">

      <!-- Breadcrumb -->
      <RouterLink :to="{ name: 'familias' }"
                  class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium mb-5 hover:text-primary-700 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver a Familias
      </RouterLink>

      <div class="flex items-center gap-2 mb-3">
        <span v-if="reto.familia" class="text-xs font-semibold bg-primary-50 text-primary-700 px-2.5 py-0.5 rounded-full border border-primary-200">
          {{ reto.familia }}
        </span>
        <span v-if="reto.empresa_nombre" class="text-xs text-gray-400">{{ reto.empresa_nombre }}</span>
      </div>

      <h1 class="text-2xl font-extrabold text-gray-900 mb-2">{{ reto.titulo }}</h1>
      <p v-if="reto.subtitulo" class="text-sm text-gray-500 mb-6">{{ reto.subtitulo }}</p>
      <p v-if="reto.duracion" class="flex items-center gap-1.5 text-sm text-gray-400 mb-10">
        <ClockIcon class="w-4 h-4" /> {{ reto.duracion }}
      </p>

      <!-- El reto -->
      <div v-if="reto.pregunta_reto" class="card mb-5">
        <div class="flex items-center gap-2 font-semibold text-gray-900 mb-3">
          <DocumentTextIcon class="w-5 h-5 text-primary-600" />
          El reto
        </div>
        <p class="text-sm text-gray-600 leading-relaxed">{{ reto.pregunta_reto }}</p>
      </div>

      <!-- Qué se necesita -->
      <div v-if="reto.que_necesitan?.length" class="card mb-5">
        <div class="flex items-center gap-2 font-semibold text-gray-900 mb-4">
          <CheckCircleIcon class="w-5 h-5 text-primary-600" />
          Qué necesita la empresa
        </div>
        <ol class="space-y-3">
          <li v-for="(item, i) in reto.que_necesitan" :key="i" class="flex items-center gap-3">
            <div class="w-5 h-5 bg-primary-600 rounded-full text-white text-xs font-bold flex items-center justify-center flex-shrink-0">
              {{ i + 1 }}
            </div>
            <span class="text-sm text-gray-700">{{ item }}</span>
          </li>
        </ol>
      </div>

      <!-- Habilidades -->
      <div v-if="reto.soft_skills?.length" class="card mb-8">
        <div class="flex items-center gap-2 font-semibold text-gray-900 mb-4">
          <WrenchScrewdriverIcon class="w-5 h-5 text-primary-600" />
          Habilidades a desarrollar
        </div>
        <div class="flex flex-wrap gap-2">
          <span v-for="(skill, i) in reto.soft_skills" :key="i"
                class="bg-gray-100 text-gray-700 text-xs px-3 py-1.5 rounded-full">{{ skill }}</span>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-primary-50 border border-primary-200 rounded-xl p-6">
        <h3 class="font-bold text-primary-800 text-base mb-2">¿Tu empresa o centro quiere participar?</h3>
        <p class="text-sm text-primary-700 mb-4">Cuéntanos tu caso y te contactamos para sumarte a un reto como este.</p>
        <RouterLink :to="{ name: 'contacto' }" class="btn-primary">
          Contactar
          <ArrowRightIcon class="w-4 h-4" />
        </RouterLink>
      </div>
    </template>
    <p v-else class="text-center py-16 text-gray-400">No hemos encontrado este reto.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import microretosPublicApi from '@/services/microretosPublicApi'
import {
  ChevronLeftIcon,
  ClockIcon,
  DocumentTextIcon,
  CheckCircleIcon,
  WrenchScrewdriverIcon,
  ArrowRightIcon,
} from '@heroicons/vue/24/outline'

const route   = useRoute()
const reto    = ref(null)
const loading = ref(true)

onMounted(async () => {
  try {
    const { data } = await microretosPublicApi.get(`/public/microretos/${route.params.id}`)
    reto.value = data.data ?? data
  } catch {
    reto.value = null
  } finally {
    loading.value = false
  }
})
</script>
