<?php
require_once("REST_bd_datos.php");

class BaseDatosAndalucia
{
	private $conexion;

	public function __construct()
	{
		try {
			// Establecer la conexión a la base de datos
			$this->conexion = new PDO("mysql:host=" . BDD_IP . ";port=" . BDD_PUERTO . ";dbname=" . BDD_BD, BDD_USER, BDD_PASS);
			// Configurar PDO para que lance excepciones en caso de errores
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Error al conectarse a la base de datos: " . $e->getMessage());
		}
	}

	public function cargarTodosMunicipios()
	{
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("SELECT id, nombre, provincia, poblacion FROM municipios");
			// Ejecutar la consulta
			$consulta->execute();
			// Obtener y devolver los resultados como un array asociativo
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function cargarMunicipio($filtro)
	{
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("SELECT id, nombre, provincia, poblacion " .
				"FROM municipios WHERE id=?");
			// Añadir datos
			$consulta->bindParam(1, $filtro["id"]);
			// Ejecutar la consulta
			$consulta->execute();
			// Obtener y devolver los resultados como un array asociativo
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function cargarAlgunosMunicipios($filtro)
	{
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("SELECT id, nombre, provincia, poblacion " .
				"FROM municipios WHERE provincia=?");
			// Añadir datos
			$consulta->bindParam(1, $filtro["provincia"]);
			// Ejecutar la consulta
			$consulta->execute();
			// Obtener y devolver los resultados como un array asociativo
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function guardarMunicipio($datos)
	{
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("INSERT INTO municipios " .
				"(nombre, provincia, poblacion) VALUES (?,?,?)");
			// Añadir datos
			$consulta->bindParam(1, $datos["nombre"]);
			$consulta->bindParam(2, $datos["provincia"]);
			$consulta->bindParam(3, $datos["poblacion"]);
			// Ejecutar la consulta
			return $consulta->execute();
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function modificarMunicipio($datos)
	{
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("UPDATE municipios SET nombre=?, provincia=?, poblacion=? WHERE id=?");
			// Añadir datos
			$consulta->bindParam(1, $datos["nombre"]);
			$consulta->bindParam(2, $datos["provincia"]);
			$consulta->bindParam(3, $datos["poblacion"]);
			$consulta->bindParam(4, $datos["id"]);
			// Ejecutar la consulta
			return $consulta->execute();
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}

	public function borrarMunicipio($datos)
	{
		try {
			// Preparar la consulta SQL
			$consulta = $this->conexion->prepare("DELETE FROM municipios WHERE id=?");
			// Añadir datos
			$consulta->bindParam(1, $datos["id"]);
			// Ejecutar la consulta
			return $consulta->execute();
		} catch (PDOException $e) {
			die("Error al obtener datos: " . $e->getMessage());
		}
	}
}


/***** Test
$andalucia = new BaseDatosAndalucia();

// muestro todos los municipios de la b.dd.
$todos = $andalucia->cargarTodosMunicipios();
echo "<h3>Todos:</h3>\n";
echo json_encode($todos) . "\n";
echo "<br><br>\n";

// muestro los municipios de Málaga
$algunos = $andalucia->cargarAlgunosMunicipios(Array("provincia"=>"Málaga"));
echo "<h3>Ver municipios de Málaga:</h3>\n";
echo json_encode($algunos) . "\n";
echo "<br><br>\n";

// muestro el municipio con id 3
$municipio = $andalucia->cargarMunicipio(Array("id"=>"3"));
echo "<h3>Ver municipio con id=3:</h3>\n";
echo json_encode($municipio) . "\n";
echo "<br><br>\n";

$nuevoDato = Array("nombre"=>"Ronda", "provincia"=>"Málaga", "poblacion"=>33978);
// añado Ronda
$res = $andalucia->guardarMunicipio($nuevoDato);
$algunos = $andalucia->cargarAlgunosMunicipios(Array("provincia"=>"Málaga"));
echo "<h3>Añadir Ronda:</h3>\n";
echo "Filas añadidas: " . $res . "<br>\n";
echo json_encode($algunos) . "\n";
echo "<br><br>\n";

$nuevoDato = Array("id"=>1, "nombre"=>"Sevilla", "provincia"=>"Sevilla", "poblacion"=>680000);
// cambio la población de Sevilla
$res = $andalucia->modificarMunicipio($nuevoDato);
$algunos = $andalucia->cargarAlgunosMunicipios(Array("provincia"=>"Sevilla"));
echo "<h3>Cambiar población de Sevilla:</h3>\n";
echo "Filas modificadas: " . $res . "<br>\n";
echo json_encode($algunos) . "\n";
echo "<br><br>\n";

$nuevoDato = Array("id"=>15);
// borro Mijas
$res = $andalucia->borrarMunicipio($nuevoDato);
$algunos = $andalucia->cargarAlgunosMunicipios(Array("provincia"=>"Málaga"));
echo "<h3>Borrar Mijas:</h3>\n";
echo "Filas borradas: " . $res . "<br>\n";
echo json_encode($algunos) . "\n\n\n";
//*/



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
