<template>
  <!-- Portátil + móvil con una copia del panel de inicio (/panel-docente) de la
       herramienta DuaLab. Cada pantalla dibuja el panel a su ancho de lienzo y lo
       escala al marco; si el marco es estrecho, el panel se recoloca (tablet/móvil)
       en vez de encogerse hasta ser ilegible. Solo decorativa: aria-hidden y sin interacción. -->
  <div class="relative pt-10 pb-6 pr-8 sm:pt-0 md:pr-10 select-none pointer-events-none" aria-hidden="true">
    <!-- Portátil -->
    <div class="relative">
      <div class="rounded-t-xl sm:rounded-t-2xl bg-gray-800 p-1.5 sm:p-2 md:p-2.5 shadow-[0_20px_50px_rgba(23,40,62,0.25)]">
        <div class="rounded-md sm:rounded-lg overflow-hidden bg-[#F3F6FA]">
          <ScaledScreen v-slot="{ ancho }" :width="1600" :height="920" :min-width="768" :min-scale="0.34">
            <PanelInicio :ancho="ancho" />
          </ScaledScreen>
        </div>
      </div>
      <div class="h-2.5 sm:h-3 md:h-4 bg-gradient-to-b from-gray-300 to-gray-400 rounded-b-xl -mx-2 sm:-mx-3 md:-mx-5" />
    </div>

    <!-- Móvil: más grande en pantallas pequeñas para que se lea -->
    <div class="absolute right-0 bottom-0 w-[36%] sm:w-[24%] rounded-[16px] sm:rounded-[20px] bg-gray-900 p-1 shadow-[0_20px_40px_rgba(23,40,62,0.35)]">
      <div class="rounded-[12px] sm:rounded-[16px] overflow-hidden bg-[#F3F6FA]">
        <ScaledScreen v-slot="{ ancho }" :width="390" :height="844" :min-width="320" :min-scale="0.36">
          <PanelInicio :ancho="ancho" />
        </ScaledScreen>
      </div>
    </div>
  </div>
</template>

<script setup>
import ScaledScreen from './mockup/ScaledScreen.vue'
import PanelInicio from './mockup/PanelInicio.vue'
</script>
