<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Longitud de Círculo</title>
</head>

<body>
    <h1>Calculadora de Longitud de Círculo</h1>
    <form action="calcular_longitud_circulo.php" method="GET">
        <label for="radio">Radio:</label>
        <input type="number" id="radio" name="radio" required><br><br>
        <button type="submit">Calcular Longitud</button>
    </form>

    <?php
    // Función para llamar al servicio web y calcular la longitud del círculo
    function calcularLongitudCirculo($radio)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/calcular_longitud_circulo.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "radio" => $radio,
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
        if (isset($result["longitud"])) {
            echo "<p>La longitud del círculo es: {$result["longitud"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporciona el radio del círculo, llamar a la función para calcular la longitud
    if (isset($_GET["radio"])) {
        calcularLongitudCirculo($_GET["radio"]);
    }
    ?>
</body>

</html>