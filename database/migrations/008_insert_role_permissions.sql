INSERT INTO rol_permiso (rol_id, permiso_id, created_at)
SELECT 1, p.id, NOW() FROM permisos p;

INSERT INTO rol_permiso (rol_id, permiso_id, created_at) VALUES
(2,1,NOW()),(2,6,NOW()),(2,8,NOW()),(2,10,NOW()),(2,11,NOW()),
(3,1,NOW()),(3,10,NOW());
