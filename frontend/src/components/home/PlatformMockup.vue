<template>
  <!-- Portátil + móvil con una copia del panel docente (/panel-docente) de la
       herramienta DuaLab, renderizada a tamaño real y escalada a cada pantalla.
       Solo decorativa: aria-hidden y sin interacción. -->
  <div class="relative pb-6 pr-6 md:pr-10 select-none pointer-events-none" aria-hidden="true">
    <!-- Portátil -->
    <div class="relative">
      <div class="rounded-t-2xl bg-gray-800 p-2 md:p-2.5 shadow-[0_20px_50px_rgba(23,40,62,0.25)]">
        <div class="rounded-lg overflow-hidden bg-[#F3F4F6]">
          <ScaledScreen :width="1280" :height="800">
            <PanelDocenteEscritorio />
          </ScaledScreen>
        </div>
      </div>
      <div class="h-3 md:h-4 bg-gradient-to-b from-gray-300 to-gray-400 rounded-b-xl -mx-3 md:-mx-5" />
    </div>

    <!-- Móvil -->
    <div class="absolute right-0 bottom-0 w-[26%] rounded-[18px] bg-gray-900 p-1 shadow-[0_20px_40px_rgba(23,40,62,0.35)]">
      <div class="rounded-[14px] overflow-hidden bg-[#F3F4F6]">
        <ScaledScreen :width="390" :height="740">
          <PanelDocenteMovil />
        </ScaledScreen>
      </div>
    </div>
  </div>
</template>

<script setup>
import ScaledScreen from './mockup/ScaledScreen.vue'
import PanelDocenteEscritorio from './mockup/PanelDocenteEscritorio.vue'
import PanelDocenteMovil from './mockup/PanelDocenteMovil.vue'
</script>
