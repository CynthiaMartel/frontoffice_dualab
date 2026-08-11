<template>
  <form class="max-w-xl mx-auto" @submit.prevent="submit">
    <div class="grid grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nombre completo *</label>
        <input v-model="form.nombre" type="text" placeholder="Juan Pérez" class="form-input" required />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email *</label>
        <input v-model="form.email" type="email" placeholder="juan@ejemplo.com" class="form-input" required />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipo de organización *</label>
        <select v-model="form.tipo" class="form-input bg-white" required>
          <option value="">Selecciona una opción</option>
          <option value="empresa">Empresa</option>
          <option value="centro">Centro Educativo</option>
          <option value="alumno">Alumno / Particular</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Teléfono</label>
        <input v-model="form.telefono" type="tel" placeholder="+34 600 000 000" class="form-input" />
      </div>
    </div>
    <button
      type="submit"
      class="w-full inline-flex items-center justify-center gap-2.5 py-4 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_8px_25px_rgba(0,168,89,0.3)] hover:shadow-[0_14px_35px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:translate-y-0"
      :disabled="loading"
    >
      {{ loading ? 'Enviando…' : 'Enviar solicitud' }}
    </button>
    <p v-if="success" class="text-primary-600 text-sm text-center mt-3 font-medium">
      ✓ Solicitud recibida. Nos pondremos en contacto pronto.
    </p>
  </form>
</template>

<script setup>
import { reactive, ref } from 'vue'
import api from '@/services/api'

const form    = reactive({ nombre: '', email: '', tipo: '', telefono: '' })
const loading = ref(false)
const success = ref(false)

async function submit() {
  loading.value = true
  try {
    await api.post('/contacto', form)
    success.value = true
    Object.assign(form, { nombre: '', email: '', tipo: '', telefono: '' })
  } catch (e) {
    alert('Error al enviar. Inténtalo de nuevo.')
  } finally {
    loading.value = false
  }
}
</script>
