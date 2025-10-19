-- Crear la tabla de productos en español
CREATE TABLE productoses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- Crear la tabla de productos en inglés
CREATE TABLE productosen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- Insertar productos en español
INSERT INTO productoses (nombre, descripcion, precio) VALUES
('Camiseta', 'Camiseta de algodón 100%', 15.99),
('Pantalones', 'Pantalones de mezclilla azul', 29.50),
('Zapatos', 'Zapatos deportivos unisex', 49.99);

-- Insertar productos en inglés
INSERT INTO productosen (nombre, descripcion, precio) VALUES
('T-shirt', '100% cotton T-shirt', 15.99),
('Jeans', 'Blue denim jeans', 29.50),
('Sneakers', 'Unisex sports shoes', 49.99);

