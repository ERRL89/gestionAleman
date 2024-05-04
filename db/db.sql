CREATE TABLE colaboradores (
    id_colaborador INT NOT NULL AUTO_INCREMENT,
    usuario INT DEFAULT NULL,
    nombre VARCHAR(100) DEFAULT NULL,
    puesto INT DEFAULT NULL,
    rango VARCHAR(100) DEFAULT NULL,
    ruta_foto TEXT DEFAULT NULL,
    estatus INT DEFAULT 1,
    sucursal INT DEFAULT NULL,
    PRIMARY KEY (id_colaborador),
    FOREIGN KEY (usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (puesto) REFERENCES puestos(id_puesto),
    FOREIGN KEY (sucursal) REFERENCES sucursales(id_sucursal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE puestos (
    id_puesto INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (id_puesto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE sucursales (
    id_sucursal INT(11) NOT NULL AUTO_INCREMENT,
    nombre_sucursal VARCHAR(30) DEFAULT NULL,
    direccion_sucursal VARCHAR(100) DEFAULT NULL,
    PRIMARY KEY (id_sucursal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `sucursales` (`id_sucursal`, `nombre_sucursal`, `direccion_sucursal`) VALUES
(1, 'CDMX', 'C. de Francisco Díaz Covarrubias 3, San Rafael, Cuauhtémoc, 06470 Ciudad de México, CDMX'),
(2, 'Cancún', 'Rcda. De Las Chachalacas, Alfredo V. Bonfil, Cancún; Quintana Roo C.P. 77560'),
(3, 'Guadalajara', 'Av. Periferico Sur 1619, Artesanos, San Pedro Tlaquepaque; Jalisco C.P. 45598');

CREATE TABLE usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) DEFAULT NULL,
    pass VARCHAR(50) DEFAULT NULL,
    email VARCHAR(50) DEFAULT NULL,
    estatus INT DEFAULT 1,
    PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE servicios (
id_servicio INT(11) NOT NULL AUTO_INCREMENT,
servicio VARCHAR(100),
nombre_servicio VARCHAR(50),
num_personas INT(11),
tipo_servicio VARCHAR(100),
costo INT(11),
PRIMARY KEY (id_servicio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


