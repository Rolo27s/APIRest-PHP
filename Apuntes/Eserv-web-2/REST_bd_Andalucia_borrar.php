<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usar Servicio Web con B.DD.</title>
</head>

<body>
    <?php
    require_once("REST_bd_datos.php");

    echo "<h1>Procesar borrar municipio</h1>";
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        // preparo la petición con los datos por $_GET
        $ch = curl_init(URL_S_WEB . "?id=" . $_GET["id"]);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");    // esto hace que sea DELETE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        // le digo que espero respuesta
        $json_response = curl_exec($ch);        // lanzo la petición

        // si la respuesta es erronea (devuelve FALSE)
        if ($json_response === false) {
            echo "<p>Error en la solicitud al servicio web: " . curl_error($ch) . "</p>";
        } else {
            // sino, fue bien... decodifico el JSON
            $data = json_decode($json_response, true);
            // si hay datos y esos datos traen el campo esperado...
            if ($data && isset($data["filas_borradas"])) {
                $resultado = $data["filas_borradas"];
                echo "<p>Se han borrado $resultado filas</p>";
            } else {    // no hay datos o no traen el campo esperado
                echo "<p>No se pudo obtener el resultado del servicio web.</p>";
            }
        }
        // cierro el canal de comunicación
        curl_close($ch);
    }
    ?>
    <br /><br /><br />
    <a href="REST_bd_Andalucia_mostrar.php">Volver al listado</a>
</body>

</html>