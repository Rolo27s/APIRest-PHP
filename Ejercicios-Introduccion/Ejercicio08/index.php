<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Vocales</title>
</head>

<body>
    <h1>Contador de Vocales</h1>
    <form action="contar_vocales.php" method="GET">
        <label for="palabra">Palabra:</label>
        <input type="text" id="palabra" name="palabra" required><br><br>
        <button type="submit">Contar Vocales</button>
    </form>

    <?php
    // Función para llamar al servicio web y contar la cantidad de vocales en la palabra
    function contarVocales($palabra)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/contar_vocales.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "palabra" => $palabra,
        );

        // Inicializar cURL
        $curl = curl_init($url);

        // Configurar cURL
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la solicitud cURL y obtener la respuesta
        $response = curl_exec($curl);

        // Manejar errores
        if ($response === false) {
            echo "<p>Error en la solicitud al servicio web: " . curl_error($curl) . "</p>";
            return null;
        }

        // Decodificar la respuesta JSON
        $result = json_decode($response, true);

        // Mostrar el resultado
        if (isset($result["cantidad_vocales"])) {
            echo "<p>La cantidad de vocales en '$palabra' es: {$result["cantidad_vocales"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporciona la palabra, llamar a la función para contar las vocales
    if (isset($_GET["palabra"])) {
        contarVocales($_GET["palabra"]);
    }
    ?>
</body>

</html>