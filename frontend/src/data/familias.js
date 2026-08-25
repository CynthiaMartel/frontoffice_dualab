// Familias profesionales, hardcodeadas para que /familias funcione sin depender del backend.
// Mismo contenido que database/seeders/DatabaseSeeder.php (Familia::create), para que el
// frontoffice muestre siempre estas 3 familias aunque la API no esté disponible.

export const familias = [
  {
    nombre: 'Administración y Gestión',
    slug: 'administracion-gestion',
    descripcion: 'Retos de gestión empresarial, administración y recursos humanos',
    color_hex: '#92400e',
  },
  {
    nombre: 'Comercio y Marketing',
    slug: 'comercio-marketing',
    descripcion: 'Retos de ventas, marketing digital y gestión comercial',
    color_hex: '#ea580c',
  },
  {
    nombre: 'Informática y Comunicaciones',
    slug: 'informatica-comunicaciones',
    descripcion: 'Retos de programación, desarrollo y tecnologías de la información',
    color_hex: '#1d4ed8',
  },
]

export function familiaPorSlug(slug) {
  return familias.find((f) => f.slug === slug) ?? null
}
