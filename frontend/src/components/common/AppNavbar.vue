<template>
  <nav
    class="sticky top-0 z-50 transition-all duration-500"
    :class="scrolled
      ? 'bg-white/80 backdrop-blur-xl shadow-sm border-b border-white/30'
      : 'bg-white border-b border-gray-100'"
  >
    <div
      class="max-w-5xl mx-auto px-6 flex items-center justify-between transition-all duration-300"
      :class="scrolled ? 'h-14' : 'h-16'"
    >

      <!-- Logo: separado de la D para que se vea completo el aspa azul, y con
           margen propio para no quedar pegado al resto de enlaces del topbar -->
      <RouterLink :to="{ name: 'home' }" class="logo-animate group flex items-center gap-1 mr-6 shrink-0">
        <img
          src="@/assets/logo_colores.png"
          alt="Logo DuaLab"
          class="object-contain relative z-10 transition-all duration-300 group-hover:scale-105"
          :class="scrolled ? 'h-11' : 'h-14'"
        />
        <span class="font-black tracking-tighter uppercase leading-none relative z-20 flex items-baseline gap-0">
          <span
            class="text-[#1F2937] transition-all duration-300"
            :class="scrolled ? 'text-[22px]' : 'text-[28px]'"
          >Dua</span><span
            class="text-primary-700 transition-all duration-300"
            :class="scrolled ? 'text-[22px]' : 'text-[28px]'"
          >Lab</span>
        </span>
      </RouterLink>

      <!-- Desktop nav: Empresas, Centros, Alumnos, Noticias, Contacto, luego los
           dos botones destacados (Ver retos / Usar DuaLab) -->
      <div class="hidden md:flex items-center gap-5">
        <template v-for="(link, i) in navLinks" :key="link.name">
          <RouterLink
            v-if="link.to"
            class="nav-link relative text-sm text-gray-600 hover:text-primary-700 transition-colors py-1 whitespace-nowrap"
            :style="{ animationDelay: `${180 + i * 100}ms` }"
            :to="link.to"
            active-class="text-primary-700"
          >
            {{ link.label }}
            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary-600 scale-x-0 transition-transform duration-200 origin-left router-link-exact-active:scale-x-100" />
          </RouterLink>
          <button
            v-else
            class="nav-link text-sm text-gray-600 hover:text-primary-700 transition-colors whitespace-nowrap"
            :style="{ animationDelay: `${180 + i * 100}ms` }"
            @click="link.action"
          >{{ link.label }}</button>
        </template>

        <RouterLink
          class="nav-link inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-primary-600 to-primary-400 text-white rounded-full font-black text-xs uppercase tracking-widest shadow-[0_4px_14px_rgba(48,114,170,0.3)] hover:shadow-[0_8px_20px_rgba(48,114,170,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95 whitespace-nowrap"
          :style="{ animationDelay: `${180 + (navLinks.length + 1) * 100}ms` }"
          :to="{ name: 'familias' }"
        >Ver retos</RouterLink>

        <!-- Enlace externo a propósito: la herramienta DuaLab es otra SPA (otro
             dominio/puerto), no una ruta de este router — nunca RouterLink aquí.
             Mismo "pill" que "Ver retos" pero en outline, para que se note que es
             una acción distinta (sales a otra app) sin salirse de la paleta. -->
        <a
          :href="`${toolUrl}/login`"
          class="nav-link inline-flex items-center gap-2 px-5 py-2.5 bg-white text-primary-700 border-2 border-primary-600 rounded-full font-black text-xs uppercase tracking-widest hover:bg-primary-600 hover:text-white transition-all duration-300 hover:-translate-y-0.5 active:scale-95 whitespace-nowrap"
          :style="{ animationDelay: `${180 + (navLinks.length + 2) * 100}ms` }"
        >Usar DuaLab</a>
      </div>

      <!-- Hamburger (mobile) -->
      <button
        class="md:hidden flex flex-col items-center justify-center w-9 h-9 gap-[5px] rounded-lg hover:bg-gray-100 transition-colors"
        :aria-label="menuOpen ? 'Cerrar menú' : 'Abrir menú'"
        @click="menuOpen = !menuOpen"
      >
        <span
          class="block w-5 h-0.5 bg-[#1F2937] transition-all duration-300 origin-center"
          :class="menuOpen ? 'rotate-45 translate-y-[7px]' : ''"
        />
        <span
          class="block w-5 h-0.5 bg-[#1F2937] transition-all duration-300"
          :class="menuOpen ? 'opacity-0 scale-x-0' : ''"
        />
        <span
          class="block w-5 h-0.5 bg-[#1F2937] transition-all duration-300 origin-center"
          :class="menuOpen ? '-rotate-45 -translate-y-[7px]' : ''"
        />
      </button>
    </div>

    <!-- Mobile menu panel -->
    <Transition name="mobile-menu">
      <div v-if="menuOpen" class="md:hidden border-t border-gray-100 bg-white shadow-lg">
        <div class="max-w-5xl mx-auto px-6 py-4 flex flex-col">
          <template v-for="link in navLinks" :key="link.name">
            <RouterLink
              v-if="link.to"
              class="text-sm font-semibold text-gray-700 hover:text-primary-700 py-3.5 border-b border-gray-100 transition-colors"
              :to="link.to"
              active-class="text-primary-700"
              @click="menuOpen = false"
            >{{ link.label }}</RouterLink>
            <button
              v-else
              class="text-left text-sm font-semibold text-gray-700 hover:text-primary-700 py-3.5 border-b border-gray-100 transition-colors"
              @click="link.action(); menuOpen = false"
            >{{ link.label }}</button>
          </template>

          <div class="pt-4 space-y-3">
            <RouterLink
              :to="{ name: 'familias' }"
              class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-primary-600 to-primary-400 text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_4px_14px_rgba(48,114,170,0.3)] active:scale-95 transition-all duration-300"
              @click="menuOpen = false"
            >Ver retos</RouterLink>
            <a
              :href="`${toolUrl}/login`"
              class="flex items-center justify-center gap-2 w-full py-3.5 bg-white text-primary-700 border-2 border-primary-600 rounded-full font-black text-sm uppercase tracking-widest active:scale-95 transition-all duration-300"
              @click="menuOpen = false"
            >Usar DuaLab</a>
          </div>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route  = useRoute()

