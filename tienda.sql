-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2025 at 12:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `productosen`
--

CREATE TABLE `productosen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productosen`
--

INSERT INTO `productosen` (`id`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'T-shirt', '100% cotton T-shirt', 15.99),
(2, 'Jeans', 'Blue denim jeans', 29.50),
(3, 'Sneakers', 'Unisex sports shoes', 49.99),
(4, 'Jacket', 'Waterproof winter jacket', 79.90),
(5, 'Hat', 'Classic cotton baseball cap', 9.99),
(6, 'Sunglasses', 'UV400 protection sunglasses', 19.99),
(7, 'Backpack', 'Durable travel backpack', 39.50),
(8, 'Watch', 'Digital wrist watch', 24.99);


-- --------------------------------------------------------

--
-- Table structure for table `productoses`
--

CREATE TABLE `productoses` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productoses`
--

INSERT INTO `productoses` (`id`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'Camiseta', 'Camiseta de algodón 100%', 15.99),
(2, 'Pantalones', 'Pantalones de mezclilla azul', 29.50),
(3, 'Zapatos', 'Zapatos deportivos unisex', 49.99),
(4, 'Chaqueta', 'Chaqueta impermeable de invierno', 79.90),
(5, 'Gorra', 'Gorra clásica de algodón', 9.99),
(6, 'Gafas de sol', 'Gafas de sol con protección UV400', 19.99),
(7, 'Mochila', 'Mochila de viaje resistente', 39.50),
(8, 'Reloj', 'Reloj de pulsera digital', 24.99);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `productosen`
--
ALTER TABLE `productosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productoses`
--
ALTER TABLE `productoses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productosen`
--
ALTER TABLE `productosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productoses`
--
ALTER TABLE `productoses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

