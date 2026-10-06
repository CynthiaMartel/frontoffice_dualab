<template>
  <!-- Intereses (selección múltiple). variante 'check': lista de casillas (empresa);
       'tarjetas': tarjetas con icono (alumno, administración). -->
  <fieldset>
    <legend class="sr-only">Intereses</legend>
    <div v-if="variante === 'check'" class="grid sm:grid-cols-2 gap-x-6 gap-y-2">
      <label v-for="o in opciones" :key="o.value" class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
        <input type="checkbox" class="accent-primary-600 w-4 h-4" :value="o.value" v-model="model" />
        {{ o.label }}
      </label>
    </div>
    <div v-else class="grid grid-cols-2 md:grid-cols-3 gap-2">
      <label v-for="o in opciones" :key="o.value"
             class="flex items-center gap-2.5 rounded-xl border px-3 py-2.5 text-xs font-semibold cursor-pointer transition-colors"
             :class="model.includes(o.value) ? 'border-primary-500 bg-primary-50 text-azul-noche' : 'border-gray-200 text-gray-600 hover:border-primary-200'">
        <input type="checkbox" class="sr-only" :value="o.value" v-model="model" />
        <component :is="iconos[o.value] ?? ChatBubbleLeftEllipsisIcon" class="w-5 h-5 shrink-0" :class="colorIcono" />
        {{ o.label }}
      </label>
    </div>
  </fieldset>
</template>

<script setup>
import {
  BriefcaseIcon, LightBulbIcon, Cog6ToothIcon, ChartBarIcon, EnvelopeIcon,
  ChatBubbleLeftEllipsisIcon, UserGroupIcon, DocumentTextIcon, TrophyIcon,
} from '@heroicons/vue/24/outline'

defineProps({
  opciones: Array,
  variante: { type: String, default: 'tarjetas' },
  colorIcono: { type: String, default: 'text-primary-600' },
})
const model = defineModel({ type: Array, default: () => [] })

const iconos = {
  practicas: BriefcaseIcon, retos: LightBulbIcon, competencias: Cog6ToothIcon, casos_exito: TrophyIcon,
  noticias: EnvelopeIcon, gestionar_programas: Cog6ToothIcon, conectar_agentes: UserGroupIcon,
  monitorizar_impacto: ChartBarIcon, informes: DocumentTextIcon,
}
</script>
