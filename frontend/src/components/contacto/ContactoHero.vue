<template>
  <!-- Columna izquierda de /contacto: mensaje, ventajas e imagen del agente -->
  <div class="flex flex-col h-full">
    <p class="flex items-center gap-3 text-xs font-bold uppercase tracking-[0.25em] text-primary-600 mb-4">
      Contacto <span class="w-10 h-px bg-primary-300" aria-hidden="true" />
    </p>
    <h1 class="text-[28px] sm:text-[32px] md:text-[40px] lg:text-[34px] xl:text-[36px] font-extrabold tracking-tight leading-[1.1]">
      <template v-for="(parte, i) in agente.titulo" :key="i">
        <span class="block" :class="parte.color ? agente.text : 'text-azul-noche'">{{ parte.t }}</span>
      </template>
    </h1>
    <p class="text-sm sm:text-base lg:text-sm text-gray-600 leading-relaxed mt-4 max-w-md lg:max-w-none">{{ agente.intro }}</p>

    <!-- Móvil: se omiten (el formulario queda más cerca). Tablet: en fila. Escritorio: en columna. -->
    <ul class="hidden sm:grid sm:grid-cols-3 gap-4 mt-6 lg:grid-cols-1 lg:gap-3 lg:mt-5">
      <li v-for="b in agente.beneficios" :key="b.titulo" class="flex items-start gap-3">
        <span class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" :class="[agente.soft, agente.text]">
          <component :is="b.icon" class="w-5 h-5" />
        </span>
        <div>
          <p class="font-heading font-bold text-sm text-azul-noche">{{ b.titulo }}</p>
          <p class="text-xs text-gray-500 leading-snug">{{ b.desc }}</p>
        </div>
      </li>
    </ul>

    <!-- Escritorio: foto apaisada que ocupa el alto libre hasta el pie de la sección y
         sangra hasta el borde izquierdo de la pantalla, como en los diseños FORMULARIO. -->
    <div class="relative hidden lg:block grow min-h-56 mt-8 -mb-12 -ml-[max(1.5rem,calc((100vw-72rem)/2))]">
      <p class="absolute -top-4 left-[max(1.5rem,calc((100vw-72rem)/2))] z-10 font-hand font-semibold text-2xl leading-6 -rotate-12 px-4 py-2 rounded-2xl text-white shadow-lg"
         :class="agente.bg" aria-hidden="true">
        <template v-for="(l, i) in agente.rotulo" :key="i">{{ l }}<br v-if="i < agente.rotulo.length - 1"></template>
      </p>
      <img :src="agente.imagen" alt="" class="contacto-blob absolute inset-0 w-full h-full object-cover" />
    </div>
  </div>
</template>

<script setup>
defineProps({ agente: { type: Object, required: true } })
</script>

<style scoped>
.contacto-blob {
  border-radius: 0 60% 0 0 / 0 45% 0 0;
}
</style>
