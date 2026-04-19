# ProyectoBase - Panel administrativo MVC (PHP + MySQL)

Sistema web en **PHP 8+** con arquitectura **MVC propia**, autenticación, control de permisos por rol, dashboard con gráficas, y módulos de gestión de roles y usuarios.

## Requisitos

- PHP 8.1+
- MySQL 8+ / MariaDB 10.5+
- Extensión PDO MySQL habilitada
- Servidor web local (Apache/Nginx) o `php -S`

## Configuración

1. Copia variables de entorno:
   ```bash
   cp .env.example .env
   ```
2. Ajusta credenciales de base de datos en `.env`.

## Instalación de base de datos inicial

### Opción rápida (schema + seeds)

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seeds.sql
```

## Ejecución por migraciones (orden recomendado)

Ejecuta en este orden:

1. `database/migrations/001_create_roles_table.sql`
2. `database/migrations/002_create_permisos_table.sql`
3. `database/migrations/003_create_usuarios_table.sql`
4. `database/migrations/004_create_rol_permiso_table.sql`
5. `database/migrations/005_create_logs_acceso_table.sql`
6. `database/migrations/006_insert_initial_permissions.sql`
7. `database/migrations/007_insert_initial_roles.sql`
8. `database/migrations/008_insert_role_permissions.sql`
9. `database/migrations/009_insert_admin_user.sql`
10. `database/migrations/010_create_configuracion_empresa_table.sql`
11. `database/migrations/011_insert_empresa_permissions.sql`

Ejemplo:

```bash
mysql -u root -p proyectobase < database/migrations/001_create_roles_table.sql
```

## Usuario administrador inicial

- **Correo:** `admin@admin.com`
- **Username:** `admin`
- **Contraseña:** `Admin123*`
- **Rol:** Administrador (acceso total)

> La contraseña se almacena con `password_hash` (bcrypt) en SQL seed/migración.

## Ejecución local

```bash
php -S localhost:8000
```

Luego abre: `http://localhost:8000/login`

## Estructura

- `app/core`: Router, Controller y Model base
- `app/controllers`: Auth, Dashboard, Roles, Usuarios
- `app/models`: acceso a datos por entidad
- `app/views`: layouts y vistas por módulo
- `database/schema.sql`: esquema final sincronizado
- `database/seeds.sql`: datos iniciales
- `database/migrations`: scripts SQL secuenciales
- `public/assets`: CSS/JS del frontend

## Seguridad implementada

- PDO + prepared statements
- Sesiones seguras
- CSRF token en formularios
- `password_hash` / `password_verify`
- Control de acceso por autenticación y permisos

## Sincronización código + base de datos

Regla aplicada en este proyecto:

- Todo cambio estructural va en:
  - modelo/controlador/vista afectados
  - `database/schema.sql`
  - nuevo script en `database/migrations`
  - `database/seeds.sql` si cambia dato base inicial

Esto garantiza trazabilidad y despliegue controlado a producción.
