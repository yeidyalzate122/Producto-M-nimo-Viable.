-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2023 a las 21:09:02
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logistica`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPedido` (IN `v_id_pedidos` INT, IN `v_id_clientes` INT, IN `v_id_estado_Entrega` INT, IN `v_id_factura` INT, IN `v_observaciones` TEXT)   BEGIN
    UPDATE `pedidos` SET `id_clientes` = v_id_clientes, `id_estado_Entrega` = v_id_estado_Entrega WHERE `pedidos`.`id_pedidos` = v_id_pedidos;
    UPDATE `factura` SET `observaciones` = v_observaciones WHERE `factura`.`id_factura` = v_id_factura;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GuardarDatosOrden` (IN `p_idPedido` INT, IN `p_NumeroOrden` INT, IN `p_CodigoFabricar` INT, IN `p_FechaEntrega` DATE, IN `p_FechaDespacho` DATE, IN `p_Cantidad` INT, IN `p_DireccionEntrega` VARCHAR(100), IN `p_LineaPedido` INT, IN `p_Producto` INT, IN `p_EstadoProducto` INT, IN `p_EstadoOrden` INT, IN `p_Transportadora` INT, IN `p_idpruebaEntrega` INT, IN `p_Descripcion` VARCHAR(200), IN `p_PruebaEntrega` VARCHAR(200), IN `p_FotoCliente` VARCHAR(200))   BEGIN
    UPDATE `orden`
    SET
        `fecha_entrega` = p_FechaEntrega,
        `fecha_despacho` = p_FechaDespacho,
        `cantidad` = p_Cantidad,
        `direccion_entrega` = p_DireccionEntrega,
        `id_transportadora` = p_Transportadora
    WHERE
        `orden`.`id_orden` = p_NumeroOrden;

    UPDATE `prueba_entrega` 
    SET 
        `foto_firma_cliente` = p_FotoCliente,
        `foto_documento_entrega` = p_PruebaEntrega,
        `observaciones` = p_Descripcion
    WHERE 
        `id_prueba_entrega` = p_idpruebaEntrega;

    UPDATE `detalle_linea_pedidos` 
    SET 
        `id_liena_pedidos` = p_LineaPedido 
    WHERE 
        `id_orden` = p_NumeroOrden;

    UPDATE `detalle_orden_productos` 
    SET 
        `id_productos` = p_Producto 
    WHERE 
        `id_orden` = p_NumeroOrden;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GuardarOrden` (IN `v_id_pedidos` INT, IN `v_numeroOrden` INT, IN `v_codigoFabricacion` INT, IN `v_Fecha_entrega` DATE, IN `v_Fecha_despacho` DATE, IN `v_cantidad` INT, IN `v_direccionEntrega` TEXT, IN `v_Linea_pedido` INT, IN `v_id_Producto` INT, IN `v_Estado_producto` INT, IN `v_Estado_orden` INT, IN `v_Trasportadora` INT)   BEGIN
    INSERT INTO `orden` (`id_orden`, `codigo_fabricacion`, `fecha_entrega`, `fecha_despacho`, `cantidad`, `direccion_entrega`, `id_estado_orden`, `id_transportadora`)
     VALUES (v_numeroOrden, v_codigoFabricacion, v_Fecha_entrega, v_Fecha_despacho, v_cantidad, v_direccionEntrega, v_Estado_orden, v_Trasportadora);

    -- Actualizar el estado del producto en la tabla 'productos'
    UPDATE `productos`
    SET `id_estado_productos` = v_Estado_producto
    WHERE `productos`.`id_productos` = v_id_Producto;
    
    
    -- Insertar en la tabla 'detalle_linea_pedidos'
    INSERT INTO `detalle_linea_pedidos` (`id_pedidos`, `id_orden`, `id_liena_pedidos`)
    VALUES (v_id_pedidos, v_numeroOrden, v_Linea_pedido);

    -- Insertar en la tabla 'detalle_orden_productos'
    INSERT INTO `detalle_orden_productos` (`id_orden`, `id_productos`)
    VALUES (v_numeroOrden, v_id_Producto);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `guardarPedido` (IN `v_cliente` INT, IN `v_costo` INT, IN `v_codigoFactura` INT, IN `v_estado` INT, IN `v_observaciones` TEXT)   BEGIN
    -- Insertar el pedido en la tabla 'pedidos'
    INSERT INTO `pedidos` (`costo_total`, `id_clientes`, `id_factura`, `id_estado_Entrega`)
    VALUES (v_costo, v_cliente, v_codigoFactura, v_estado);

    -- Insertar la factura en la tabla 'factura'
    INSERT INTO `factura` (`id_factura`, `codigo_consecutivo`, `observaciones`)
    VALUES (v_codigoFactura, v_codigoFactura, v_observaciones);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id_bodegas` int(11) NOT NULL,
  `bodegas` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id_bodegas`, `bodegas`) VALUES
