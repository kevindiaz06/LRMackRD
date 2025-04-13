-- Eliminar tablas si existen
DROP TABLE IF EXISTS `detalle_ventas`;
DROP TABLE IF EXISTS `inventarios`;
DROP TABLE IF EXISTS `pagos`;
DROP TABLE IF EXISTS `facturas`;
DROP TABLE IF EXISTS `ventas`;
DROP TABLE IF EXISTS `libros`;
DROP TABLE IF EXISTS `empleados`;
DROP TABLE IF EXISTS `clientes`;
DROP TABLE IF EXISTS `proveedores`;
DROP TABLE IF EXISTS `categorias`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `migrations`;
DROP TABLE IF EXISTS `personal_access_tokens`;

-- -----------------------------------------------------
-- Tabla `categorias`
-- -----------------------------------------------------
CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `proveedores`
-- -----------------------------------------------------
CREATE TABLE `proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `clientes`
-- -----------------------------------------------------
CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `empleados`
-- -----------------------------------------------------
CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `salario` decimal(10,2) NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empleados_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `libros`
-- -----------------------------------------------------
CREATE TABLE `libros` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libros_isbn_unique` (`isbn`),
  KEY `libros_categoria_id_foreign` (`categoria_id`),
  KEY `libros_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `libros_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `libros_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `ventas`
-- -----------------------------------------------------
CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_cliente_id_foreign` (`cliente_id`),
  KEY `ventas_empleado_id_foreign` (`empleado_id`),
  CONSTRAINT `ventas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `ventas_empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `detalle_ventas`
-- -----------------------------------------------------
CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `libro_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(8,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_ventas_venta_id_foreign` (`venta_id`),
  KEY `detalle_ventas_libro_id_foreign` (`libro_id`),
  CONSTRAINT `detalle_ventas_libro_id_foreign` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`),
  CONSTRAINT `detalle_ventas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `facturas`
-- -----------------------------------------------------
CREATE TABLE `facturas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `total_sin_impuestos` decimal(10,2) NOT NULL,
  `total_impuestos` decimal(10,2) NOT NULL,
  `total_con_impuestos` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facturas_venta_id_unique` (`venta_id`),
  UNIQUE KEY `facturas_numero_unique` (`numero`),
  CONSTRAINT `facturas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `pagos`
-- -----------------------------------------------------
CREATE TABLE `pagos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagos_venta_id_foreign` (`venta_id`),
  CONSTRAINT `pagos_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `inventarios`
-- -----------------------------------------------------
CREATE TABLE `inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libro_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_movimiento` enum('entrada','salida') NOT NULL,
  `fecha` date NOT NULL,
  `notas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventarios_libro_id_foreign` (`libro_id`),
  CONSTRAINT `inventarios_libro_id_foreign` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla `users` (para autenticación/Laravel)
-- -----------------------------------------------------
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Datos iniciales para categorías
-- -----------------------------------------------------
INSERT INTO `categorias` (`nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
('Ficción', 'Novelas, cuentos y relatos de ficción', NOW(), NOW()),
('No Ficción', 'Libros educativos y de información real', NOW(), NOW()),
('Infantil', 'Literatura para niños y jóvenes', NOW(), NOW()),
('Académico', 'Libros educativos y textos escolares', NOW(), NOW()),
('Autoayuda', 'Libros para desarrollo personal', NOW(), NOW());

-- -----------------------------------------------------
-- Datos iniciales para proveedores
-- -----------------------------------------------------
INSERT INTO `proveedores` (`nombre`, `contacto`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
('Editorial Planeta', 'Juan Pérez', '555-1234', 'contacto@planeta.com', NOW(), NOW()),
('Penguin Random House', 'María García', '555-5678', 'info@penguinrandomhouse.com', NOW(), NOW()),
('Ediciones B', 'Roberto Sánchez', '555-9876', 'ventas@edicionesb.com', NOW(), NOW());

-- -----------------------------------------------------
-- Datos iniciales para empleados
-- -----------------------------------------------------
INSERT INTO `empleados` (`nombre`, `cargo`, `email`, `telefono`, `salario`, `fecha_contratacion`, `created_at`, `updated_at`) VALUES
('Ana Martínez', 'Vendedor', 'ana.martinez@libreria.com', '555-1111', 1500.00, '2023-01-15', NOW(), NOW()),
('Carlos López', 'Gerente', 'carlos.lopez@libreria.com', '555-2222', 2500.00, '2022-06-10', NOW(), NOW()),
('Laura Jiménez', 'Asistente', 'laura.jimenez@libreria.com', '555-3333', 1200.00, '2023-03-20', NOW(), NOW());