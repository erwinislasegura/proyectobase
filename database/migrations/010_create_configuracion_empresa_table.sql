CREATE TABLE configuracion_empresa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  razon_social VARCHAR(180) NULL,
  ruc VARCHAR(50) NULL,
  correo VARCHAR(150) NULL,
  telefono VARCHAR(30) NULL,
  direccion VARCHAR(255) NULL,
  ciudad VARCHAR(100) NULL,
  pais VARCHAR(100) NULL,
  sitio_web VARCHAR(180) NULL,
  moneda VARCHAR(10) NOT NULL DEFAULT 'USD',
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
) ENGINE=InnoDB;

INSERT INTO configuracion_empresa (nombre, razon_social, ruc, correo, telefono, direccion, ciudad, pais, sitio_web, moneda, created_at, updated_at)
VALUES ('Mi Empresa', 'Mi Empresa S.A.S.', '', 'info@empresa.com', '', '', '', '', '', 'USD', NOW(), NOW());
