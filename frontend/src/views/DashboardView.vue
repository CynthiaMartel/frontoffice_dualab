<template>
  <div class="max-w-5xl mx-auto px-6 py-12">
    <div class="mb-8">
      <h1 class="text-2xl font-extrabold text-gray-900">Hola, {{ auth.user?.name }} 👋</h1>
      <p class="text-gray-500 text-sm mt-1">Aquí tienes un resumen de tu actividad</p>
    </div>

    <!-- Stats rápidas -->
    <div class="grid grid-cols-3 gap-4 mb-10">
      <div class="bg-white border border-gray-200 rounded-xl p-5">
        <div class="text-2xl font-bold text-primary-600">{{ inscripciones.length }}</div>
        <div class="text-xs text-gray-500 mt-1">Retos activos</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl p-5">
        <div class="text-2xl font-bold text-primary-600">
          {{ inscripciones.filter(i => i.estado === 'completado').length }}
        </div>
        <div class="text-xs text-gray-500 mt-1">Completados</div>
      </div>
      <div class="bg-white border border-gray-200 rounded-xl p-5">
        <div class="text-2xl font-bold text-primary-600">
          {{ auth.user?.role === 'alumno' ? 'Alumno' : auth.user?.role === 'empresa' ? 'Empresa' : 'Centro' }}
        </div>
        <div class="text-xs text-gray-500 mt-1">Tipo de cuenta</div>
      </div>
    </div>

    <!-- Mis inscripciones -->
    <h2 class="font-bold text-gray-900 mb-4">Mis retos</h2>
    <div v-if="loading" class="text-gray-400 text-sm py-6">Cargando…</div>
    <div v-else-if="!inscripciones.length" class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-10 text-center">
      <p class="text-gray-500 text-sm mb-4">Todavía no te has inscrito en ningún reto.</p>
      <RouterLink :to="{ name: 'familias' }" class="btn-primary">Explorar retos →</RouterLink>
    </div>
    <div v-else class="grid md:grid-cols-2 gap-4">
      <div v-for="i in inscripciones" :key="i.id" class="card flex items-start justify-between gap-4">
        <div>
          <div class="font-semibold text-sm text-gray-900">{{ i.reto.titulo }}</div>
          <div class="text-xs text-gray-400 mt-1">{{ i.reto.familia?.nombre }}</div>
        </div>
        <span :class="estadoBadge(i.estado)" class="flex-shrink-0">{{ estadoLabel(i.estado) }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import api from '@/services/api'

const auth          = useAuthStore()
const inscripciones = ref([])
const loading       = ref(true)

onMounted(async () => {
  try {
    const { data } = await api.get('/mis-inscripciones')
    inscripciones.value = data
  } finally {
    loading.value = false
  }
})

function estadoBadge(e) {
  return {
    en_progreso: 'text-xs font-semibold bg-yellow-100 text-yellow-700 px-2.5 py-0.5 rounded-full',
    completado:  'text-xs font-semibold bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full',
    abandonado:  'text-xs font-semibold bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full',
  }[e] ?? ''
}
function estadoLabel(e) {
  return { en_progreso: 'En progreso', completado: 'Completado', abandonado: 'Abandonado' }[e] ?? e
}
</script>
