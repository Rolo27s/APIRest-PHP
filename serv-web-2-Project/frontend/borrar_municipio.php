<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Borrar Municipio</title>
</head>

<body>
    <?php
    require_once("../api/REST_bd_datos.php");

    // Verifica si se recibió el parámetro "id" para borrar el municipio
    if (isset($_GET["id"]) && $_GET["id"] !== "") {
        $idMunicipio = $_GET["id"];
        // Realiza la solicitud DELETE al servicio web para borrar el municipio
        $resultado = borrarMunicipio($idMunicipio);
        // Muestra el resultado de la operación
        if ($resultado !== false && isset($resultado["filas_borradas"])) {
            $filasBorradas = $resultado["filas_borradas"];
            echo "<p>Se han borrado $filasBorradas filas</p>";
        } else {
            echo "<p>No se pudo borrar el municipio.</p>";
        }
    } else {
        echo "<p>Error: Falta el parámetro 'id' del municipio a borrar.</p>";
    }
    ?>
    <br /><br /><br />
    <a href="mostrar_municipios.php">Volver al listado</a>
</body>

</html>

<?php
function borrarMunicipio($id)
{
    // Prepara la petición DELETE al servicio web
    $ch = curl_init(URL_S_WEB . "?id=" . urlencode($id));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Ejecuta la petición
    $json_response = curl_exec($ch);
    curl_close($ch);
    // Decodifica la respuesta JSON
    $data = json_decode($json_response, true);
    return $data;
}
?>