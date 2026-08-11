<template>
  <!-- Header -->
  <section class="bg-primary-700 py-16 px-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10"
         style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=60')" />
    <div class="relative max-w-4xl mx-auto">
      <RouterLink :to="{ name: 'home' }"
                  class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm mb-6 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver al inicio
      </RouterLink>
      <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-wider">
        PARA EMPRESAS
      </span>
      <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Empresas asociadas</h1>
      <p class="text-white/75 text-base max-w-xl">
        Compañías que confían en Microretos Académicos para identificar y atraer talento formado en retos reales.
      </p>
    </div>
  </section>

  <!-- Grid de empresas -->
  <section class="bg-gray-50 py-14 px-6">
    <div class="max-w-4xl mx-auto">
      <div class="grid md:grid-cols-2 gap-5">
        <div v-for="e in empresasAsociadas" :key="e.id"
             class="bg-white rounded-2xl border border-gray-200 p-6 flex flex-col gap-4 hover:shadow-lg transition-shadow">
          <!-- Logo + nombre -->
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-primary-100 text-primary-700 font-extrabold text-lg flex items-center justify-center flex-shrink-0">
              {{ initials(e.nombre) }}
            </div>
            <div>
              <h3 class="font-bold text-gray-900">{{ e.nombre }}</h3>
              <span class="text-xs font-medium text-primary-600 bg-primary-50 border border-primary-100 px-2 py-0.5 rounded-full">
                {{ e.sector }}
              </span>
            </div>
          </div>

          <!-- Descripción -->
          <p class="text-sm text-gray-500 leading-relaxed flex-1">{{ e.descripcion }}</p>

          <!-- Contacto -->
          <div class="space-y-1.5 text-sm text-gray-400 border-t border-gray-100 pt-4">
            <div class="flex items-center gap-2">
              <EnvelopeIcon class="w-4 h-4 flex-shrink-0" />
              <span>{{ e.email }}</span>
            </div>
            <div class="flex items-center gap-2">
              <PhoneIcon class="w-4 h-4 flex-shrink-0" />
              <span>{{ e.telefono }}</span>
            </div>
          </div>

          <!-- CTA -->
          <a :href="e.web" class="btn-primary justify-center">
            Visitar web
            <ArrowTopRightOnSquareIcon class="w-4 h-4" />
          </a>
        </div>
      </div>

      <!-- CTA secundario -->
      <div class="mt-12 bg-primary-50 border border-primary-100 rounded-2xl p-8 text-center">
        <h3 class="text-lg font-bold text-gray-900 mb-2">¿Tu empresa quiere unirse?</h3>
        <p class="text-sm text-gray-500 mb-5">Publica retos reales y accede al talento de los mejores estudiantes de FP.</p>
        <RouterLink :to="{ name: 'home', hash: '#contact' }" class="btn-primary">
          Contactar ahora
          <ArrowRightIcon class="w-4 h-4" />
        </RouterLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ChevronLeftIcon, EnvelopeIcon, PhoneIcon, ArrowTopRightOnSquareIcon, ArrowRightIcon } from '@heroicons/vue/24/outline'
import { empresasAsociadas } from '@/data/asociados.js'

function initials(name) {
  return name.split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase()
}
</script>
