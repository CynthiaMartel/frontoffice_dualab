<template>
  <!-- HERO -->
  <section class="relative overflow-hidden bg-primary-700 py-24 px-6">
    <!-- Carousel backgrounds -->
    <div
      v-for="(slide, i) in heroSlides"
      :key="i"
      class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
      :class="heroIndex === i ? 'opacity-20' : 'opacity-0'"
      :style="{ backgroundImage: `url('${slide.image}')` }"
    />

    <!-- Content: cada elemento entra con delay escalonado (orchestrated entrance) -->
    <div class="relative max-w-5xl mx-auto">
    <div class="max-w-2xl">
      <span class="hero-badge inline-block bg-white/15 text-white px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-6 border border-white/30">
        Innovación Educativa B2B
      </span>
      <h1 class="hero-title text-5xl md:text-6xl font-black tracking-tighter text-white leading-[1.1] mb-5">
        Conecta talento<br>con <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fde68a] to-[#a3e635]">retos reales</span>
      </h1>
      <p class="hero-desc text-white/70 text-base leading-relaxed mb-8 max-w-lg">
        DuaLab es la <strong class="text-white font-bold">solución definitiva</strong> para conectar
        <strong class="text-[#86efac] font-bold">empresas</strong> con el
        <strong class="text-[#86efac] font-bold">alumnado en prácticas</strong>.
        Transformamos necesidades empresariales en
        <strong class="text-white font-black">retos académicos</strong>
        para impulsar el <strong class="text-white font-bold">aprendizaje práctico</strong>
        y descubrir <strong class="text-[#a3e635] font-black">talento emergente</strong>.
      </p>
      <div class="hero-btns flex flex-wrap md:flex-nowrap gap-3">
        <button @click="scrollToComoFunciona"
                class="cta-attention group inline-flex items-center gap-2 px-6 py-3 bg-white text-[#15803d] rounded-full font-black text-sm uppercase tracking-widest shadow-[0_8px_25px_rgba(0,0,0,0.2)] hover:shadow-[0_14px_35px_rgba(0,0,0,0.3)] hover:[animation-play-state:paused] transition-all duration-300 hover:-translate-y-0.5 active:scale-95 whitespace-nowrap">
          <svg class="w-4 h-4 transition-transform group-hover:rotate-90 duration-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          Cómo funciona
        </button>

        <button @click="scrollToContact"
                class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white border-2 border-white/40 rounded-full font-black text-sm uppercase tracking-widest hover:bg-white/20 hover:border-white/70 transition-all duration-300 hover:-translate-y-0.5 active:scale-95 backdrop-blur-sm whitespace-nowrap">
          Solicitar demo
        </button>
      </div>

    </div>
    </div>

    <!-- Carousel dots -->
    <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2 z-10">
      <button
        v-for="(_, i) in heroSlides"
        :key="i"
        @click="goToSlide(i)"
        :class="[
          'rounded-full transition-all duration-300',
          heroIndex === i ? 'w-6 h-2.5 bg-white' : 'w-2.5 h-2.5 bg-white/40 hover:bg-white/70'
        ]"
        :aria-label="`Diapositiva ${i + 1}`"
      />
    </div>
  </section>

  <!-- STATS -->
  <section class="bg-white border-b border-gray-100 py-8 px-6">
    <div v-reveal class="max-w-3xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <StatItem number="50+"  label="Retos Activos" />
      <StatItem number="3"    label="Niveles de Dificultad" />
      <StatItem number="20+"  label="Empresas" />
      <StatItem number="100%" label="Aplicable a la vida laboral" />
    </div>
  </section>

  <!-- SERVICIOS -->
  <section class="bg-[#F8FAFC] py-16 px-6">
    <div v-reveal class="max-w-4xl mx-auto text-center mb-12">
      <div class="inline-block bg-[#99CC33]/15 text-[#00A859] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 border border-[#99CC33]/30">Servicios</div>
      <h2 class="text-3xl font-black tracking-tighter text-[#1F2937]">Todo lo que ofrecemos</h2>
      <p class="text-gray-500 mt-2 font-medium">Soluciones integrales para conectar empresas, centros educativos y alumnado</p>
    </div>
    <div v-reveal="100" class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-5 gap-8">
      <ServiceItem v-for="s in serviciosItems" :key="s.title"
                   :icon="s.icon" :title="s.title" :desc="s.desc"
                   @click="activeService = s" />
    </div>
  </section>

  <ServiceModal :service="activeService" @close="activeService = null" />

  <!-- GALERÍA -->
  <section class="bg-green-50 py-16 px-6">
    <div v-reveal class="max-w-5xl mx-auto text-center mb-10">
      <div class="inline-block bg-[#99CC33]/15 text-[#00A859] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 border border-[#99CC33]/30">Nuestra galería</div>
      <h2 class="text-3xl font-black tracking-tighter text-[#1F2937]">Hablamos con experiencia</h2>
      <p class="text-gray-500 mt-2 font-medium">Momentos reales de formación, retos y trabajo en equipo</p>
    </div>
    <div v-reveal="100" class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-5">
      <img v-for="img in galeriaImages" :key="img" :src="img" alt="Sesión de trabajo en DuaLab"
           class="w-full h-64 object-cover rounded-2xl hover:scale-[1.02] transition-transform duration-300"
           loading="lazy" />
    </div>
    <div v-reveal="150" class="text-center mt-10">
      <button
        type="button"
        class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-[#1F2937] border-2 border-gray-200 rounded-full font-black text-sm uppercase tracking-widest hover:border-[#00A859] hover:text-[#00A859] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
        @click="galleryOpen = true"
      >
        Ver más
      </button>
    </div>
  </section>

  <GalleryModal :open="galleryOpen" :images="allGalleryImages" @close="galleryOpen = false" />

  <!-- CÓMO FUNCIONA -->
  <section id="como-funciona" class="bg-white py-20 px-6">
    <div v-reveal class="max-w-3xl mx-auto text-center mb-12">
      <div class="inline-block bg-[#99CC33]/15 text-[#00A859] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 border border-[#99CC33]/30">
        Flujo de Trabajo
      </div>
      <h2 class="text-3xl font-black tracking-tighter text-[#1F2937]">¿Cómo funciona DuaLab?</h2>
      <p class="text-gray-500 mt-2 text-sm font-medium">Tres pasos para transformar necesidades reales en aprendizaje práctico</p>
    </div>
    <div class="max-w-3xl mx-auto grid md:grid-cols-3 gap-4">
      <div v-reveal="0">
        <StepCard number="1" :icon="BuildingOffice2Icon" title="La Empresa propone"
          desc="Identifican una fricción o cuello de botella real en su día a día." />
      </div>
      <div v-reveal="150">
        <StepCard number="2" :icon="SparklesIcon" title="La IA lo transforma"
          desc="DuaLab genera un reto académico alineado al currículo oficial." />
      </div>
      <div v-reveal="300">
        <StepCard number="3" :icon="AcademicCapIcon" title="El Alumnado resuelve"
          desc="Ganan experiencia práctica mientras aportan valor real a la empresa." />
      </div>
    </div>
  </section>

  <!-- PARA EMPRESAS -->
  <ValueSection
    tag="Para Empresas"
    title="Identifica y atrae talento cualificado"
    description="Propón retos reales y encuentra candidatos con habilidades demostradas. Conecta con centros educativos para formar a los profesionales que necesitas."
    :features="empresasFeatures"
    image="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500&q=70"
    bg-gray
  >
    <template #actions>
      <div class="flex flex-wrap gap-4">
        <button
          class="group inline-flex items-center gap-2.5 px-7 py-3.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_8px_25px_rgba(0,168,89,0.3)] hover:shadow-[0_14px_35px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
          @click="scrollToContact"
        >
          Contactar ahora
          <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>
        <RouterLink
          class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-[#1F2937] border-2 border-gray-200 rounded-full font-black text-sm uppercase tracking-widest hover:border-[#00A859] hover:text-[#00A859] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
          :to="{ name: 'empresas' }"
        >Empresas asociadas</RouterLink>
      </div>
    </template>
  </ValueSection>

  <!-- PARA CENTROS EDUCATIVOS -->
  <ValueSection
    tag="Para Centros Educativos"
    title="Mejora la empleabilidad de tus estudiantes"
    description="Accede a retos actualizados y conecta con empresas que buscan talento. Ofrece formación práctica y relevante para el mercado laboral."
    :features="centrosFeatures"
    image="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=500&q=70"
    reverse
  >
    <template #actions>
      <div class="flex flex-wrap gap-4">
        <button
          class="group inline-flex items-center gap-2.5 px-7 py-3.5 bg-gradient-to-r from-[#00A859] to-[#99CC33] text-white rounded-full font-black text-sm uppercase tracking-widest shadow-[0_8px_25px_rgba(0,168,89,0.3)] hover:shadow-[0_14px_35px_rgba(153,204,51,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
          @click="scrollToContact"
        >
          Solicitar demo
          <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>
        <RouterLink
          class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-[#1F2937] border-2 border-gray-200 rounded-full font-black text-sm uppercase tracking-widest hover:border-[#00A859] hover:text-[#00A859] transition-all duration-300 hover:-translate-y-0.5 active:scale-95"
          :to="{ name: 'centros' }"
        >Centros asociados</RouterLink>
      </div>
    </template>
  </ValueSection>

  <!-- PARA ALUMNOS -->
  <ValueSection
    section-id="para-alumnos"
    tag="Para Alumnos"
    title="Desarrolla habilidades que importan"
    description="Resuelve retos reales de empresas, construye tu portfolio y destaca en tu carrera. Aprende haciendo y demuestra tu valía."
    :features="alumnosFeatures"
    cta-label="Explorar retos →"
    image="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=500&q=70"
    bg-gray
    @cta="$router.push({ name: 'familias' })"
  />

  <!-- FAMILIAS -->
  <section class="bg-green-50 py-20 px-6">
    <div v-reveal class="max-w-4xl mx-auto text-center mb-10">
      <div class="inline-block bg-[#99CC33]/15 text-[#00A859] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 border border-[#99CC33]/30">Formación</div>
      <h2 class="text-3xl font-black tracking-tighter text-[#1F2937]">Familias Profesionales</h2>
      <p class="text-gray-500 mt-2 font-medium">Retos organizados en áreas clave del mercado laboral</p>
    </div>
    <div v-reveal="100" class="max-w-2xl mx-auto grid grid-cols-3 gap-4">
      <FamiliaChip v-for="f in quickFamilias" :key="f.slug"
                   :icon="f.icon" :label="f.label"
                   @click="$router.push({ name: 'familia-detalle', params: { slug: f.slug } })" />
    </div>
  </section>

  <!-- NOTICIAS -->
  <section id="noticias" class="bg-white py-14 px-6">
    <div v-reveal class="max-w-5xl mx-auto">
      <div class="flex items-center justify-between mb-8">
        <div>
          <p class="inline-block bg-[#99CC33]/15 text-[#00A859] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest border border-[#99CC33]/30">Actualidad</p>
          <h2 class="text-3xl font-black tracking-tighter text-[#1F2937] mt-3">Últimas noticias</h2>
        </div>
        <RouterLink :to="{ name: 'noticias' }"
                    class="text-sm font-medium text-primary-600 hover:text-primary-700 flex items-center gap-1 transition-colors">
          Ver todas
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
            <path d="M6 3l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </RouterLink>
      </div>

      <div class="grid md:grid-cols-3 gap-5">
        <!-- Tarjeta featured -->
        <RouterLink :to="{ name: 'noticias' }"
                    class="md:col-span-2 relative rounded-2xl overflow-hidden group cursor-pointer block">
          <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&q=70"
               alt="Noticia destacada"
               class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-105" />
          <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/30 to-transparent" />
          <div class="absolute bottom-0 left-0 right-0 p-6">
            <span class="inline-block bg-primary-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full mb-3 tracking-wider uppercase">
              Novedad
            </span>
            <h3 class="text-white font-bold text-lg leading-snug mb-2">
              DuaLab revoluciona la FP Dual con IA: retos académicos generados automáticamente
            </h3>
            <p class="text-white/70 text-xs">19 jun 2026 · 4 min de lectura</p>
          </div>
        </RouterLink>

        <!-- Tarjetas pequeñas apiladas -->
        <div class="flex flex-col gap-5">
          <RouterLink :to="{ name: 'noticias' }"
                      class="relative rounded-2xl overflow-hidden group cursor-pointer block flex-1">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&q=70"
                 alt="Caso de éxito"
                 class="w-full h-full min-h-[120px] object-cover transition-transform duration-500 group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/75 via-gray-900/20 to-transparent" />
            <div class="absolute bottom-0 left-0 right-0 p-4">
              <span class="inline-block bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full mb-1.5 tracking-wider uppercase">
                Caso de éxito
              </span>
              <h4 class="text-white font-semibold text-sm leading-snug">
                150 alumnos resuelven retos reales de empresa en una semana
              </h4>
            </div>
          </RouterLink>

          <RouterLink :to="{ name: 'noticias' }"
                      class="relative rounded-2xl overflow-hidden group cursor-pointer block flex-1">
            <img src="https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=400&q=70"
                 alt="Evento"
                 class="w-full h-full min-h-[120px] object-cover transition-transform duration-500 group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/75 via-gray-900/20 to-transparent" />
            <div class="absolute bottom-0 left-0 right-0 p-4">
              <span class="inline-block bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full mb-1.5 tracking-wider uppercase">
                Evento
              </span>
              <h4 class="text-white font-semibold text-sm leading-snug">
                DuaLab en el Congreso Nacional de FP: talento emergente
              </h4>
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIOS -->
  <section class="bg-primary-700 py-20 px-6">
    <div v-reveal class="max-w-4xl mx-auto">
      <div class="text-center mb-10">
        <div class="inline-block bg-white/10 text-white px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 border border-white/20">Testimonios</div>
        <h2 class="text-3xl font-black tracking-tighter text-white">Lo que dicen de nosotros</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-5">
        <div v-reveal="0"><TestimonialCard
          quote="Los microretos nos han ayudado a identificar talento con habilidades específicas que necesitábamos."
          name="María González" role="Directora de RRHH, TechCorp" /></div>
        <div v-reveal="150"><TestimonialCard
          quote="Nuestros alumnos están más motivados y empleables. La conexión directa con empresas ha mejorado nuestras tasas de inserción."
          name="Carlos Martínez" role="Director, IES Tecnológico" /></div>
        <div v-reveal="300"><TestimonialCard
          quote="Gracias a los retos pude demostrar mis habilidades y conseguí mi primer empleo antes de terminar el ciclo."
          name="Laura Sánchez" role="Estudiante de Informática" /></div>
      </div>
    </div>
  </section>

  <!-- CONTACTO -->
  <section id="contact" class="bg-white py-20 px-6">
    <div v-reveal class="max-w-xl mx-auto text-center mb-8">
      <div class="inline-block bg-[#99CC33]/15 text-[#00A859] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 border border-[#99CC33]/30">Contacto</div>
      <h2 class="text-3xl font-black tracking-tighter text-[#1F2937]">¿Listo para empezar?</h2>
      <p class="text-gray-500 mt-2 font-medium">Déjanos tus datos y nos pondremos en contacto contigo</p>
    </div>
    <div v-reveal="100">
      <ContactForm />
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import dua1 from '@/assets/1_dua.jpeg'
import dua2 from '@/assets/2_dua.jpg'
import dua3 from '@/assets/3_dua.jpg'
import dua4 from '@/assets/4_dua.jpeg'
import dua5 from '@/assets/5_dua.jpeg'
import dua6 from '@/assets/6_dua.jpg'
import dua7 from '@/assets/7_dua.jpg'
import dua8 from '@/assets/8_dua.jpg'
import dua9  from '@/assets/dua_9.jpg'
import dua10 from '@/assets/dua_10.jpeg'
import dua11 from '@/assets/dua_11.jpeg'
import dua12 from '@/assets/dua_12.jpeg'
import dua13 from '@/assets/dua_13.jpg'
import dua14 from '@/assets/dua_14.jpeg'
import dua16 from '@/assets/dua_16.jpg'
import dua17 from '@/assets/dua_17.jpg'
import dua18 from '@/assets/dua_18.jpg'
import dua19 from '@/assets/dua_19.jpg'
import dua20 from '@/assets/dua_20.jpg'
import dua21 from '@/assets/dua_21.jpg'
import dua22 from '@/assets/dua_22.jpg'
import dua23 from '@/assets/dua_23.jpg'
import dua24 from '@/assets/dua_24.jpg'
import dua25 from '@/assets/dua_25.jpg'
import dua26 from '@/assets/dua_26.jpg'
import dua27 from '@/assets/dua_27.jpg'
import dua28 from '@/assets/dua_28.jpg'
import dua29 from '@/assets/dua_29.jpg'
import dua30 from '@/assets/dua_30.jpg'
import dua31 from '@/assets/dua_31.jpg'
import dua32 from '@/assets/dua_32.jpg'
import dua33 from '@/assets/dua_33.jpg'
import StatItem        from '@/components/home/StatItem.vue'
import ValueSection    from '@/components/home/ValueSection.vue'
import FamiliaChip     from '@/components/home/FamiliaChip.vue'
import StepCard        from '@/components/home/StepCard.vue'
import ServiceItem     from '@/components/home/ServiceItem.vue'
import ServiceModal    from '@/components/home/ServiceModal.vue'
import GalleryModal    from '@/components/home/GalleryModal.vue'
import TestimonialCard from '@/components/home/TestimonialCard.vue'
import ContactForm     from '@/components/home/ContactForm.vue'
import {
  BuildingOffice2Icon,
  SparklesIcon,
  AcademicCapIcon,
  ComputerDesktopIcon,
  BriefcaseIcon,
  PresentationChartBarIcon,
  ClipboardDocumentListIcon,
  ArrowPathIcon,
  BookOpenIcon,
  MapIcon,
  MagnifyingGlassIcon,
  CheckBadgeIcon,
  NewspaperIcon,
  UserGroupIcon,
  ArrowTrendingUpIcon,
} from '@heroicons/vue/24/outline'

// ── Directiva local: scroll-reveal (Intersection Observer) ────────────────────
// Uso: v-reveal (sin delay) o v-reveal="200" (con 200ms de delay)
const vReveal = {
  mounted(el, binding) {
    const delay = typeof binding.value === 'number' ? binding.value : 0
    el.classList.add('reveal-init')
    const io = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setTimeout(() => el.classList.add('reveal-in'), delay)
          io.disconnect()
        }
      },
      { threshold: 0.1 }
    )
    io.observe(el)
  },
}

