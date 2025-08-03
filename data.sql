-- Crear base de datos
CREATE DATABASE IF NOT EXISTS db_panaderia;
USE db_panaderia;

-- Tabla: categorias (panadería, abarrotes, etc.)
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Tabla: productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    categoria_id INT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Insertar categorías por defecto
INSERT INTO categorias (nombre) VALUES 
('Panadería'),
('Abarrotes');

-- Insertar algunos productos de ejemplo
INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id) VALUES
('Pan de Molde', 'Pan de molde 500 gr', 45.00, 10, 1),
('Leche Entera', 'Leche en caja 1L', 6.50, 25, 2),
('Galletas Integrales', 'Paquete de 200 gr', 8.90, 15, 2),
('Pan Frances', 'Pan individual fresco', 1.50, 50, 1);