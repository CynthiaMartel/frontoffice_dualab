import axios from 'axios'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL ?? '/api',
  headers: { Accept: 'application/json' },
  withCredentials: true,
  withXSRFToken: true,
})

api.interceptors.response.use(
  (r) => r,
  (error) => {
    const isAuthCheck = error.config?.url === '/auth/me'
    if (error.response?.status === 401 && !isAuthCheck) {
      window.location.href = '/login'
    }
    return Promise.reject(error)
  },
)

export default api
