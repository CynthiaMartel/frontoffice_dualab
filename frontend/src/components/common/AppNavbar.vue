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

      <!-- Logo: imagen se mete detrás de la D con margen negativo -->
      <RouterLink :to="{ name: 'home' }" class="logo-animate group flex items-center">
        <img
          src="@/assets/logo.png"
          alt="Logo DuaLab"
          class="object-contain relative z-10 transition-all duration-300 group-hover:scale-105"
          :class="scrolled ? 'h-9 -mr-2.5' : 'h-11 -mr-3'"
        />
        <span class="font-black tracking-tighter uppercase leading-none relative z-20 flex items-baseline gap-0">
          <span
            class="text-[#1F2937] transition-all duration-300"
            :class="scrolled ? 'text-[22px]' : 'text-[28px]'"
          >Dua</span><span
            class="text-[#00A859] transition-all duration-300"
            :class="scrolled ? 'text-[22px]' : 'text-[28px]'"
          >Lab</span>
        </span>
      </RouterLink>

      <!-- Desktop nav -->
      <div class="hidden md:flex items-center gap-7">
        <RouterLink
          v-for="(link, i) in navLinks"
          :key="link.name"
          class="nav-link relative text-sm text-gray-600 hover:text-[#00A859] transition-colors py-1"
          :style="{ animationDelay: `${180 + i * 100}ms` }"
          :to="link.to"
          active-class="text-[#00A859]"
        >
          {{ link.label }}
          <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#00A859] scale-x-0 transition-transform duration-200 origin-left router-link-exact-active:scale-x-100" />
        </RouterLink>

        <button
          class="nav-link text-sm text-gray-600 hover:text-[#00A859] transition-colors"
          :style="{ animationDelay: `${180 + navLinks.length * 100}ms` }"
          @click="goToAlumnos"
        >
          Alumnos
        </button>

        <template v-if="auth.isLoggedIn">
          <RouterLink
            class="nav-link inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-xs uppercase tracking-widest shadow-[0_4px_14px_rgba(0,168,89,0.3)] hover:shadow-[0_8px_20px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
            :style="{ animationDelay: `${180 + (navLinks.length + 1) * 100}ms` }"
            :to="{ name: 'dashboard' }"
          >Mi panel</RouterLink>
          <button
            class="nav-link text-sm text-gray-500 hover:text-gray-700 transition-colors"
            :style="{ animationDelay: `${180 + (navLinks.length + 2) * 100}ms` }"
            @click="handleLogout"
          >Salir</button>
        </template>
        <template v-else>
          <RouterLink
            class="nav-link inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-xs uppercase tracking-widest shadow-[0_4px_14px_rgba(0,168,89,0.3)] hover:shadow-[0_8px_20px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
            :style="{ animationDelay: `${180 + (navLinks.length + 1) * 100}ms` }"
            :to="{ name: 'familias' }"
          >Ver retos</RouterLink>
        </template>
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
          <RouterLink
            v-for="link in navLinks"
            :key="link.name"
            class="text-sm font-semibold text-gray-700 hover:text-[#00A859] py-3.5 border-b border-gray-100 transition-colors"
            :to="link.to"
            active-class="text-[#00A859]"
            @click="menuOpen = false"
          >{{ link.label }}</RouterLink>

          <button
            class="text-left text-sm font-semibold text-gray-700 hover:text-[#00A859] py-3.5 border-b border-gray-100 transition-colors"
            @click="goToAlumnos(); menuOpen = false"
          >Alumnos</button>

          <div class="pt-4">
            <template v-if="auth.isLoggedIn">
              <RouterLink
                :to="{ name: 'dashboard' }"
                class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_4px_14px_rgba(0,168,89,0.3)] active:scale-95 transition-all duration-300"
                @click="menuOpen = false"
              >Mi panel</RouterLink>
              <button
                class="mt-3 w-full text-sm text-gray-400 hover:text-gray-600 py-2 transition-colors"
                @click="handleLogout(); menuOpen = false"
              >Cerrar sesión</button>
            </template>
            <template v-else>
              <RouterLink
                :to="{ name: 'familias' }"
                class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_4px_14px_rgba(0,168,89,0.3)] active:scale-95 transition-all duration-300"
                @click="menuOpen = false"
              >Ver retos</RouterLink>
            </template>
          </div>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter, useRoute } from 'vue-router'

const auth   = useAuthStore()
const router = useRouter()
const route  = useRoute()

const scrolled  = ref(false)
const menuOpen  = ref(false)

function onScroll() {
  scrolled.value = window.scrollY > 12
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))

const navLinks = [
  { label: 'Empresas',           name: 'empresas', to: { name: 'empresas' } },
  { label: 'Centros Educativos', name: 'centros',  to: { name: 'centros'  } },
  { label: 'Noticias',           name: 'noticias', to: { name: 'noticias' } },
]

function goToAlumnos() {
  if (route.name === 'home') {
    document.getElementById('para-alumnos')?.scrollIntoView({ behavior: 'smooth' })
  } else {
    router.push({ name: 'home', hash: '#para-alumnos' })
  }
}

async function handleLogout() {
  await auth.logout()
  router.push({ name: 'home' })
}
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
