<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Longitud de Triángulo</title>
</head>

<body>
    <h1>Calculadora de Longitud de Triángulo</h1>
    <form action="calcular_longitud_triangulo.php" method="GET">
        <label for="lado1">Lado 1:</label>
        <input type="number" id="lado1" name="lado1" required><br><br>
        <label for="lado2">Lado 2:</label>
        <input type="number" id="lado2" name="lado2" required><br><br>
        <label for="lado3">Lado 3:</label>
        <input type="number" id="lado3" name="lado3" required><br><br>
        <button type="submit">Calcular Longitud del Perímetro</button>
    </form>

    <?php
    // Función para llamar al servicio web y calcular la longitud del perímetro del triángulo
    function calcularLongitudPerimetroTriangulo($lado1, $lado2, $lado3)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/calcular_longitud_triangulo.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "lado1" => $lado1,
            "lado2" => $lado2,
            "lado3" => $lado3,
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
        if (isset($result["perimetro"])) {
            echo "<p>La longitud del perímetro del triángulo es: {$result["perimetro"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporcionan los lados del triángulo, llamar a la función para calcular la longitud del perímetro
    if (isset($_GET["lado1"]) && isset($_GET["lado2"]) && isset($_GET["lado3"])) {
        calcularLongitudPerimetroTriangulo($_GET["lado1"], $_GET["lado2"], $_GET["lado3"]);
    }
    ?>
</body>

</html>