// ── Carousel ──────────────────────────────────────────────────────────────────
const heroSlides = [
  { image: dua1 },
  { image: dua2 },
  { image: dua3 },
  { image: dua4 },
  { image: dua5 },
  { image: dua6 },
  { image: dua7 },
  { image: dua8 },
]

const activeService = ref(null)

const galeriaImages = [dua11, dua14, dua21]
const galleryOpen = ref(false)
const allGalleryImages = [
  dua1, dua2, dua3, dua4, dua5, dua6, dua7, dua8,
  dua9, dua10, dua11, dua12, dua13, dua14,
  dua16, dua17, dua18, dua19, dua20, dua21,
  dua22, dua23, dua24, dua25, dua26,
  dua27, dua28, dua29, dua30, dua32,
]

const heroIndex = ref(0)
let heroTimer = null

function goToSlide(i) {
  heroIndex.value = i
  clearInterval(heroTimer)
  heroTimer = setInterval(nextSlide, 5000)
}

function nextSlide() {
  heroIndex.value = (heroIndex.value + 1) % heroSlides.length
}

onMounted(() => { heroTimer = setInterval(nextSlide, 5000) })
onUnmounted(() => { clearInterval(heroTimer) })

// ── Navigation ─────────────────────────────────────────────────────────────────
function scrollToComoFunciona() {
  document.getElementById('como-funciona')?.scrollIntoView({ behavior: 'smooth' })
}
function scrollToContact() {
  document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })
}

