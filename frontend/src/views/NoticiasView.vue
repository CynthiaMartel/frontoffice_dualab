<template>
  <!-- Header -->
  <section class="bg-primary-700 py-16 px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10"
         style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200&q=60')" />
    <div class="relative max-w-4xl mx-auto">
      <RouterLink :to="{ name: 'home' }"
                  class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm mb-6 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver al inicio
      </RouterLink>
      <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-wider">
        ACTUALIDAD
      </span>
      <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Noticias</h1>
      <p class="text-white/75 text-base max-w-xl">
        Novedades, casos de éxito y eventos de DuaLab y el ecosistema de la formación profesional dual.
      </p>
    </div>
  </section>

  <!-- TODO: conectar con API de noticias. Reemplaza `noticias` con los datos del backend. -->
  <section class="bg-gray-50 py-14 px-6">
    <div class="max-w-4xl mx-auto">

      <!-- Featured -->
      <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 mb-6 hover:shadow-lg transition-shadow">
        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=900&q=70"
             alt="Noticia destacada"
             class="w-full h-64 object-cover" />
        <div class="p-6">
          <div class="flex items-center gap-3 mb-3">
            <span class="bg-primary-100 text-primary-700 text-[10px] font-bold px-2.5 py-1 rounded-full tracking-wider uppercase">Novedad</span>
            <span class="text-xs text-gray-400">19 jun 2026 · 4 min</span>
          </div>
          <h2 class="text-xl font-bold text-gray-900 mb-2">DuaLab revoluciona la FP Dual con IA: retos académicos generados automáticamente</h2>
          <p class="text-sm text-gray-500 leading-relaxed mb-4">
            Nuestra plataforma transforma necesidades empresariales reales en retos académicos alineados al currículo oficial mediante inteligencia artificial, reduciendo el tiempo de diseño de un reto de días a minutos.
          </p>
          <button class="btn-primary">Leer noticia →</button>
        </div>
      </div>

      <!-- Grid de noticias secundarias -->
      <div class="grid md:grid-cols-2 gap-5">
        <div v-for="n in noticiasSecundarias" :key="n.id"
             class="bg-white rounded-2xl overflow-hidden border border-gray-200 hover:shadow-md transition-shadow flex flex-col">
          <img :src="n.imagen" :alt="n.titulo" class="w-full h-44 object-cover" />
          <div class="p-5 flex flex-col flex-1">
            <div class="flex items-center gap-2 mb-2">
              <span :class="n.badgeClass" class="text-[10px] font-bold px-2 py-0.5 rounded-full tracking-wider uppercase">{{ n.categoria }}</span>
              <span class="text-xs text-gray-400">{{ n.fecha }}</span>
            </div>
            <h3 class="font-bold text-gray-900 text-sm mb-2 leading-snug flex-1">{{ n.titulo }}</h3>
            <p class="text-xs text-gray-500 leading-relaxed mb-4">{{ n.extracto }}</p>
            <button class="btn-outline !text-xs !py-1.5">Leer más →</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ChevronLeftIcon } from '@heroicons/vue/24/outline'

const noticiasSecundarias = [
  {
    id: 1,
    imagen: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=70',
    categoria: 'Caso de éxito',
    badgeClass: 'bg-emerald-100 text-emerald-700',
    fecha: '12 jun 2026 · 3 min',
    titulo: '150 alumnos de FP resuelven retos reales de empresa en una semana',
    extracto: 'Tres centros educativos colaboraron con TechCorp Solutions para que su alumnado de Informática afrontara un reto de automatización real con resultados sorprendentes.',
  },
  {
    id: 2,
    imagen: 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=600&q=70',
    categoria: 'Evento',
    badgeClass: 'bg-amber-100 text-amber-700',
    fecha: '5 jun 2026 · 2 min',
    titulo: 'DuaLab en el Congreso Nacional de FP: ponencia sobre talento emergente',
    extracto: 'Presentamos nuestra metodología de retos B2B ante más de 800 profesionales de la formación profesional en el mayor congreso de FP dual del año.',
  },
  {
    id: 3,
    imagen: 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&q=70',
    categoria: 'Novedad',
    badgeClass: 'bg-primary-100 text-primary-700',
    fecha: '28 may 2026 · 3 min',
    titulo: 'Nueva familia profesional: Administración y Finanzas se une a la plataforma',
    extracto: 'Ampliamos nuestro catálogo de retos con la incorporación de la familia de Administración y Finanzas, con cinco nuevos microretos diseñados junto a empresas del sector.',
  },
  {
    id: 4,
    imagen: 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=70',
    categoria: 'Entrevista',
    badgeClass: 'bg-violet-100 text-violet-700',
    fecha: '20 may 2026 · 5 min',
    titulo: '"DuaLab ha cambiado cómo entendemos la colaboración empresa-centro educativo"',
    extracto: 'Hablamos con la directora de RRHH de InnovaGroup sobre cómo los retos académicos les han ayudado a descubrir perfiles que no habrían encontrado por los canales tradicionales.',
  },
]
</script>
