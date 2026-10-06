import axios from 'axios'

// Cliente aparte para el escaparate público de microretos (datos reales de la
// herramienta DuaLab, no del backend propio de este frontoffice). Sin cookies:
// son endpoints públicos de solo lectura, no hay sesión que mandar.
//
// Sin VITE_MICRORETOS_API_URL, en desarrollo se usa el backend local del tool:
// la API de producción solo acepta CORS desde https://dualab.es, así que desde
// localhost el navegador bloquea la petición y el escaparate salía vacío.
const microretosPublicApi = axios.create({
  baseURL: import.meta.env.VITE_MICRORETOS_API_URL
    ?? (import.meta.env.DEV ? 'http://localhost:8000/api' : 'https://api.dualab.es/api'),
  headers: { Accept: 'application/json' },
})

export default microretosPublicApi
