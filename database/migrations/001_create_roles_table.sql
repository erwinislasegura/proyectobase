CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  slug VARCHAR(100) NOT NULL UNIQUE,
  descripcion TEXT NULL,
  estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
) ENGINE=InnoDB;