const scrolled  = ref(false)
const menuOpen  = ref(false)

// La herramienta DuaLab (login real, docente/empresa/admin) — otra SPA, otro
// dominio en producción (dualab.es) u otro puerto en local (localhost:5173).
const toolUrl = import.meta.env.VITE_TOOL_URL ?? 'https://dualab.es'

function onScroll() {
  scrolled.value = window.scrollY > 12
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))

function goToAlumnos() {
  if (route.name === 'home') {
    document.getElementById('para-alumnos')?.scrollIntoView({ behavior: 'smooth' })
  } else {
    router.push({ name: 'home', hash: '#para-alumnos' })
  }
}

const navLinks = [
  { label: 'Empresas',           name: 'empresas', to: { name: 'empresas' } },
  { label: 'Centros Educativos', name: 'centros',  to: { name: 'centros'  } },
  { label: 'Alumnos',            name: 'alumnos',  action: goToAlumnos },
  { label: 'Noticias',           name: 'noticias', to: { name: 'noticias' } },
  { label: 'Contacto',           name: 'contacto', to: { name: 'contacto' } },
]
</script>

<style scoped>
@keyframes fadeSlideDown {
  from { opacity: 0; transform: translateY(-10px); }
  to   { opacity: 1; transform: translateY(0); }
}

.logo-animate {
  animation: fadeSlideDown 0.9s cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: 60ms;
}

.nav-link {
  animation: fadeSlideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
}

/* Mobile menu slide-down */
.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
.mobile-menu-enter-from,
.mobile-menu-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
