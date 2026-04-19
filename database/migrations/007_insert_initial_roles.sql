INSERT INTO roles (id, nombre, slug, descripcion, estado, created_at, updated_at) VALUES
(1, 'Administrador', 'administrador', 'Acceso total al sistema', 'activo', NOW(), NOW()),
(2, 'Supervisor', 'supervisor', 'Acceso de supervisión', 'activo', NOW(), NOW()),
(3, 'Colaborador', 'colaborador', 'Acceso básico', 'activo', NOW(), NOW());
