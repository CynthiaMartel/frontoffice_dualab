<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl border border-gray-200 p-8 w-full max-w-sm">
      <div class="text-center mb-7">
        <div class="w-10 h-10 bg-primary-600 rounded-xl mx-auto mb-3"></div>
        <h1 class="text-xl font-bold text-gray-900">Crear cuenta</h1>
        <p class="text-sm text-gray-500 mt-1">Únete a Microretos Académicos</p>
      </div>

      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Nombre completo</label>
          <input v-model="form.name" type="text" class="form-input" placeholder="Juan Pérez" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
          <input v-model="form.email" type="email" class="form-input" placeholder="tu@email.com" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Contraseña</label>
          <input v-model="form.password" type="password" class="form-input" placeholder="Mínimo 8 caracteres" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirmar contraseña</label>
          <input v-model="form.password_confirmation" type="password" class="form-input" placeholder="••••••••" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Soy…</label>
          <select v-model="form.role" class="form-input bg-white">
            <option value="alumno">Alumno / Estudiante</option>
            <option value="empresa">Empresa</option>
            <option value="centro">Centro Educativo</option>
          </select>
        </div>
        <p v-if="error" class="text-red-500 text-xs">{{ error }}</p>
        <button type="submit" class="btn-primary w-full justify-center py-2.5" :disabled="loading">
          {{ loading ? 'Creando cuenta…' : 'Crear cuenta' }}
        </button>
      </form>

      <p class="text-center text-sm text-gray-500 mt-5">
        ¿Ya tienes cuenta?
        <RouterLink :to="{ name: 'login' }" class="text-primary-600 font-medium">Inicia sesión</RouterLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const auth    = useAuthStore()
const router  = useRouter()
const form    = reactive({ name: '', email: '', password: '', password_confirmation: '', role: 'alumno' })
const loading = ref(false)
const error   = ref('')

async function submit() {
  loading.value = true
  error.value   = ''
  try {
    await auth.register(form)
    router.push({ name: 'dashboard' })
  } catch (e) {
    const errs = e.response?.data?.errors
    error.value = errs ? Object.values(errs).flat()[0] : 'Error al registrarse.'
  } finally {
    loading.value = false
  }
}
</script>
