<template>
  <!-- Header -->
  <section class="bg-emerald-700 py-16 px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10"
         style="background-image: url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1200&q=60')" />
    <div class="relative max-w-4xl mx-auto">
      <RouterLink :to="{ name: 'home' }"
                  class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm mb-6 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver al inicio
      </RouterLink>
      <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-wider">
        PARA CENTROS EDUCATIVOS
      </span>
      <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Centros educativos asociados</h1>
      <p class="text-white/75 text-base max-w-xl">
        Centros de formación profesional que participan activamente en la red de microretos para mejorar la empleabilidad de sus alumnos.
      </p>
    </div>
  </section>

  <!-- Grid de centros -->
  <section class="bg-gray-50 py-14 px-6">
    <div class="max-w-4xl mx-auto">
      <div class="grid md:grid-cols-2 gap-5">
        <div v-for="c in centrosAsociados" :key="c.id"
             class="bg-white rounded-2xl border border-gray-200 p-6 flex flex-col gap-4 hover:shadow-lg transition-shadow">
          <!-- Logo + nombre -->
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-700 font-extrabold text-lg flex items-center justify-center flex-shrink-0">
              {{ initials(c.nombre) }}
            </div>
            <div>
              <h3 class="font-bold text-gray-900">{{ c.nombre }}</h3>
              <span class="text-xs font-medium text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-full">
                {{ c.tipo }}
              </span>
            </div>
          </div>

          <!-- Descripción -->
          <p class="text-sm text-gray-500 leading-relaxed flex-1">{{ c.descripcion }}</p>

          <!-- Contacto -->
          <div class="space-y-1.5 text-sm text-gray-400 border-t border-gray-100 pt-4">
            <div class="flex items-center gap-2">
              <EnvelopeIcon class="w-4 h-4 flex-shrink-0" />
              <span>{{ c.email }}</span>
            </div>
            <div class="flex items-center gap-2">
              <PhoneIcon class="w-4 h-4 flex-shrink-0" />
              <span>{{ c.telefono }}</span>
            </div>
          </div>

          <!-- CTA -->
          <a :href="c.web"
             class="inline-flex items-center justify-center gap-2 bg-emerald-600 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition-all hover:bg-emerald-700 hover:-translate-y-px active:scale-95">
            Visitar web
            <ArrowTopRightOnSquareIcon class="w-4 h-4" />
          </a>
        </div>
      </div>

      <!-- CTA secundario -->
      <div class="mt-12 bg-emerald-50 border border-emerald-100 rounded-2xl p-8 text-center">
        <h3 class="text-lg font-bold text-gray-900 mb-2">¿Tu centro quiere unirse?</h3>
        <p class="text-sm text-gray-500 mb-5">Ofrece a tus alumnos retos reales de empresa y mejora su inserción laboral.</p>
        <RouterLink :to="{ name: 'home', hash: '#contact' }"
                    class="inline-flex items-center gap-2 bg-emerald-600 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition-all hover:bg-emerald-700">
          Solicitar demo
          <ArrowRightIcon class="w-4 h-4" />
        </RouterLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ChevronLeftIcon, EnvelopeIcon, PhoneIcon, ArrowTopRightOnSquareIcon, ArrowRightIcon } from '@heroicons/vue/24/outline'
import { centrosAsociados } from '@/data/asociados.js'

function initials(name) {
  return name.split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase()
}
</script>
