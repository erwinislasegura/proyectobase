CREATE DATABASE IF NOT EXISTS proyectobase CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE proyectobase;

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  slug VARCHAR(100) NOT NULL UNIQUE,
  descripcion TEXT NULL,
  estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
) ENGINE=InnoDB;

CREATE TABLE permisos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE,
  modulo VARCHAR(100) NOT NULL,
  descripcion TEXT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  INDEX idx_permisos_modulo (modulo)
) ENGINE=InnoDB;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombres VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  correo VARCHAR(150) NOT NULL UNIQUE,
  telefono VARCHAR(30) NULL,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  foto_perfil VARCHAR(255) NULL,
  rol_id INT NOT NULL,
  estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',
  ultimo_acceso DATETIME NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  INDEX idx_usuarios_rol_id (rol_id),
  CONSTRAINT fk_usuarios_roles FOREIGN KEY (rol_id) REFERENCES roles(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE rol_permiso (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rol_id INT NOT NULL,
  permiso_id INT NOT NULL,
  created_at DATETIME NULL,
  UNIQUE KEY ux_rol_permiso (rol_id, permiso_id),
  INDEX idx_rp_permiso_id (permiso_id),
  CONSTRAINT fk_rp_rol FOREIGN KEY (rol_id) REFERENCES roles(id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_rp_permiso FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE logs_acceso (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  accion VARCHAR(255) NOT NULL,
  detalle TEXT NULL,
  ip VARCHAR(50) NULL,
  user_agent TEXT NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_logs_usuario_id (usuario_id),
  CONSTRAINT fk_logs_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

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