// ── Data ───────────────────────────────────────────────────────────────────────
const empresasFeatures = [
  { title: 'Reclutamiento eficiente', desc: 'Evalúa candidatos por sus resultados en retos prácticos' },
  { title: 'Formación a medida',      desc: 'Propón retos alineados con tus necesidades específicas' },
  { title: 'Visibilidad de marca',    desc: 'Posiciona tu empresa como referente en formación dual' },
]
const centrosFeatures = [
  { title: 'Contenido actualizado', desc: 'Retos alineados con las demandas del mercado laboral' },
  { title: 'Red de empresas',       desc: 'Facilita prácticas y empleo para tus alumnos' },
  { title: 'Seguimiento real',      desc: 'Mide el progreso de tus estudiantes en tiempo real' },
]
const alumnosFeatures = [
  { title: 'Experiencia práctica',   desc: 'Aplica tus conocimientos en situaciones reales' },
  { title: 'Portfolio profesional',  desc: 'Construye un portfolio de proyectos reales' },
  { title: 'Oportunidades laborales',desc: 'Conecta con empresas que buscan tu perfil' },
]

const serviciosItems = [
  {
    title: 'Consultoría y asesoría',
    icon: PresentationChartBarIcon,
    desc: 'Asesoría y estrategias educativas y empresariales.',
    image: dua33,
    description: 'Prestamos servicios de **asesoría y consultoría especializada en formación**, desarrollando estrategias personalizadas para centros educativos, empresas y administraciones públicas.',
    highlights: [
      { title: 'Más de 12 años de experiencia', desc: 'Profundo conocimiento de la normativa y los procedimientos del sector formativo.' },
      { title: 'Estrategias a medida', desc: 'Planes de transformación adaptados a cada organización.' },
      { title: 'Acompañamiento estratégico', desc: 'Te ayudamos a analizar, gestionar y alcanzar tus objetivos formativos.' },
    ],
  },
  {
    title: 'Gestión de Proyectos',
    icon: ClipboardDocumentListIcon,
    desc: 'Gestión integral de proyectos formativos.',
    image: dua18,
    description: 'En DuaLab gestionamos **proyectos formativos de manera integral**, desde el diseño inicial hasta la evaluación final.',
    highlights: [
      { title: 'Planificación estratégica', desc: 'Diseño y organización de cada etapa del proyecto.' },
      { title: 'Ejecución eficiente', desc: 'Control de costes y cumplimiento de los objetivos establecidos.' },
      { title: 'Adaptación al entorno', desc: 'Trabajamos con centros, empresas y administraciones según sus necesidades.' },
    ],
  },
  {
    title: 'Ruta a la Dual',
    icon: ArrowPathIcon,
    desc: 'Acompañamiento en la transición hacia la dual.',
    image: dua24,
    description: 'Ofrecemos un **servicio integral de acompañamiento** a los agentes del ecosistema educativo para facilitar su transición hacia la metodología dual.',
    highlights: [
      { title: 'Formaciones específicas', desc: 'Adaptadas a las necesidades de cada centro o territorio.' },
      { title: 'Procedimientos eficientes', desc: 'Diseñamos los flujos de trabajo necesarios para implantar la dual.' },
      { title: 'Evaluación continua', desc: 'Sistemas de seguimiento que garantizan una implementación sostenible.' },
    ],
  },
  {
    title: 'Formación de tutores de empresa',
    icon: BookOpenIcon,
    desc: 'Formación flexible para tutores de FP.',
    image: dua31,
    description: 'Hemos formado a **tutores de empresa** en proyectos de FP Dual en todo el territorio español.',
    highlights: [
      { title: 'Contenidos propios y actualizados', desc: 'Alineados con la normativa vigente en cada momento.' },
      { title: 'Plataforma interactiva', desc: 'Gestionada por profesionales con amplia experiencia en el sector.' },
      { title: 'Formación a medida', desc: 'Adaptada a sectores productivos, normativa autonómica y disponibilidad horaria.' },
    ],
  },
  {
    title: 'Orientación Profesional',
    icon: MapIcon,
    desc: 'Fortalecemos la orientación profesional educativa.',
    image: dua19,
    description: 'Guiamos a **jóvenes, desempleados y trabajadores** hacia oportunidades formativas y laborales alineadas con su perfil.',
    highlights: [
      { title: 'Cobertura nacional', desc: 'Hemos formado a orientadores de todas las comunidades autónomas.' },
      { title: 'Herramientas actualizadas', desc: 'Conocimientos prácticos para potenciar el éxito educativo y profesional.' },
      { title: 'Talleres especializados', desc: 'Dirigidos a orientadores educativos y del ámbito del empleo.' },
    ],
  },
  {
    title: 'Prospección Efectiva',
    icon: MagnifyingGlassIcon,
    desc: 'Formación práctica para prospectores educativos.',
    image: dua20,
    description: 'Capacitamos a **profesionales de la prospección** en todos los sectores y niveles educativos.',
    highlights: [
      { title: 'Amplia experiencia', desc: 'Prospección de empresas para proyectos educativos en varias comunidades autónomas.' },
      { title: 'Contenidos adaptados', desc: 'A la normativa autonómica y a la realidad socioeducativa de cada entorno.' },
      { title: 'Formación práctica', desc: 'Alineada con las necesidades reales del mercado laboral y educativo.' },
    ],
  },
  {
    title: 'Acreditación de competencias',
    icon: CheckBadgeIcon,
    desc: 'Acreditación de competencias profesionales.',
    image: dua9,
    description: 'Gestionamos proyectos de **acreditación de competencias profesionales** para diversos colectivos en distintas comunidades autónomas.',
    highlights: [
      { title: 'Itinerarios personalizados', desc: 'Alineados con las necesidades del mercado laboral.' },
      { title: 'Soporte especializado', desc: 'Actuamos en representación o apoyo de los profesionales implicados.' },
      { title: 'Conocimiento territorial', desc: 'Dominio de los procedimientos específicos de cada comunidad autónoma.' },
    ],
  },
  {
    title: 'Publicaciones',
    icon: NewspaperIcon,
    desc: 'Publicaciones sobre formación dual.',
    image: dua16,
    description: 'Desarrollamos **guías, manuales y estudios** que abordan los aspectos clave de la formación dual.',
    highlights: [
      { title: 'Recursos prácticos', desc: 'Materiales aplicables directamente en el día a día formativo.' },
      { title: 'Enfoque estratégico', desc: 'Contenidos pensados para facilitar la implementación de la dual.' },
      { title: 'Compromiso con la excelencia', desc: 'Reflejo de nuestra experiencia en el ámbito educativo y empresarial.' },
    ],
    link: { to: { name: 'noticias' }, label: 'Ver publicaciones y noticias' },
  },
  {
    title: 'HR Itinerarios Formativos',
    icon: UserGroupIcon,
    desc: 'Creación de perfiles profesionales adaptados.',
    image: dua12,
    description: 'Ayudamos a las empresas a **desarrollar perfiles profesionales** adaptados a las competencias que necesitan sus posiciones clave.',
    highlights: [
      { title: 'Perfiles híbridos', desc: 'Creación de roles adaptados a los nuevos retos del mercado laboral.' },
      { title: 'Actualización de competencias', desc: 'Fortalecemos el talento de los equipos ya existentes.' },
      { title: 'Soluciones a medida', desc: 'Diseñadas para impulsar tanto el talento individual como el crecimiento organizacional.' },
    ],
  },
  {
    title: 'Expansión educativa',
    icon: ArrowTrendingUpIcon,
    desc: 'Desarrollo estratégico para instituciones educativas.',
    image: dua10,
    description: 'Colaboramos con **instituciones educativas** para impulsar el desarrollo y crecimiento de sus modelos de negocio.',
    highlights: [
      { title: 'Oportunidades estratégicas', desc: 'Identificación y optimización de la oferta educativa.' },
      { title: 'Apertura de centros', desc: 'Liderazgo en la acreditación y apertura de nuevos centros educativos.' },
      { title: 'Cumplimiento normativo', desc: 'Procesos ágiles y exitosos, garantizando el marco legal en todo momento.' },
    ],
  },
]

