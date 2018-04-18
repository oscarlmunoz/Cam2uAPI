# README #

### What is this repository for? ###

This is the Back_end api for the Cam2U application as a final project of the HNC in Web Design at IES Aguadulce.

### How do I get set up? ###

To preperare this Api you need to have installed PHP (5 or higher), a MySql database at port 8888 and execute the following script.

##
## Creación de la base de datos cam2uDB
##
CREATE DATABASE IF NOT EXISTS `cam2uDB` DEFAULT CHARACTER SET utf8;
USE `cam2uDB`;

##
## Tabla `ADMINISTRADOR`
##

CREATE TABLE `ADMINISTRADOR` (
  `nombre` varchar(8) NOT NULL,
  `pass` varchar(200) NOT NULL
)  CHARSET=utf8;

##
## Tabla `ARTICULO`
##

CREATE TABLE `ARTICULO` (
  `id_articulo` int(5) NOT NULL,
  `id_prenda` int(5) NOT NULL,
  `tamano` varchar(5) NOT NULL,
  `color` varchar(20) NOT NULL,
  `precio` int(5) NOT NULL,
  `publicado` tinyint(1) NOT NULL,
  `imagen` longtext NOT NULL,
  `nombre` VARCHAR(50) NOT NULL 
)  CHARSET=utf8;

##
## Tabla `CLIENTE`
##

CREATE TABLE `CLIENTE` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `pass` longtext NOT NULL,
  `activo` tinyint(1) NOT NULL
)  CHARSET=utf8;

##
## Tabla `CONTIENE`
##

CREATE TABLE `CONTIENE` (
  `id_pedido` int(5) NOT NULL,
  `id_articulo` int(5) NOT NULL,
  `cantidad` int(5) NOT NULL
)  CHARSET=utf8;

##
## Tabla `PEDIDO`
##

CREATE TABLE `PEDIDO` (
  `id_pedido` int(5) NOT NULL,
  `estado` int(1) NOT NULL,
  `nifCliente` varchar(9) NOT NULL
)  CHARSET=utf8;

##
## Tabla `PRENDA_BASE`
##

CREATE TABLE `PRENDA_BASE` (
  `id_tipo` int(5) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `genero` tinyint(1) NOT NULL,
  `precio` int(5) NOT NULL
)  CHARSET=utf8;





##
## Clave primaria para  `ADMINISTRADOR`
##

ALTER TABLE `ADMINISTRADOR`
  ADD PRIMARY KEY (`nombre`);

##
## Clave primaria para  `ARTICULO`
##

ALTER TABLE `ARTICULO`
  ADD PRIMARY KEY (`id_articulo`);

##
## Clave primaria para  `CLIENTE`
##

ALTER TABLE `CLIENTE`
  ADD PRIMARY KEY (`dni`);

##
## Clave primaria para  `PEDIDO`
##

ALTER TABLE `PEDIDO`
  ADD PRIMARY KEY (`id_pedido`);

##
## Clave primaria para  `PRENDA_BASE`
##

ALTER TABLE `PRENDA_BASE`
  ADD PRIMARY KEY (`id_tipo`);

##
## Clave autoincremental para `ARTICULO`
##

ALTER TABLE `ARTICULO`
  MODIFY `id_articulo` int(5) NOT NULL AUTO_INCREMENT;

##
## Clave autoincremental para `PEDIDO`
##

ALTER TABLE `PEDIDO`
    MODIFY `id_pedido` int(5) NOT NULL AUTO_INCREMENT;
  
##
## Clave autoincremental para `PRENDA_BASE`
##

ALTER TABLE `PRENDA_BASE`
  MODIFY `id_tipo` int(5) NOT NULL AUTO_INCREMENT;

##
## Administrador
##

INSERT INTO `ADMINISTRADOR` (`nombre`, `pass`) VALUES ('admin', '$2y$10$7SojfQwVAb.TyMFd60p8ReFDgjYQY1SfCO79utjTYPlly0NQtSVF.');

##
## Añadimos prendas base
##

INSERT INTO `PRENDA_BASE` (`id_tipo`, `tipo`, `genero`, `precio`) VALUES (NULL, 'Camisetas', '0', '5'), (NULL, 'Camisetas', '1', ‘6’), (NULL, 'Sudaderas', '0', '17'), (NULL, 'sudaderas', '1', '18')



### Who do I talk to? ###

You can contact me @ oscarmunozdev@gmail.com