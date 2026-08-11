import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from 'axios'
import api from '@/services/api'

export const useAuthStore = defineStore('auth', () => {
  const user          = ref(null)
  const isInitialized = ref(false)
  const isLoggedIn    = computed(() => !!user.value)

  async function init() {
    if (isInitialized.value) return
    try {
      const { data } = await api.get('/auth/me')
      user.value = data
    } catch {
      user.value = null
    } finally {
      isInitialized.value = true
    }
  }

  async function login(credentials) {
    await axios.get('/sanctum/csrf-cookie', { withCredentials: true })
    const { data } = await api.post('/auth/login', credentials)
    user.value = data.user
  }

  async function register(payload) {
    await axios.get('/sanctum/csrf-cookie', { withCredentials: true })
    const { data } = await api.post('/auth/register', payload)
    user.value = data.user
  }

  async function logout() {
    try { await api.post('/auth/logout') } catch {}
    user.value = null
  }

  return { user, isLoggedIn, isInitialized, init, login, register, logout }
})
