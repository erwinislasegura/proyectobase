ALTER TABLE configuracion_empresa
  ADD COLUMN logo_color_url VARCHAR(255) NULL AFTER moneda,
  ADD COLUMN logo_blanco_url VARCHAR(255) NULL AFTER logo_color_url,
  ADD COLUMN imap_host VARCHAR(180) NULL AFTER logo_blanco_url,
  ADD COLUMN imap_puerto INT NOT NULL DEFAULT 993 AFTER imap_host,
  ADD COLUMN imap_cifrado VARCHAR(20) NOT NULL DEFAULT 'ssl' AFTER imap_puerto,
  ADD COLUMN imap_usuario VARCHAR(180) NULL AFTER imap_cifrado,
  ADD COLUMN imap_password VARCHAR(255) NULL AFTER imap_usuario,
  ADD COLUMN imap_remitente_nombre VARCHAR(150) NULL AFTER imap_password,
  ADD COLUMN imap_remitente_correo VARCHAR(180) NULL AFTER imap_remitente_nombre;
