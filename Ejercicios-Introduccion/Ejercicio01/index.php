<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usar Servicio Web</title>
</head>

<body>
    <?php
    // Función para procesar el formulario y llamar al servicio web
    function procesarFormulario()
    {
        // URL del servicio web
        $servicio_web_url = "http://localhost/APIRest/serv-web-1/REST_Mates.php";

        // Validar datos del formulario
        if (!isset($_POST["base"]) || !isset($_POST["exponente"])) {
            echo "<p>Error: Debes completar ambos campos.</p>";
            return;
        }

        // Datos a enviar en la solicitud POST
        $base = $_POST["base"];
        $exponente = $_POST["exponente"];
        $post_data = array(
            "base"      => $base,
            "exponente" => $exponente,
        );

        // Realizar solicitud al servicio web
        $resultado = obtenerResultado($servicio_web_url, $post_data);

        // Mostrar resultado
        if ($resultado !== null) {
            echo "<h1>Resultado del Servicio Web</h1>";
            echo "<p>El resultado es: $resultado</p>";
        }
    }

    // Función para realizar la solicitud al servicio web
    function obtenerResultado($url, $data)
    {
        $curl_handle = curl_init($url);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_handle);

        // Verificar errores
        if ($response === false) {
            echo "<p>Error en la solicitud al servicio web: " . curl_error($curl_handle) . "</p>";
            return null;
        }

        // Decodificar respuesta JSON
        $data = json_decode($response, true);

        // Comprobar si hubo errores en la respuesta
        if ($data["codigo"] != 0) {
            $codigo = $data["codigo"];
            $descripcion = $data["descripcion"];
            echo "<p>ERROR $codigo: $descripcion</p>";
            return null;
        }

        // Devolver el resultado
        return $data["resultado"];
    }

    // Si se está procesando el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        procesarFormulario();
    } else {
        // Mostrar formulario
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