import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '@/services/api'

export const useFamiliasStore = defineStore('familias', () => {
  const familias = ref([])
  const loading  = ref(false)

  async function fetchAll() {
    loading.value = true
    try {
      const { data } = await api.get('/familias')
      familias.value = data
    } finally {
      loading.value = false
    }
  }

  async function fetchOne(slug) {
    const { data } = await api.get(`/familias/${slug}`)
    return data
  }

  return { familias, loading, fetchAll, fetchOne }
})
