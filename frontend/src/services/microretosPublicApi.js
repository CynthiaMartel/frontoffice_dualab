import axios from 'axios'

// Cliente aparte para el escaparate público de microretos (datos reales de la
// herramienta DuaLab, no del backend propio de este frontoffice). Sin cookies:
// son endpoints públicos de solo lectura, no hay sesión que mandar.
const microretosPublicApi = axios.create({
  baseURL: import.meta.env.VITE_MICRORETOS_API_URL ?? 'https://api.dualab.es/api',
  headers: { Accept: 'application/json' },
})

export default microretosPublicApi
