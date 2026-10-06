<template>
  <!-- Leyenda de colectivos bajo el nombre DuaLab (logo del manual de marca) -->
  <span class="flex items-center gap-[5px] font-sans font-bold uppercase text-azul-noche/80 leading-none tracking-normal" :class="small ? 'text-[5px]' : 'text-[6.5px]'" aria-hidden="true">
    <span v-for="c in colectivos" :key="c.label" class="inline-flex items-center gap-[3px] whitespace-nowrap">
      <span class="shrink-0" :class="[c.bg, small ? 'w-1 h-1' : 'w-[5px] h-[5px]']" />{{ c.label }}
    </span>
  </span>
</template>

<script setup>
defineProps({ small: Boolean })

// Clases literales para que Tailwind las detecte.
const colectivos = [
  { label: 'Centros',          bg: 'bg-centros' },
  { label: 'Empresas',         bg: 'bg-empresas' },
  { label: 'Alumnado',         bg: 'bg-alumnos' },
  { label: 'Administraciones', bg: 'bg-administraciones' },
]
</script>
