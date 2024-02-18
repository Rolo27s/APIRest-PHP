<?php
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
            $consulta = $this->conexion->prepare("SELECT id, nombre, provincia, poblacion " . "FROM municipios WHERE id=?");
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
            $consulta = $this->conexion->prepare("SELECT id, nombre, provincia, poblacion " . "FROM municipios WHERE provincia=?");
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
            $consulta = $this->conexion->prepare("INSERT INTO municipios " . "(nombre, provincia, poblacion) VALUES (?,?,?)");
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
