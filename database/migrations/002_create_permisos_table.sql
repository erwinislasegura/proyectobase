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
