<template>
  <!-- Copia estática de /panel-docente tal como se ve en un móvil (390 px de
       ancho): TopBar con menú hamburguesa y las tarjetas en una columna. -->
  <div class="w-[390px] h-[740px] flex flex-col bg-[#F3F4F6] font-sans text-[#1F2937] overflow-hidden">
    <PdTopBar movil />
    <main class="flex-1 min-h-0 px-4 py-5 space-y-4 overflow-hidden">
      <PdBienvenida movil />
      <PdContadores movil />
      <PdEncuentros />
      <PdAlertas />
    </main>
  </div>
</template>

<script setup>
import PdTopBar from './PdTopBar.vue'
import PdBienvenida from './PdBienvenida.vue'
import PdContadores from './PdContadores.vue'
import PdEncuentros from './PdEncuentros.vue'
import PdAlertas from './PdAlertas.vue'
</script>
