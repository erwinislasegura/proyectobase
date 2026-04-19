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
