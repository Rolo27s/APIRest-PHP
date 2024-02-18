<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Municipio</title>
</head>

<body>
    <?php
    require_once("../api/REST_bd_datos.php");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET["id"]) && $_GET["id"] !== "") {
            mostrarFormularioEdicion($_GET["id"]);
        } else {
            mostrarError("Error: Falta el parámetro 'id' del municipio a editar.");
        }
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
        procesarEdicionMunicipio($_POST);
    }

    function mostrarFormularioEdicion($id)
    {
        $municipio = obtenerMunicipioPorId($id);
        if (!$municipio) {
            mostrarError("Error: No se pudo obtener el municipio para editar.");
            return;
        }
    ?>
        <h1>Editar municipio</h1>
        <form method="post">
            <input name="id" type="hidden" value="<?php echo $municipio["id"] ?>" />
            Nombre: <input name="nombre" value="<?php echo $municipio["nombre"] ?>" /><br />
            Provincia:
            <select name="provincia">
                <?php
                $provincias = ["Almería", "Cádiz", "Córdoba", "Granada", "Huelva", "Jaén", "Málaga", "Sevilla"];
                foreach ($provincias as $prov) {
                    $selected = ($municipio["provincia"] === $prov) ? "selected" : "";
                    echo "<option $selected>$prov</option>";
                }
                ?>
            </select><br />
            Población: <input name="poblacion" type="number" min="0" value="<?php echo $municipio["poblacion"] ?>" /><br />
            <button>Editar</button>
        </form>
    <?php
    }

    function procesarEdicionMunicipio($datos)
    {
        $url = URL_S_WEB . "?id=" . urlencode($datos["id"]) .
            "&nombre=" . urlencode($datos["nombre"]) .
            "&provincia=" . urlencode($datos["provincia"]) .
            "&poblacion=" . urlencode($datos["poblacion"]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json_response = curl_exec($ch);

        if ($json_response === false) {
            mostrarError("Error en la solicitud al servicio web: " . curl_error($ch));
        } else {
            $data = json_decode($json_response, true);
            if ($data && isset($data["filas_modificadas"])) {
                $resultado = $data["filas_modificadas"];
                echo "<p>Se han editado $resultado filas</p>";
            } else {
                mostrarError("No se pudo obtener el resultado del servicio web.");
            }
        }
        curl_close($ch);
    }

    function obtenerMunicipioPorId($id)
    {
        $url = URL_S_WEB . "?id=" . urlencode($id);
        $json_response = file_get_contents($url);
        if ($json_response === false) {
            return null;
        }
        $municipio = json_decode($json_response, true)[0];
        return $municipio;
    }

    function mostrarError($mensaje)
    {
        echo "<strong>$mensaje</strong>";
    }
    ?>
    <br /><br /><br />
    <a href="mostrar_municipios.php">Volver al listado</a>
</body>

</html>