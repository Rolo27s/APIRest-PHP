<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encontrar el Mínimo de un Conjunto de Números</title>
</head>

<body>
    <h1>Encontrar el Mínimo de un Conjunto de Números</h1>
    <form action="encontrar_minimo.php" method="GET">
        <label for="numeros">Conjunto de Números (separados por comas):</label>
        <input type="text" id="numeros" name="numeros" required><br><br>
        <button type="submit">Encontrar Mínimo</button>
    </form>

    <?php
    // Función para llamar al servicio web y encontrar el mínimo del conjunto de números
    function encontrarMinimo($numeros)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/encontrar_minimo.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "numeros" => $numeros,
        );

        // Inicializar cURL
        $curl = curl_init($url);

        // Configurar cURL
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
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
        if (isset($result["minimo"])) {
            echo "<p>El mínimo del conjunto de números es: {$result["minimo"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporciona el conjunto de números, llamar a la función para encontrar el mínimo
    if (isset($_GET["numeros"])) {
        encontrarMinimo($_GET["numeros"]);
    }
    ?>
</body>

</html>