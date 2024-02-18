<?php
define("BDD_IP", "localhost");
define("BDD_PUERTO", 3306);
define("BDD_BD", "municipios");
define("BDD_USER", "root");
define("BDD_PASS", "");


define("URL_S_WEB", "http://localhost/APIRest/serv-web-2/REST_bd_Andalucia.php");


/**** B.DD.
CREATE USER 'municipios'@'localhost' IDENTIFIED VIA mysql_native_password USING 'municipios';
GRANT USAGE ON *.* TO 'municipios'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `municipios`;
GRANT ALL PRIVILEGES ON `municipios`.* TO 'municipios'@'localhost';
USE `municipios`;
CREATE TABLE `municipios` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
	`nombre` VARCHAR(100) UNIQUE NOT NULL,
	`provincia` VARCHAR(100) NOT NULL,
	`poblacion` INT NOT NULL
);
INSERT INTO `municipios` VALUES
	(NULL, 'Sevilla', 'Sevilla', 681998), (NULL, 'Málaga', 'Málaga', 579076), 
	(NULL, 'Córdoba', 'Córdoba', 319515), (NULL, 'Granada', 'Granada', 228682),
	(NULL, 'Jerez de la Frontera', 'Cádiz', 212730), (NULL, 'Almería', 'Almería', 199237),
	(NULL, 'Marbella', 'Málaga', 150725), (NULL, 'Huelva', 'Huelva', 141854),
	(NULL, 'Dos Hermanas', 'Sevilla', 137561), (NULL, 'Algeciras', 'Cádiz', 122368),
	(NULL, 'Cádiz', 'Cádiz', 113066), (NULL, 'Jaén', 'Jaén', 111669),
	(NULL, 'Roquetas de Mar', 'Almería', 102881), (NULL, 'San Fernando', 'Cádiz', 94120),
	(NULL, 'Mijas', 'Málaga', 89502);
 */

// CREATE DATABASE IF NOT EXISTS `municipios`;
// USE `municipios`;
// CREATE TABLE `municipios` (
// 	`id` INT PRIMARY KEY AUTO_INCREMENT,
// 	`nombre` VARCHAR(100) UNIQUE NOT NULL,
// 	`provincia` VARCHAR(100) NOT NULL,
// 	`poblacion` INT NOT NULL
// );
// INSERT INTO `municipios` VALUES
// 	(NULL, 'Sevilla', 'Sevilla', 681998), (NULL, 'Málaga', 'Málaga', 579076), 
// 	(NULL, 'Córdoba', 'Córdoba', 319515), (NULL, 'Granada', 'Granada', 228682),
// 	(NULL, 'Jerez de la Frontera', 'Cádiz', 212730), (NULL, 'Almería', 'Almería', 199237),
// 	(NULL, 'Marbella', 'Málaga', 150725), (NULL, 'Huelva', 'Huelva', 141854),
// 	(NULL, 'Dos Hermanas', 'Sevilla', 137561), (NULL, 'Algeciras', 'Cádiz', 122368),
// 	(NULL, 'Cádiz', 'Cádiz', 113066), (NULL, 'Jaén', 'Jaén', 111669),
// 	(NULL, 'Roquetas de Mar', 'Almería', 102881), (NULL, 'San Fernando', 'Cádiz', 94120),
// 	(NULL, 'Mijas', 'Málaga', 89502);
