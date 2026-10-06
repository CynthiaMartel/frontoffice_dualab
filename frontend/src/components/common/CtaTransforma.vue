<template>
  <!-- Franja final "Transforma la Formación Dual con DuaLab" (home y /contacto).
       "Agenda una reunión" emite `agendar` (cada vista decide adónde lleva);
       "Ver noticias" lleva siempre a /noticias. -->
  <section class="relative bg-azul-noche overflow-hidden">
    <img :src="foto" alt="" class="cta-image hidden lg:block absolute inset-y-0 right-0 w-[34%] h-full object-cover" loading="lazy" />
    <div class="relative max-w-6xl mx-auto px-6 py-16 md:py-20 grid lg:grid-cols-[minmax(0,1fr)_auto] lg:pr-[30%] gap-10 items-center">
      <div class="max-w-xl">
        <h2 class="text-3xl md:text-[44px] font-extrabold tracking-tight text-white leading-[1.1]">
          Transforma la Formación Dual con <span class="text-primary-400">DuaLab</span>
        </h2>
        <p class="text-white/85 font-semibold mt-5">
          Conecta talento, impulsa la colaboración y genera un impacto real en la educación y en la sociedad
        </p>
        <div class="flex flex-wrap gap-3 mt-8">
          <button type="button" class="btn-pill bg-alumnos hover:bg-alumnos/90 px-8" @click="$emit('agendar')">
            Agenda una reunión con nuestro equipo
          </button>
          <RouterLink :to="{ name: 'noticias' }" class="btn-pill bg-transparent border-2 border-white/60 shadow-none hover:bg-white hover:!text-azul-noche px-8">
            Ver noticias
          </RouterLink>
        </div>
      </div>
      <!-- Rotulación manuscrita: columna propia sobre el fondo oscuro (nunca encima de la foto) -->
      <div class="hidden md:flex flex-col items-center text-center" aria-hidden="true">
        <svg class="w-8 h-12" viewBox="0 0 40 56" fill="none"><path d="M20 2 C 10 14, 30 22, 18 34 C 10 42, 26 46, 22 54" stroke="#FF8920" stroke-width="2.5" stroke-linecap="round"/></svg>
        <p class="font-hand font-semibold text-white text-4xl leading-9 -rotate-3 mt-2">Un ecosistema<br>que genera<br><span class="text-alumnos">oportunidades</span></p>
        <svg class="w-28 h-6 mt-3" viewBox="0 0 96 24" fill="none"><path d="M4 14 C 30 2, 60 4, 92 12" stroke="#FF8920" stroke-width="2.5" stroke-linecap="round"/></svg>
      </div>
    </div>
  </section>
</template>

<script setup>
import foto from '@/assets/dua_22.jpg'

defineEmits(['agendar'])
</script>

<style scoped>
/* El fondo azul noche "muerde" la foto con una curva */
.cta-image {
  clip-path: ellipse(100% 115% at 100% 40%);
}
</style>
