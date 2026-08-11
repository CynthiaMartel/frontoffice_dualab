# Microretos Académicos — Setup

## Estructura del proyecto

```
microretos/
├── backend/   → Laravel 11 (API REST + Sanctum)
└── frontend/  → Vue 3 SPA (Vite + Tailwind CSS)
```

---

## Backend — Laravel 11

### Requisitos
- PHP 8.2+
- Composer
- MySQL 8 / PostgreSQL 15

### Instalación

```bash
cd backend

# 1. Instalar dependencias
composer install

# 2. Configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Ajusta DB_DATABASE, DB_USERNAME, DB_PASSWORD en .env

# 3.1 Levantar MySQL local vía Docker (OrbStack u otro engine)
docker compose up -d

# 4. Migraciones + seeders
php artisan migrate --seed

# 5. Instalar Sanctum (si no está)
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# 6. Levantar servidor
php artisan serve          # http://localhost:8000
```

### Stack backend
| Capa | Tecnología |
|------|-----------|
| Framework | Laravel 11 |
| Auth | Laravel Sanctum (token Bearer) |
| DB | MySQL (configurable) |
| CORS | `fruitcake/laravel-cors` (incluido en Laravel) |

### Puertos de infraestructura local

Si trabajas con varios proyectos Laravel en paralelo, cada uno debe usar un puerto de MySQL distinto para no chocar. Puertos ya asignados en esta máquina:

| Puerto | Servicio | Proyecto |
|--------|----------|----------|
| `3306` | MySQL (Homebrew, nativo) | — |
| `3307` | MySQL (Docker) | `microretos` |
| `3308` | MySQL (Docker, `docker-compose.yml` de `backend/`) | `dualab_proyecto` (este repo) |

El `docker-compose.yml` de este proyecto usa `name: dualab_proyecto` para que sus contenedores, red y volumen queden identificados bajo ese nombre (`dualab_proyecto-mysql`, `dualab_proyecto_default`, etc.) y no se confundan con otros proyectos.

### Endpoints principales

| Método | Ruta | Auth | Descripción |
|--------|------|------|-------------|
| POST | `/api/auth/register` | — | Registro |
| POST | `/api/auth/login` | — | Login → devuelve token |
| POST | `/api/auth/logout` | ✓ | Cierra sesión |
| GET | `/api/auth/me` | ✓ | Usuario actual |
| GET | `/api/familias` | — | Listado de familias |
| GET | `/api/familias/{slug}` | — | Familia + retos |
| GET | `/api/retos` | — | Todos los retos (con filtros) |
| GET | `/api/retos/{id}` | — | Detalle de reto |
| POST | `/api/retos/{id}/inscribirse` | ✓ | Inscribirse en un reto |
| GET | `/api/mis-inscripciones` | ✓ | Mis retos |
| POST | `/api/contacto` | — | Formulario de contacto |

---

## Frontend — Vue 3 SPA

### Requisitos
- Node.js 20+
- npm / pnpm

### Instalación

```bash
cd frontend

# 1. Instalar dependencias
npm install

# 2. Configurar entorno
cp .env.example .env
# VITE_API_URL=http://localhost:8001/api

# 3. Servidor de desarrollo
npm run dev     # http://localhost:5173

# 4. Build producción
npm run build
```

### Stack frontend
| Capa | Tecnología |
|------|-----------|
| Framework | Vue 3 (Composition API) |
| Router | Vue Router 4 |
| Estado | Pinia |
| Estilos | Tailwind CSS 3 |
| HTTP | Axios |
| Build | Vite 5 |

### Vistas / Rutas SPA

| Ruta | Vista | Auth |
|------|-------|------|
| `/` | Home (landing) | — |
| `/familias` | Catálogo de familias | — |
| `/familias/:slug` | Detalle familia + retos | — |
| `/retos/:id` | Detalle de reto | — |
| `/login` | Formulario login | Solo invitados |
| `/register` | Formulario registro | Solo invitados |
| `/dashboard` | Panel del alumno | ✓ Requerida |

---

## Roles de usuario

| Rol | Descripción |
|-----|-------------|
| `alumno` | Puede explorar e inscribirse en retos |
| `empresa` | Puede crear y gestionar retos |
| `centro` | Puede ver el progreso de sus alumnos |
| `admin` | Acceso completo |

---

## Despliegue rápido

```bash
# Backend en producción (Laravel Forge / Ploi / VPS)
php artisan config:cache
php artisan route:cache
php artisan migrate --force

# Frontend en producción (Vercel / Netlify / S3)
npm run build
# Subir dist/ a tu hosting estático
# Configurar redirects: /* → /index.html
```
