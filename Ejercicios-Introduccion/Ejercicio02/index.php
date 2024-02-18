<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Área de Rectángulo</title>
</head>

<body>
    <h1>Calculadora de Área de Rectángulo</h1>
    <form action="calcular_area_rectangulo.php" method="GET">
        <label for="base">Base:</label>
        <input type="number" id="base" name="base" required><br><br>
        <label for="altura">Altura:</label>
        <input type="number" id="altura" name="altura" required><br><br>
        <button type="submit">Calcular Área</button>
    </form>

    <?php
    // Función para llamar al servicio web y calcular el área del rectángulo
    function calcularAreaRectangulo($base, $altura)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/calcular_area_rectangulo.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "base"      => $base,
            "altura"    => $altura,
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
        if (isset($result["area"])) {
            echo "<p>El área del rectángulo es: {$result["area"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporcionan la base y la altura, llamar a la función para calcular el área
    if (isset($_GET["base"]) && isset($_GET["altura"])) {
        calcularAreaRectangulo($_GET["base"], $_GET["altura"]);
    }
    ?>
</body>

</html>