USE proyectobase;

INSERT INTO roles (id, nombre, slug, descripcion, estado, created_at, updated_at) VALUES
(1, 'Administrador', 'administrador', 'Acceso total al sistema', 'activo', NOW(), NOW()),
(2, 'Supervisor', 'supervisor', 'Acceso de supervisión', 'activo', NOW(), NOW()),
(3, 'Colaborador', 'colaborador', 'Acceso básico', 'activo', NOW(), NOW());

INSERT INTO permisos (id, nombre, slug, modulo, descripcion, created_at, updated_at) VALUES
(1,'Ver dashboard','ver_dashboard','dashboard','Permite visualizar el panel principal',NOW(),NOW()),
(2,'Gestionar roles','gestionar_roles','roles','Permite listar roles',NOW(),NOW()),
(3,'Crear roles','crear_roles','roles','Permite crear roles',NOW(),NOW()),
(4,'Editar roles','editar_roles','roles','Permite editar roles',NOW(),NOW()),
(5,'Eliminar roles','eliminar_roles','roles','Permite eliminar roles',NOW(),NOW()),
(6,'Gestionar usuarios','gestionar_usuarios','usuarios','Permite listar usuarios',NOW(),NOW()),
(7,'Crear usuarios','crear_usuarios','usuarios','Permite crear usuarios',NOW(),NOW()),
(8,'Editar usuarios','editar_usuarios','usuarios','Permite editar usuarios',NOW(),NOW()),
(9,'Eliminar usuarios','eliminar_usuarios','usuarios','Permite eliminar usuarios',NOW(),NOW());

INSERT INTO rol_permiso (rol_id, permiso_id, created_at)
SELECT 1, p.id, NOW() FROM permisos p;

INSERT INTO rol_permiso (rol_id, permiso_id, created_at) VALUES
(2,1,NOW()),(2,6,NOW()),(2,8,NOW()),
(3,1,NOW());

INSERT INTO usuarios (nombres, apellidos, correo, telefono, username, password, foto_perfil, rol_id, estado, ultimo_acceso, created_at, updated_at)
VALUES ('Administrador', 'Principal', 'admin@admin.com', NULL, 'admin', '$2y$12$ezJv4RyjDgputnGrrX5tgeSeS9YsUZ9Xz7RrrfiNpMTP0QZ/suD.K', NULL, 1, 'activo', NULL, NOW(), NOW());
