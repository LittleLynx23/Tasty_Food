

CREATE TABLE rol (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB;

CREATE TABLE insumo (
    id_insumo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    unidad_medida VARCHAR(20) NOT NULL,
    stock_minimo DECIMAL(10,2) NOT NULL,
    precio_base DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    id_categoria INT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE inventario (
    id_inventario INT AUTO_INCREMENT PRIMARY KEY,
    cantidad_actual DECIMAL(10,2) NOT NULL DEFAULT 0,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_insumo INT NOT NULL UNIQUE
) ENGINE=InnoDB;

-- DROP DATABASE IF EXISTS tasty_food_db;
-- CREATE DATABASE IF NOT EXISTS tasty_food_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- USE tasty_food_db;
CREATE TABLE solicitud_reposicion (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50) NOT NULL DEFAULT 'Pendiente',
    total_solicitud DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    observacion TEXT,
    id_usuario INT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE detalle_solicitud (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    cantidad_solicitada DECIMAL(10,2) NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    subtotal DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    observacion TEXT,
    id_solicitud INT NOT NULL,
    id_insumo INT NOT NULL
) ENGINE=InnoDB;



ALTER TABLE usuario 
ADD CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol) REFERENCES rol(id_rol) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE insumo 
ADD CONSTRAINT fk_insumo_categoria FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE inventario 
ADD CONSTRAINT fk_inventario_insumo FOREIGN KEY (id_insumo) REFERENCES insumo(id_insumo) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE solicitud_reposicion 
ADD CONSTRAINT fk_solicitud_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE detalle_solicitud 
ADD CONSTRAINT fk_detalle_solicitud FOREIGN KEY (id_solicitud) REFERENCES solicitud_reposicion(id_solicitud) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detalle_solicitud 
ADD CONSTRAINT fk_detalle_insumo FOREIGN KEY (id_insumo) REFERENCES insumo(id_insumo) ON DELETE RESTRICT ON UPDATE CASCADE;



INSERT INTO rol (nombre_rol, descripcion) VALUES 
('Administrador', 'Supervisa inventario, gestiona usuarios y consulta reportes'),
('Usuario Operativo', 'Registra insumos, actualiza existencias y crea solicitudes');


INSERT INTO usuario (nombre, apellido, correo, contrasena, id_rol) VALUES 
('Admin', 'Principal', 'admin@tastyfood.com', 'admin123', 1);


INSERT INTO categoria (nombre_categoria, descripcion) VALUES 
('Proteínas', 'Carnes de res, pollo, cerdo, chorizos, etc.'),              
('Lácteos', 'Quesos de todo tipo y leche'),                              
('Verduras y Hortalizas', 'Vegetales frescos para preparación'),        
('Frutas', 'Frutas para jugos y salsas'),                                  
('Panadería y Bases', 'Panes, arepas, patacones'),                                                                       
('Empaques', 'Cajas, vasos, servilletas y bolsas');                       


INSERT INTO insumo (nombre, descripcion, unidad_medida, stock_minimo, precio_base, id_categoria) VALUES 
('Carne de res', 'Carne para hamburguesa 150g', 'Unidad', 50, 3500.00, 1),
('Queso fundido', 'Tajadas de queso para hamburguesa', 'Unidad', 100, 800.00, 2),
('Lechuga', 'Lechuga batavia fresca', 'Gramos', 2000, 15.00, 3),
('Pan de hamburguesa', 'Pan con ajonjolí', 'Unidad', 60, 1200.00, 4),
('Cajas para hamburguesa', 'Caja de cartón contramarcada', 'Unidad', 200, 500.00, 5);