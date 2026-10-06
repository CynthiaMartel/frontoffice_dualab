<template>
  <!-- /contacto: un formulario por agente (diseños "FORMULARIO CENTROS / EMPRESAS /
       ALUMNOS / ADMINISTRACIONES"). Por defecto, centro educativo; ?tipo= lo cambia. -->
  <section ref="seccionForm" class="bg-superficie py-12 md:py-16 px-6 scroll-mt-16">
    <div class="max-w-6xl mx-auto grid lg:grid-cols-[5fr_7fr] gap-10 lg:gap-12 items-start">
      <ContactoHero :agente="agente" />

      <div class="bg-white rounded-2xl shadow-[0_10px_40px_rgba(23,40,62,0.08)] p-6 md:p-8">
        <ContactoStepper :pasos="agente.pasos" :completados="completados" class="mb-6" />

        <!-- Confirmación -->
        <div v-if="enviado" class="text-center py-10" role="status">
          <span class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-5" :class="[agente.soft, agente.text]">
            <CheckCircleIcon class="w-9 h-9" />
          </span>
          <h2 class="text-2xl font-extrabold text-azul-noche">¡Solicitud enviada!</h2>
          <p class="text-gray-500 mt-2 max-w-md mx-auto">{{ MENSAJES_EXITO[accion] }}</p>
          <button type="button" class="btn-pill-outline mt-8" @click="reiniciar">Enviar otra solicitud</button>
        </div>

        <form v-else novalidate @submit.prevent="enviar">
          <!-- Campo trampa para bots: invisible para personas y lectores de pantalla -->
          <div class="absolute -left-[9999px] w-px h-px overflow-hidden" aria-hidden="true">
            <label for="website">No rellenes este campo</label>
            <input id="website" v-model="honeypot" type="text" name="website" tabindex="-1" autocomplete="off" />
          </div>
          <!-- 1. Tipo de organización -->
          <h2 class="font-heading font-bold text-azul-noche mb-3">¿Qué tipo de organización eres?</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-3" role="radiogroup" aria-label="Tipo de organización">
            <button v-for="(a, key) in AGENTES" :key="key" type="button" role="radio" :aria-checked="tipo === key"
                    :disabled="a.bloqueado" :title="a.bloqueado ? 'Próximamente' : undefined"
                    class="relative flex flex-col items-center gap-2 rounded-xl border-2 px-3 py-4 text-center transition-all"
                    :class="a.bloqueado ? 'border-dashed border-gray-200 opacity-50 cursor-not-allowed'
                      : tipo === key ? [a.border, a.soft] : 'border-gray-100 hover:border-gray-200'"
                    @click="cambiarTipo(key)">
              <span v-if="a.bloqueado" class="absolute top-1.5 right-1.5 text-[9px] font-black uppercase tracking-wide text-gray-500 bg-gray-100 rounded-full px-1.5 py-0.5">Próximamente</span>
              <span v-if="tipo === key" class="absolute top-2 right-2 w-5 h-5 rounded-full flex items-center justify-center text-white" :class="a.bg">
                <svg class="w-3 h-3" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M1.5 5l2.5 2.5L8.5 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </span>
              <component :is="a.icon" class="w-8 h-8" :class="a.text" />
              <span class="text-xs font-semibold text-azul-noche">{{ a.label }}</span>
            </button>
          </div>

          <!-- ── CENTRO EDUCATIVO ── -->
          <template v-if="tipo === 'centro'">
            <h2 class="form-section">Datos del centro educativo</h2>
            <div class="grid sm:grid-cols-2 gap-4">
              <CampoForm id="centro_nombre" label="Nombre del centro" required :error="err('centro_nombre')">
                <input id="centro_nombre" v-model="d.centro.centro_nombre" class="form-input" placeholder="Ej. IES Sierra Norte" required maxlength="160" />
              </CampoForm>
              <CampoForm id="direccion" label="Dirección" required :error="err('direccion')">
                <input id="direccion" v-model="d.centro.direccion" class="form-input" placeholder="Calle, número, etc." required maxlength="200" autocomplete="street-address" />
              </CampoForm>
              <CampoForm id="municipio" label="Municipio" required :error="err('municipio')">
                <select id="municipio" v-model="d.centro.municipio" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona un municipio</option>
                  <option v-for="m in MUNICIPIOS[d.centro.provincia]" :key="m">{{ m }}</option>
                </select>
              </CampoForm>
              <CampoForm id="provincia" label="Provincia" required :error="err('provincia')">
                <select id="provincia" v-model="d.centro.provincia" class="form-input bg-white" required>
                  <option v-for="p in PROVINCIAS" :key="p">{{ p }}</option>
                </select>
              </CampoForm>
              <CampoForm id="familias" label="Familias profesionales de interés" required :hint="`Puedes seleccionar hasta ${MAX_FAMILIAS_CENTRO} familias`" :error="err('familias')" class="sm:col-span-2">
                <FamiliasSelector id="familias" v-model="d.centro.familias" :opciones="FAMILIAS_FP" :max="MAX_FAMILIAS_CENTRO" />
              </CampoForm>
            </div>
          </template>

          <!-- ── EMPRESA ── -->
          <template v-if="tipo === 'empresa'">
            <h2 class="form-section">Datos de la empresa</h2>
            <div class="grid sm:grid-cols-2 gap-4">
              <CampoForm id="empresa_nombre" label="Nombre de la empresa" required :error="err('empresa_nombre')">
                <input id="empresa_nombre" v-model="d.empresa.empresa_nombre" class="form-input" placeholder="Ej. Tecnología Canaria S.L." required maxlength="160" autocomplete="organization" />
              </CampoForm>
              <CampoForm id="cif" label="CIF" required :error="err('cif')">
                <input id="cif" v-model="d.empresa.cif" class="form-input uppercase" placeholder="B12345678" required maxlength="15" />
              </CampoForm>
              <CampoForm id="sector" label="Sector de actividad" required :error="err('sector')">
                <select id="sector" v-model="d.empresa.sector" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona un sector</option>
                  <option v-for="s in SECTORES" :key="s">{{ s }}</option>
                </select>
              </CampoForm>
              <CampoForm id="provincia" label="Provincia" required :error="err('provincia')">
                <select id="provincia" v-model="d.empresa.provincia" class="form-input bg-white" required>
                  <option v-for="p in PROVINCIAS" :key="p">{{ p }}</option>
                </select>
              </CampoForm>
              <CampoForm id="municipio" label="Municipio" required :error="err('municipio')">
                <select id="municipio" v-model="d.empresa.municipio" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona un municipio</option>
                  <option v-for="m in MUNICIPIOS[d.empresa.provincia]" :key="m">{{ m }}</option>
                </select>
              </CampoForm>
              <CampoForm id="direccion" label="Dirección" required :error="err('direccion')">
                <input id="direccion" v-model="d.empresa.direccion" class="form-input" placeholder="Calle, número, etc." required maxlength="200" autocomplete="street-address" />
              </CampoForm>
              <CampoForm id="tamano" label="Tamaño de la empresa" required :error="err('tamano')">
                <select id="tamano" v-model="d.empresa.tamano" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona el tamaño</option>
                  <option v-for="t in TAMANOS" :key="t.value" :value="t.value">{{ t.label }}</option>
                </select>
              </CampoForm>
              <CampoForm id="colabora" label="¿Colaboras actualmente con centros educativos?" required :error="err('colabora')">
                <select id="colabora" v-model="d.empresa.colabora" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona una opción</option>
                  <option v-for="c in COLABORA" :key="c.value" :value="c.value">{{ c.label }}</option>
                </select>
              </CampoForm>
            </div>
          </template>

          <!-- ── PERSONA DE CONTACTO / TUS DATOS PERSONALES ── -->
          <h2 class="form-section">{{ tipo === 'alumno' ? 'Tus datos personales' : 'Persona de contacto' }}</h2>
          <div class="grid sm:grid-cols-2 gap-4">
            <CampoForm id="nombre" label="Nombre" required :error="err('nombre')">
              <input id="nombre" v-model="persona.nombre" class="form-input" :placeholder="PLACEHOLDER_NOMBRE[tipo]" required maxlength="120" autocomplete="given-name" />
            </CampoForm>
            <CampoForm id="apellidos" label="Apellidos" required :error="err('apellidos')">
              <input id="apellidos" v-model="persona.apellidos" class="form-input" placeholder="Ej. García López" required maxlength="120" autocomplete="family-name" />
            </CampoForm>
          </div>
          <div class="grid gap-4 mt-4" :class="tipo === 'alumno' ? 'sm:grid-cols-[1fr_1fr_160px]' : 'sm:grid-cols-[1.3fr_1fr_1fr]'">
            <CampoForm v-if="tipo !== 'alumno'" id="cargo" :label="LABEL_CARGO[tipo]" required :error="err('cargo')">
              <input id="cargo" v-model="persona.cargo" class="form-input" :placeholder="PLACEHOLDER_CARGO[tipo]" required maxlength="120" autocomplete="organization-title" />
            </CampoForm>
            <CampoForm id="email" label="Email" required :error="err('email')">
              <input id="email" v-model="persona.email" type="email" class="form-input" :placeholder="PLACEHOLDER_EMAIL[tipo]" required maxlength="255" autocomplete="email" />
            </CampoForm>
            <CampoForm id="telefono" label="Teléfono" required :error="err('telefono')">
              <CampoTelefono id="telefono" v-model="persona.telefono" />
            </CampoForm>
            <CampoForm v-if="tipo === 'alumno'" id="fecha_nacimiento" label="Fecha de nacimiento" required :error="err('fecha_nacimiento')">
              <input id="fecha_nacimiento" v-model="d.alumno.fecha_nacimiento" type="date" class="form-input" :max="hoy" required autocomplete="bday" />
            </CampoForm>
          </div>

          <!-- ── ALUMNO: información académica ── -->
          <template v-if="tipo === 'alumno'">
            <h2 class="form-section">Información académica</h2>
            <div class="grid sm:grid-cols-2 gap-4">
              <CampoForm id="centro_educativo" label="Centro educativo" required :error="err('centro_educativo')">
                <input id="centro_educativo" v-model="d.alumno.centro_educativo" class="form-input" placeholder="Ej. IES Sierra Norte" required maxlength="160" />
              </CampoForm>
              <CampoForm id="ciclo" label="Ciclo formativo" required :error="err('ciclo')">
                <input id="ciclo" v-model="d.alumno.ciclo" class="form-input" placeholder="Ej. Desarrollo de Aplicaciones Web" required maxlength="160" />
              </CampoForm>
              <CampoForm id="curso" label="Curso actual" required :error="err('curso')">
                <select id="curso" v-model="d.alumno.curso" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona un curso</option>
                  <option v-for="c in CURSOS" :key="c.value" :value="c.value">{{ c.label }}</option>
                </select>
              </CampoForm>
              <CampoForm id="familia" label="Familia profesional" required :error="err('familia')">
                <select id="familia" v-model="d.alumno.familia" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona la familia profesional</option>
                  <option v-for="f in FAMILIAS_FP" :key="f">{{ f }}</option>
                </select>
              </CampoForm>
            </div>
          </template>

          <!-- ── ADMINISTRACIÓN: datos de la entidad ── -->
          <template v-if="tipo === 'administracion'">
            <h2 class="form-section">Datos de la entidad</h2>
            <div class="grid sm:grid-cols-2 gap-4">
              <CampoForm id="entidad_nombre" label="Nombre de la entidad / organismo" required :error="err('entidad_nombre')">
                <input id="entidad_nombre" v-model="d.administracion.entidad_nombre" class="form-input" placeholder="Ej. Consejería de Educación del Gobierno de Canarias" required maxlength="160" autocomplete="organization" />
              </CampoForm>
              <CampoForm id="cif" label="CIF" required :error="err('cif')">
                <input id="cif" v-model="d.administracion.cif" class="form-input uppercase" placeholder="P3500000X" required maxlength="15" />
              </CampoForm>
              <CampoForm id="tipo_entidad" label="Tipo de entidad" required :error="err('tipo_entidad')">
                <select id="tipo_entidad" v-model="d.administracion.tipo_entidad" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona una opción</option>
                  <option v-for="t in TIPOS_ENTIDAD" :key="t.value" :value="t.value">{{ t.label }}</option>
                </select>
              </CampoForm>
              <CampoForm id="ambito" label="Ámbito territorial" required :error="err('ambito')">
                <select id="ambito" v-model="d.administracion.ambito" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona un ámbito</option>
                  <option v-for="a in AMBITOS" :key="a.value" :value="a.value">{{ a.label }}</option>
                </select>
              </CampoForm>
            </div>
            <div class="grid sm:grid-cols-[1.3fr_1fr_1fr] gap-4 mt-4">
              <CampoForm id="direccion" label="Dirección" required :error="err('direccion')">
                <input id="direccion" v-model="d.administracion.direccion" class="form-input" placeholder="Calle, número, etc." required maxlength="200" autocomplete="street-address" />
              </CampoForm>
              <CampoForm id="municipio" label="Municipio" required :error="err('municipio')">
                <select id="municipio" v-model="d.administracion.municipio" class="form-input bg-white" required>
                  <option value="" disabled>Selecciona un municipio</option>
                  <option v-for="m in MUNICIPIOS[d.administracion.provincia]" :key="m">{{ m }}</option>
                </select>
              </CampoForm>
              <CampoForm id="provincia" label="Provincia" required :error="err('provincia')">
                <select id="provincia" v-model="d.administracion.provincia" class="form-input bg-white" required>
                  <option v-for="p in PROVINCIAS" :key="p">{{ p }}</option>
                </select>
              </CampoForm>
            </div>
          </template>

          <!-- ── INTERESES + MENSAJE (empresa, alumno, administración) ── -->
          <template v-if="tipo !== 'centro'">
            <div class="mt-7 rounded-xl p-5" :class="tipo === 'empresa' ? 'bg-empresas/5 border border-empresas/15' : ''">
              <h2 class="font-heading font-bold text-azul-noche" :class="tipo === 'empresa' ? '' : 'text-base'">{{ TITULO_INTERESES[tipo] }}</h2>
              <p class="text-xs text-gray-500 mt-0.5 mb-3">{{ tipo === 'empresa' ? 'Selecciona las opciones que te interesan:' : 'Puedes seleccionar varias opciones.' }}</p>
              <InteresesSelector v-model="d[tipo].intereses" :opciones="INTERESES[tipo]"
                                 :variante="tipo === 'empresa' ? 'check' : 'tarjetas'" :color-icono="agente.text" />
              <CampoForm id="mensaje" :label="LABEL_MENSAJE[tipo]" :error="err('mensaje')" class="mt-4">
                <textarea id="mensaje" v-model="d[tipo].mensaje" rows="2" maxlength="2000" class="form-input resize-y" :placeholder="PLACEHOLDER_MENSAJE[tipo]" />
              </CampoForm>
            </div>
          </template>

          <!-- Privacidad -->
          <div class="flex items-start gap-3 rounded-xl bg-primary-50 px-4 py-3 mt-6">
            <LockClosedIcon class="w-5 h-5 text-primary-600 shrink-0 mt-0.5" />
            <p class="text-xs text-gray-600 leading-relaxed">
              Tus datos serán tratados de forma confidencial y únicamente para gestionar tu solicitud.
              <!-- PENDIENTE: enlazar cuando exista la página de Política de privacidad -->
              <span class="text-primary-700 font-semibold">Consulta nuestra Política de privacidad.</span>
            </p>
          </div>

          <p v-if="errorGeneral" class="text-sm text-red-600 mt-4" role="alert">{{ errorGeneral }}</p>

          <!-- Acciones -->
          <div class="grid sm:grid-cols-3 gap-3 mt-6">
            <button type="submit" class="btn-pill bg-alumnos hover:bg-alumnos/90 !text-xs !px-4 disabled:opacity-60" :disabled="enviando" @click="accion = 'registro'">
              <UserPlusIcon class="w-4 h-4 shrink-0" /> {{ agente.registro }} <ArrowRightIcon class="w-4 h-4 shrink-0" />
            </button>
            <button type="submit" class="btn-pill-outline !text-xs !px-4 disabled:opacity-60" :disabled="enviando" @click="accion = 'info'">
              <InformationCircleIcon class="w-4 h-4 shrink-0" /> Solicitar más info
            </button>
            <button type="submit" class="btn-pill bg-primary-600 hover:bg-primary-700 !text-xs !px-4 disabled:opacity-60" :disabled="enviando" @click="accion = 'demo'">
              <PlayIcon class="w-4 h-4 shrink-0" /> Solicitar demo
            </button>
          </div>
          <p v-if="enviando" class="text-xs text-gray-400 text-center mt-3">Enviando…</p>
        </form>
      </div>
    </div>
  </section>

  <!-- "Agenda una reunión": vuelve al formulario de arriba -->
  <CtaTransforma @agendar="agendarReunion" />
</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import {
  CheckCircleIcon, LockClosedIcon, UserPlusIcon, ArrowRightIcon, InformationCircleIcon, PlayIcon,
} from '@heroicons/vue/24/outline'
import api, { ensureCsrfCookie } from '@/services/api'
import ContactoHero from '@/components/contacto/ContactoHero.vue'
import CtaTransforma from '@/components/common/CtaTransforma.vue'
import ContactoStepper from '@/components/contacto/ContactoStepper.vue'
import CampoForm from '@/components/contacto/CampoForm.vue'
import CampoTelefono from '@/components/contacto/CampoTelefono.vue'
import FamiliasSelector from '@/components/contacto/FamiliasSelector.vue'
import InteresesSelector from '@/components/contacto/InteresesSelector.vue'
import { AGENTES } from '@/components/contacto/contactoConfig'
import {
  PROVINCIAS, MUNICIPIOS, FAMILIAS_FP, MAX_FAMILIAS_CENTRO, SECTORES, TAMANOS, COLABORA,
  CURSOS, TIPOS_ENTIDAD, AMBITOS, INTERESES,
} from '@/data/contacto'

const route = useRoute()
const router = useRouter()

// ── Textos que cambian por agente ─────────────────────────────────────────────
const LABEL_CARGO = { centro: 'Cargo en el centro', empresa: 'Cargo en la empresa', administracion: 'Cargo' }
const PLACEHOLDER_CARGO = {
  centro: 'Ej. Dirección, Jefatura de Estudios, Coordinación de FP…',
  empresa: 'Ej. Responsable de RR. HH., Dirección…',
  administracion: 'Ej. Técnico/a de Formación, Responsable de Programa…',
}
const PLACEHOLDER_NOMBRE = { centro: 'Ej. María', empresa: 'Ej. Laura', alumno: 'Ej. María', administracion: 'Ej. Ana' }
const PLACEHOLDER_EMAIL = {
  centro: 'nombre@centroeducativo.es', empresa: 'nombre@empresa.es', alumno: 'tuemail@ejemplo.com', administracion: 'nombre@entidad.es',
}
const TITULO_INTERESES = { empresa: 'Tu interés en DuaLab', alumno: '¿Qué te interesa en DuaLab?', administracion: '¿En qué podemos ayudarte?' }
const LABEL_MENSAJE = {
  empresa: 'Cuéntanos brevemente tus objetivos o cómo te gustaría colaborar',
  alumno: 'Cuéntanos brevemente tus objetivos o qué te gustaría conseguir con DuaLab',
  administracion: 'Cuéntanos más sobre tus objetivos o necesidades',
}
const PLACEHOLDER_MENSAJE = {
  empresa: 'Ej. Nos gustaría plantear un reto sobre…',
  alumno: 'Ej. Quiero realizar prácticas en empresas del sector tecnológico…',
  administracion: 'Ej. Estamos interesados en conocer cómo DuaLab puede apoyar la gestión de nuestro programa de FP Dual…',
}
const MENSAJES_EXITO = {
  registro: 'Gracias por registrarte. Revisaremos tus datos y te escribiremos para completar el alta.',
  info: 'Hemos recibido tu solicitud. Te enviaremos más información muy pronto.',
  demo: 'Hemos recibido tu solicitud. Nos pondremos en contacto contigo para agendar la demo.',
}

// ── Tipo de agente (por defecto, centro educativo) ──────────────────────────────
// Solo agentes disponibles (no bloqueados); cualquier otro valor → centro.
const tipoValido = (t) => (AGENTES[t] && !AGENTES[t].bloqueado ? t : null)
const tipo = ref(tipoValido(route.query.tipo) ?? 'centro')
const agente = computed(() => AGENTES[tipo.value])

function cambiarTipo(t) {
  if (!tipoValido(t)) return
  tipo.value = t
  errores.value = {}
  errorGeneral.value = ''
  router.replace({ query: { ...route.query, tipo: t } })
}
watch(() => route.query.tipo, (t) => { tipo.value = tipoValido(t) ?? 'centro' })

// ── Estado del formulario: persona común + datos propios por agente ───────────────
// Separados por agente para no perder lo escrito al cambiar de pestaña.
function estadoInicial() {
  return {
    persona: { nombre: '', apellidos: '', cargo: '', email: '', telefono: '' },
    d: {
      centro: { centro_nombre: '', direccion: '', municipio: '', provincia: 'Santa Cruz de Tenerife', familias: [] },
      empresa: { empresa_nombre: '', cif: '', sector: '', provincia: 'Santa Cruz de Tenerife', municipio: '', direccion: '', tamano: '', colabora: '', intereses: [], mensaje: '' },
      alumno: { fecha_nacimiento: '', centro_educativo: '', ciclo: '', curso: '', familia: '', intereses: [], mensaje: '' },
      administracion: { entidad_nombre: '', cif: '', tipo_entidad: '', ambito: '', direccion: '', municipio: '', provincia: 'Las Palmas', intereses: [], mensaje: '' },
    },
  }
}
const inicial = estadoInicial()
const persona = reactive(inicial.persona)
const d = reactive(inicial.d)

// Al cambiar de provincia, el municipio elegido deja de ser válido
for (const t of ['centro', 'empresa', 'administracion']) {
  watch(() => d[t].provincia, (p) => {
    if (!MUNICIPIOS[p]?.includes(d[t].municipio)) d[t].municipio = ''
  })
}

const hoy = new Date().toISOString().slice(0, 10)

// ── Pasos completados (solo indicativo; la validación real es del backend) ─────────
const lleno = (...vals) => vals.every((v) => (Array.isArray(v) ? v.length > 0 : String(v ?? '').trim() !== ''))

const completados = computed(() => {
  const t = tipo.value
  const p = persona
  const datosOk = t === 'alumno'
    ? lleno(p.nombre, p.apellidos, p.email, p.telefono, d.alumno.fecha_nacimiento)
    : lleno(p.nombre, p.apellidos, p.cargo, p.email, p.telefono)
  const x = d[t]
  const seccionOk = {
    centro: () => lleno(x.centro_nombre, x.direccion, x.municipio, x.provincia, x.familias),
    empresa: () => lleno(x.empresa_nombre, x.cif, x.sector, x.provincia, x.municipio, x.direccion, x.tamano, x.colabora),
    alumno: () => lleno(x.centro_educativo, x.ciclo, x.curso, x.familia),
    administracion: () => lleno(x.entidad_nombre, x.cif, x.tipo_entidad, x.ambito, x.direccion, x.municipio, x.provincia),
  }[t]()
  const pasos = [true, datosOk, seccionOk]
  if (t === 'alumno' || t === 'administracion') pasos.push(x.intereses.length > 0 || lleno(x.mensaje))
  pasos.push(enviado.value)
  return pasos
})

// ── Envío ──────────────────────────────────────────────────────────────────────
const accion = ref('info')
const honeypot = ref('')
const enviando = ref(false)
const enviado = ref(false)
const errores = ref({})
const errorGeneral = ref('')

const err = (campo) => errores.value[campo]

async function enviar(e) {
  errores.value = {}
  errorGeneral.value = ''

  // Validación nativa del navegador (required, type=email, pattern…)
  if (!e.target.reportValidity()) return
  if (tipo.value === 'centro' && !d.centro.familias.length) {
    errores.value = { familias: 'Selecciona al menos una familia profesional.' }
    return
  }

  const payload = {
    tipo: tipo.value,
    accion: accion.value,
    nombre: persona.nombre,
    apellidos: persona.apellidos,
    email: persona.email,
    telefono: `+34 ${persona.telefono.trim()}`,
    ...(tipo.value !== 'alumno' && { cargo: persona.cargo }),
    ...d[tipo.value],
    website: honeypot.value,
  }

  enviando.value = true
  try {
    await ensureCsrfCookie()
    await api.post('/contacto', payload)
    enviado.value = true
  } catch (error) {
    if (error.response?.status === 422) {
      const errs = error.response.data?.errors ?? {}
      // "familias.0" → "familias", "intereses.2" → "intereses"
      errores.value = Object.fromEntries(Object.entries(errs).map(([k, v]) => [k.split('.')[0], v[0]]))
      errorGeneral.value = 'Revisa los campos marcados.'
    } else if (error.response?.status === 429) {
      errorGeneral.value = 'Has enviado demasiadas solicitudes. Inténtalo de nuevo en un minuto.'
    } else {
      errorGeneral.value = 'No hemos podido enviar tu solicitud. Inténtalo de nuevo más tarde.'
    }
  } finally {
    enviando.value = false
  }
}

const seccionForm = ref(null)
function agendarReunion() {
  seccionForm.value?.scrollIntoView({ behavior: 'smooth' })
}

function reiniciar() {
  const nuevo = estadoInicial()
  Object.assign(persona, nuevo.persona)
  for (const t of Object.keys(d)) Object.assign(d[t], nuevo.d[t])
  enviado.value = false
  accion.value = 'info'
}
</script>

<style scoped>
.form-section {
  @apply font-heading font-bold text-azul-noche mt-7 mb-3;
}
</style>
