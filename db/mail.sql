use administracion_colegio;
CREATE TABLE IF NOT EXISTS configuracion (
    correo VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL
);

INSERT INTO `configuracion` (`correo`, `clave`) VALUES ('mija@gmail.com', 'aaa');