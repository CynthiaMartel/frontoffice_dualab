/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{vue,js,ts}'],
  theme: {
    extend: {
      colors: {
        // Escala general de marca (chrome genérico: navbar, footer, secciones
        // que no pertenecen a un colectivo concreto). Generada a partir del
        // azul del nuevo logo (src/assets/logo_colores.png).
        primary: {
          50:  '#f6fafc',
          100: '#dae8f5',
          200: '#bad5ec',
          300: '#93bde0',
          400: '#6ba4d5',
          500: '#438cca',
          600: '#3072aa',
          700: '#275d8a',
          800: '#1e476a',
          900: '#15324b',
        },
        // Colores por colectivo, extraídos directamente del logo — un único
        // punto de cambio si se pide ajustar el tono de un colectivo.
        centros: '#3072AA',
        empresas: '#509928',
        administraciones: '#19A7A8',
        alumnos: '#FF8920',
        // Azul noche de marca (Manual de marca e imagen DUALAB V2.0, sección
        // 05/Paleta): color global de estructura y navegación — footer,
        // cabeceras y chrome que representa la marca en su conjunto.
        'azul-noche': '#17283E',
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
        // Montserrat para titulares (manual, sección 07/Tipografía).
        heading: ['Montserrat', 'ui-sans-serif', 'system-ui'],
      },
    },
  },
  plugins: [],
}