const quickFamilias = [
  { slug: 'administracion-gestion',    label: 'Administración y Gestión',    icon: BriefcaseIcon },
  { slug: 'comercio-marketing',        label: 'Comercio y Marketing',        icon: PresentationChartBarIcon },
  { slug: 'informatica-comunicaciones', label: 'Informática y Comunicaciones', icon: ComputerDesktopIcon },
]
</script>

<style scoped>
/* ── Orchestrated entrance: animaciones de entrada del hero ───────────────────
   Cada elemento aparece secuencialmente con delay escalonado.
   Técnica: @keyframes + animation-delay + animation-fill-mode: both          */
@keyframes heroFadeUp {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.hero-badge {
  animation: heroFadeUp 1.1s cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: 0.2s;
}
.hero-title {
  animation: heroFadeUp 1.3s cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: 0.55s;
}
.hero-desc {
  animation: heroFadeUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: 1.0s;
}
.hero-btns {
  animation: heroFadeUp 1.1s cubic-bezier(0.16, 1, 0.3, 1) both;
  animation-delay: 1.45s;
}

/* ── Botón CTA: salto periódico para llamar la atención ─────────────────── */
@keyframes ctaAttention {
  0%, 60%, 100% { transform: translateY(0); }
  72%           { transform: translateY(-10px); }
  84%           { transform: translateY(-4px); }
  92%           { transform: translateY(-7px); }
}
.cta-attention {
  animation: ctaAttention 3s ease-in-out infinite;
}

</style>
