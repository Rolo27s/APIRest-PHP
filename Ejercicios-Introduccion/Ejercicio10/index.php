<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Determinar si un Número es Positivo, Negativo o Cero</title>
</head>

<body>
    <h1>Determinar si un Número es Positivo, Negativo o Cero</h1>
    <form action="determinar_numero.php" method="GET">
        <label for="numero">Ingrese un número:</label>
        <input type="number" id="numero" name="numero" required><br><br>
        <button type="submit">Determinar</button>
    </form>

    <?php
    // Función para llamar al servicio web y determinar si el número es positivo, negativo o cero
    function determinarNumero($numero)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/determinar_numero.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "numero" => $numero,
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
        if (isset($result["resultado"])) {
            echo "<p>El número ingresado es {$result["resultado"]}.</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporciona el número, llamar a la función para determinar si es positivo, negativo o cero
    if (isset($_GET["numero"])) {
        determinarNumero($_GET["numero"]);
    }
    ?>
</body>

</html>