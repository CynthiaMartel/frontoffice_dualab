<template>
  <!-- Columna izquierda de /contacto: mensaje, ventajas e imagen del agente -->
  <div class="flex flex-col h-full">
    <p class="flex items-center gap-3 text-xs font-bold uppercase tracking-[0.25em] text-primary-600 mb-4">
      Contacto <span class="w-10 h-px bg-primary-300" aria-hidden="true" />
    </p>
    <h1 class="text-3xl md:text-[40px] font-extrabold tracking-tight leading-[1.1]">
      <template v-for="(parte, i) in agente.titulo" :key="i">
        <span class="block" :class="parte.color ? agente.text : 'text-azul-noche'">{{ parte.t }}</span>
      </template>
    </h1>
    <p class="text-gray-600 leading-relaxed mt-5 max-w-md">{{ agente.intro }}</p>

    <ul class="space-y-4 mt-7">
      <li v-for="b in agente.beneficios" :key="b.titulo" class="flex items-start gap-3">
        <span class="w-11 h-11 rounded-full flex items-center justify-center shrink-0" :class="[agente.soft, agente.text]">
          <component :is="b.icon" class="w-5 h-5" />
        </span>
        <div>
          <p class="font-heading font-bold text-sm text-azul-noche">{{ b.titulo }}</p>
          <p class="text-xs text-gray-500 leading-snug">{{ b.desc }}</p>
        </div>
      </li>
    </ul>

    <div class="relative mt-10 hidden lg:block">
      <p class="absolute -top-4 left-0 z-10 font-hand font-semibold text-2xl leading-6 -rotate-12 px-4 py-2 rounded-2xl text-white shadow-lg"
         :class="agente.bg" aria-hidden="true">
        <template v-for="(l, i) in agente.rotulo" :key="i">{{ l }}<br v-if="i < agente.rotulo.length - 1"></template>
      </p>
      <img :src="agente.imagen" alt="" class="contacto-blob w-full h-72 object-cover" />
    </div>
  </div>
</template>

<script setup>
defineProps({ agente: { type: Object, required: true } })
</script>

<style scoped>
.contacto-blob {
  border-radius: 48% 52% 0 0 / 30% 34% 0 0;
}
</style>
