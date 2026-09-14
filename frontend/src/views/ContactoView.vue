<template>
  <section class="bg-primary-700 py-16 px-6 relative overflow-hidden">
    <div class="relative max-w-2xl mx-auto text-center">
      <RouterLink :to="{ name: 'home' }"
                  class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm mb-6 transition-colors">
        <ChevronLeftIcon class="w-4 h-4" />
        Volver al inicio
      </RouterLink>
      <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-wider">
        CONTACTO
      </span>
      <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">¿Hablamos?</h1>
      <p class="text-white/75 text-base max-w-xl mx-auto">
        Cuéntanos si eres empresa, centro educativo o alumno y nos pondremos en contacto contigo.
      </p>
    </div>
  </section>

  <section class="bg-gray-50 py-14 px-6">
    <ContactForm />
  </section>
</template>

<script setup>
import { ChevronLeftIcon } from '@heroicons/vue/24/outline'
import ContactForm from '@/components/home/ContactForm.vue'
</script>
