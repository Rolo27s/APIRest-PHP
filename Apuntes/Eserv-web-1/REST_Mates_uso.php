<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usar Servicio Web</title>
</head>

<body>
    <?php
    // si estoy procesando el formulario de envío... (estoy en POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h1>Resultado del Servicio Web</h1>";

        // URL del servicio web
        $servicio_web_url = "http://localhost/APIRest/serv-web-1/REST_Mates.php";

        // datos a enviar en la solicitud POST
        $post_data = array(
            // incluyo los datos a enviar
            "base"      => $_POST["base"],
            "exponente" => $_POST["exponente"],
        );

        // configuración de la solicitud CURL
        $ch = curl_init($servicio_web_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // ejecuto la solicitud cURL y obtener la respuesta
        $response = curl_exec($ch);

        // verifico si la solicitud fue exitosa y decodificar la respuesta JSON
        if ($response === false) {
            echo "<p>Error en la solicitud al servicio web: " . curl_error($ch) . "</p>";
        } else {
            $data = json_decode($response, true);

            // compruebo la respuesta para saber si hubo o no errores
            if ($data["codigo"] == 0) {
                $resultado = $data["resultado"];
                echo "<p>El resultado es: $resultado</p>";
            } else {
                $codigo = $data["codigo"];
                $descripcion = $data["descripcion"];
                echo "<p>ERROR $codigo: $descripcion</p>";
            }
        }

        // cierro la sesión CURL
        curl_close($ch);
    } else {
        // sino, no estoy procesando el formulario (estoy en GET, p.e.)
    ?>
        <h1>Solicitud del Servicio Web</h1>
        <form method="post">
            Base: <input type="number" name="base" /><br />
            Exponente: <input type="number" name="exponente" /><br />
            <button>Calcular</button>
        </form>
    <?php
    }
    ?>
</body>

</html>