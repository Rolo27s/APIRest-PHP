<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Perímetro de Cuadrado</title>
</head>

<body>
    <h1>Calculadora de Perímetro de Cuadrado</h1>
    <form action="calcular_perimetro_cuadrado.php" method="GET">
        <label for="lado">Lado:</label>
        <input type="number" id="lado" name="lado" required><br><br>
        <button type="submit">Calcular Perímetro</button>
    </form>

    <?php
    // Función para llamar al servicio web y calcular el perímetro del cuadrado
    function calcularPerimetroCuadrado($lado)
    {
        // Construir la URL del servicio web
        $url = "http://localhost/APIRest/serv-web-1/calcular_perimetro_cuadrado.php";

        // Datos a enviar en la solicitud POST
        $post_data = array(
            "lado" => $lado,
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
            echo "<p>El perímetro del cuadrado es: {$result["perimetro"]}</p>";
        } elseif (isset($result["error"])) {
            echo "<p>Error: {$result["error"]}</p>";
        }

        // Cerrar la sesión cURL
        curl_close($curl);
    }

    // Si se proporciona el lado del cuadrado, llamar a la función para calcular el perímetro
    if (isset($_GET["lado"])) {
        calcularPerimetroCuadrado($_GET["lado"]);
    }
    ?>
</body>

</html>