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
