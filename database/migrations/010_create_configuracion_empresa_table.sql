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
  logo_color_url VARCHAR(255) NULL,
  logo_blanco_url VARCHAR(255) NULL,
  imap_host VARCHAR(180) NULL,
  imap_puerto INT NOT NULL DEFAULT 993,
  imap_cifrado VARCHAR(20) NOT NULL DEFAULT 'ssl',
  imap_usuario VARCHAR(180) NULL,
  imap_password VARCHAR(255) NULL,
  imap_remitente_nombre VARCHAR(150) NULL,
  imap_remitente_correo VARCHAR(180) NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
) ENGINE=InnoDB;

INSERT INTO configuracion_empresa (nombre, razon_social, ruc, correo, telefono, direccion, ciudad, pais, sitio_web, moneda, logo_color_url, logo_blanco_url, imap_host, imap_puerto, imap_cifrado, imap_usuario, imap_password, imap_remitente_nombre, imap_remitente_correo, created_at, updated_at)
VALUES ('Mi Empresa', 'Mi Empresa S.A.S.', '', 'info@empresa.com', '', '', '', '', '', 'USD', '', '', '', 993, 'ssl', '', '', '', '', NOW(), NOW());
