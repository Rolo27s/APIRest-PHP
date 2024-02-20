<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Usar Servicio Web con B.DD.</title>
</head>

<body>
    <?php
    // Se requiere el archivo de datos de configuración de la base de datos y la URL del servicio web
    require_once("../api/REST_bd_datos.php");

    // Verificar si la solicitud es GET para mostrar el formulario de agregar municipio
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    ?>
        <h1>Añadir municipio</h1>
        <form method="post">
            Nombre: <input name="nombre" /><br />

            Provincia:
            <select name="provincia">
                <!-- Las opciones de provincia se generan dinámicamente -->
                <option>Almería</option>
                <option>Cádiz</option>
                <option>Córdoba</option>
                <option>Granada</option>
                <option>Huelva</option>
                <option>Jaén</option>
                <option>Málaga</option>
                <option>Sevilla</option>
            </select>
            <br />

            Población: <input name="poblacion" type="number" min="0" /><br />

            <button type="submit">Crear</button>
        </form>
    <?php
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h1>Procesar añadir municipio</h1>";

        // Preparar la petición POST al servicio web
        $ch = curl_init(URL_S_WEB);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json_response = curl_exec($ch);

        // Verificar si la respuesta es correcta
        if ($json_response === false) {
            echo "<p>Error en la solicitud al servicio web: " . curl_error($ch) . "</p>";
        } else {
            // Decodificar la respuesta JSON
            $data = json_decode($json_response, true);
            // Verificar si se crearon filas correctamente
            if ($data && isset($data["filas_creadas"])) {
                $resultado = $data["filas_creadas"];
                echo "<p>Se han creado $resultado filas</p>";
            } else {
                echo "<p>No se pudo obtener el resultado del servicio web.</p>";
            }
        }
        // Cerrar la conexión cURL
        curl_close($ch);
    }
    ?>
    <br /><br /><br />
    <!-- Enlace para volver al listado de municipios -->
    <a href="mostrar_municipios.php">Volver al listado</a>
</body>

</html>