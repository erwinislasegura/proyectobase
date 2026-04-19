INSERT INTO permisos (id, nombre, slug, modulo, descripcion, created_at, updated_at) VALUES
(10,'Gestionar empresa','gestionar_empresa','empresa','Permite visualizar la configuración de la empresa',NOW(),NOW()),
(11,'Editar empresa','editar_empresa','empresa','Permite actualizar los datos de la empresa',NOW(),NOW());

INSERT INTO rol_permiso (rol_id, permiso_id, created_at) VALUES
(2,10,NOW()),(2,11,NOW()),
(3,10,NOW());