(1, 'PT01'),
(2, 'PT02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `id_tipo_documentos` int(11) NOT NULL,
  `id_tipo_clientes` int(11) NOT NULL,
  `numero_identificacion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_linea_pedidos`
--

CREATE TABLE `detalle_linea_pedidos` (
  `id_detalle_linea_pedidos` int(11) NOT NULL,
  `id_pedidos` int(11) DEFAULT NULL,
  `id_orden` int(11) DEFAULT NULL,
  `id_liena_pedidos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_linea_pedidos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_productos`
--

CREATE TABLE `detalle_orden_productos` (
  `id_detalle_orden_productos` int(11) NOT NULL,
  `id_orden` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_orden_productos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_entregas`
--

CREATE TABLE `estado_entregas` (
  `id_estado_Entregas` int(11) NOT NULL,
  `estado_Entregas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_entregas`
--

INSERT INTO `estado_entregas` (`id_estado_Entregas`, `estado_Entregas`) VALUES
(1, 'Entregado'),
(2, 'En camino'),
(3, 'Cancelado'),
(7, 'Pedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_orden`
--

CREATE TABLE `estado_orden` (
  `id_estado_orden` int(11) NOT NULL,
  `estado_orden` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_orden`
--

INSERT INTO `estado_orden` (`id_estado_orden`, `estado_orden`) VALUES
(1, 'Cancelado'),
(2, 'En camino'),
(3, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_productos`
--

CREATE TABLE `estado_productos` (
  `id_estado_productos` int(11) NOT NULL,
  `estado_productos` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_productos`
--

INSERT INTO `estado_productos` (`id_estado_productos`, `estado_productos`) VALUES
(1, 'Fabricar'),
(2, 'Reservar'),
(3, 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `codigo_consecutivo` int(11) NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedidos`
--

CREATE TABLE `linea_pedidos` (
  `id_linea_pedidos` int(11) NOT NULL,
  `linea_pedidos` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `linea_pedidos`
--

INSERT INTO `linea_pedidos` (`id_linea_pedidos`, `linea_pedidos`) VALUES
(1, 'MTO'),
(2, 'MTS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL,
  `codigo_fabricacion` int(11) DEFAULT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_despacho` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `direccion_entrega` varchar(100) NOT NULL,
  `id_estado_orden` int(11) NOT NULL,
  `id_transportadora` int(11) NOT NULL,
  `id_prueba_entrega` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden`
--



--
-- Disparadores `orden`
--
DELIMITER $$
CREATE TRIGGER `after_insert_orden` AFTER INSERT ON `orden` FOR EACH ROW BEGIN
    -- Declarar variables para almacenar el costo total de la orden
    DECLARE total_costo INT;

    -- Calcular el costo total sumando los costos de los productos asociados a la orden
    SELECT SUM(p.costo)
    INTO total_costo
    FROM productos p
    WHERE p.id_productos IN (NEW.id_orden); -- Ajusta según la relación entre productos y órdenes

    -- Actualizar el costo total en la tabla pedidos
    UPDATE pedidos
    SET costo_total = total_costo
    WHERE id_pedidos = NEW.id_orden; -- Ajusta según la relación entre pedidos y órdenes
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_orden_insert` BEFORE INSERT ON `orden` FOR EACH ROW BEGIN
    -- Insertar en la tabla 'prueba_entrega' con 'observaciones' como 'ninguna'
    INSERT INTO prueba_entrega (observaciones) VALUES ('ninguna');

    -- Obtener el último ID insertado en prueba_entrega
    SET @last_id_prueba_entrega = LAST_INSERT_ID();

    -- Asignar el nuevo ID en la columna 'id_prueba_entrega' de la nueva orden
    SET NEW.id_prueba_entrega = @last_id_prueba_entrega;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedidos` int(11) NOT NULL,
  `costo_total` int(11) NOT NULL,
  `id_clientes` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_estado_Entrega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `costo` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_tipo_productos` int(11) NOT NULL,
  `id_bodegas` int(11) NOT NULL,
  `id_estado_productos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba_entrega`
--

CREATE TABLE `prueba_entrega` (
  `id_prueba_entrega` int(11) NOT NULL,
  `foto_firma_cliente` varchar(200) NOT NULL,
  `foto_documento_entrega` varchar(200) NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prueba_entrega`
--

INSERT INTO `prueba_entrega` (`id_prueba_entrega`, `foto_firma_cliente`, `foto_documento_entrega`, `observaciones`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', ''),
(8, '', '', ''),
(9, '', '', ''),
(11, '', '', ''),
(65, 'ninguna', 'ninguna', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `id_tipo_documentos` int(11) NOT NULL,
  `tipo_documentos` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`id_tipo_documentos`, `tipo_documentos`) VALUES
(1, 'Cedula'),
(2, 'Tarjeta de identidad'),
(3, 'Cedula extranjera '),
(4, 'Nit');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_clientes`
--

CREATE TABLE `tipo_clientes` (
  `id_tipo_clientes` int(11) NOT NULL,
  `tipo_clientes` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_clientes`
--

INSERT INTO `tipo_clientes` (`id_tipo_clientes`, `tipo_clientes`) VALUES
(1, 'Persona Natural'),
(2, 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id_tipo_productos` int(11) NOT NULL,
  `tipo_productos` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id_tipo_productos`, `tipo_productos`) VALUES
(1, 'Blue month'),
(2, 'Hidromasajes'),
(3, 'Baños'),
(4, 'Zonas De Labores'),
(5, 'Cocinas'),
(6, 'Accesorios'),
(7, 'Blog');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportadora`
--

CREATE TABLE `transportadora` (
  `id_transportadora` int(11) NOT NULL,
  `numero_identificacion` varchar(30) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `observaciones` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transportadora`
--

INSERT INTO `transportadora` (`id_transportadora`, `numero_identificacion`, `nombre`, `telefono`, `direccion`, `observaciones`) VALUES
(1, '3333', 'tras1', '33434', 'calle falsa', 'ninguna'),
(2, '6658', 'tras2', '67867876', 'calle falsa', 'ninguna'),
(3, '5845', 'eficacia', '345534', 'calle falsa', 'ninguna'),
(4, '3333', 'tras4', '33434', 'calle falsa', 'ninguna');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id_bodegas`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_clientes`),
  ADD KEY `id_tipo_documentos` (`id_tipo_documentos`),
  ADD KEY `id_tipo_clientes` (`id_tipo_clientes`);

--
-- Indices de la tabla `detalle_linea_pedidos`
--
ALTER TABLE `detalle_linea_pedidos`
  ADD PRIMARY KEY (`id_detalle_linea_pedidos`),
  ADD KEY `id_pedidos` (`id_pedidos`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_liena_pedidos` (`id_liena_pedidos`);

--
-- Indices de la tabla `detalle_orden_productos`
--
ALTER TABLE `detalle_orden_productos`
  ADD PRIMARY KEY (`id_detalle_orden_productos`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_productos` (`id_productos`);

--
-- Indices de la tabla `estado_entregas`
--
ALTER TABLE `estado_entregas`
  ADD PRIMARY KEY (`id_estado_Entregas`);

--
-- Indices de la tabla `estado_orden`
--
ALTER TABLE `estado_orden`
  ADD PRIMARY KEY (`id_estado_orden`);

--
-- Indices de la tabla `estado_productos`
--
ALTER TABLE `estado_productos`
  ADD PRIMARY KEY (`id_estado_productos`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `linea_pedidos`
--
ALTER TABLE `linea_pedidos`
  ADD PRIMARY KEY (`id_linea_pedidos`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_estado_orden` (`id_estado_orden`),
  ADD KEY `id_transportadora` (`id_transportadora`),
  ADD KEY `id_prueba_entrega` (`id_prueba_entrega`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedidos`),
  ADD KEY `id_clientes` (`id_clientes`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_estado_Entrega` (`id_estado_Entrega`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `id_tipo_productos` (`id_tipo_productos`),
  ADD KEY `id_bodegas` (`id_bodegas`),
  ADD KEY `id_estado_productos` (`id_estado_productos`);

--
-- Indices de la tabla `prueba_entrega`
--
ALTER TABLE `prueba_entrega`
  ADD PRIMARY KEY (`id_prueba_entrega`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id_tipo_documentos`);

--
-- Indices de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  ADD PRIMARY KEY (`id_tipo_clientes`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id_tipo_productos`);

--
-- Indices de la tabla `transportadora`
--
ALTER TABLE `transportadora`
  ADD PRIMARY KEY (`id_transportadora`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id_bodegas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `detalle_linea_pedidos`
--
ALTER TABLE `detalle_linea_pedidos`
  MODIFY `id_detalle_linea_pedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_orden_productos`
--
ALTER TABLE `detalle_orden_productos`
  MODIFY `id_detalle_orden_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estado_entregas`
--
ALTER TABLE `estado_entregas`
  MODIFY `id_estado_Entregas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado_orden`
--
ALTER TABLE `estado_orden`
  MODIFY `id_estado_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_productos`
--
ALTER TABLE `estado_productos`
  MODIFY `id_estado_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT de la tabla `linea_pedidos`
--
ALTER TABLE `linea_pedidos`
  MODIFY `id_linea_pedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prueba_entrega`
--
ALTER TABLE `prueba_entrega`
  MODIFY `id_prueba_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `id_tipo_documentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  MODIFY `id_tipo_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id_tipo_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `transportadora`
--
ALTER TABLE `transportadora`
  MODIFY `id_transportadora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_tipo_documentos`) REFERENCES `tipos_documentos` (`id_tipo_documentos`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`id_tipo_clientes`) REFERENCES `tipo_clientes` (`id_tipo_clientes`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_estado_orden`) REFERENCES `estado_orden` (`id_estado_orden`),
  ADD CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_transportadora`) REFERENCES `transportadora` (`id_transportadora`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id_clientes`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_estado_Entrega`) REFERENCES `estado_entregas` (`id_estado_Entregas`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_tipo_productos`) REFERENCES `tipo_productos` (`id_tipo_productos`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_bodegas`) REFERENCES `bodegas` (`id_bodegas`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_estado_productos`) REFERENCES `estado_productos` (`id_estado_productos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
