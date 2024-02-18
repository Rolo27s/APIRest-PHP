<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Perímetro de Rectángulo</title>
</head>

<body>
    <h1>Calculadora de Perímetro de Rectángulo</h1>
    <form action="calcular_perimetro_rectangulo.php" method="GET">
        <label for="lado1">Lado 1:</label>
        <input type="number" id="lado1" name="lado1" required><br><br>
        <label for="lado2">Lado 2:</label>
        <input type="number" id="lado2" name="lado2" required><br><br>
        <button type="submit">Calcular Perímetro</button>
    </form>

    <?php
    // Función para llamar al servicio web y calcular el perímetro del rectángulo
    function calcularPerimetroRectangulo($lado1, $lado2)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/calcular_perimetro_rectangulo.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "lado1" => $lado1,
            "lado2" => $lado2,
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
            echo "<p>El perímetro del rectángulo es: {$result["perimetro"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporcionan los lados del rectángulo, llamar a la función para calcular el perímetro
    if (isset($_GET["lado1"]) && isset($_GET["lado2"])) {
        calcularPerimetroRectangulo($_GET["lado1"], $_GET["lado2"]);
    }
    ?>
</body>

</html>