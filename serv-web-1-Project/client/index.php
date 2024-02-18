<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Usar Servicio Web</title>
</head>

<body>
    <?php
    // Recibo la información de mi propio formulario por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ?>
        <h1>Resultado del Servicio Web</h1>
        <?php
        $postData = array(
            "base" => $_POST["base"],
            "exponente" => $_POST["exponente"],
        );
        $response = enviarSolicitud("http://localhost/APIRest-PHP/serv-web-1-project/api/REST_Mates.php", $postData);

        if ($response !== false) {
            $data = json_decode($response, true);
            if ($data["codigo"] == 0) {
                echo "<p>El resultado es: <b>{$data['resultado']}</b></p>";
            } else {
                echo "<p>ERROR {$data['codigo']}: {$data['descripcion']}</p>";
            }
        } else {
            echo "<p>Error en la solicitud al servicio web.</p>";
        }
        ?>

        <a href="index.php">Volver</a>

    <?php
        // Inicio el index.php desde este lugar, ya que aun no hubo ninguna petición.
    } else {
    ?>
        <h1>Solicitud del Servicio Web</h1>
        <form method="post">
            <label for="base">Base:</label>
            <input type="number" name="base" id="base" />
            <label for="exponente">Exponente:</label>
            <input type="number" name="exponente" id="exponente" />
            <input type="submit" value="Calcular"></input>
        </form>
    <?php
    }
    ?>

    <?php
    // Método CURL que se encarga de hacer la petición a la API y retornar el servicio
    function enviarSolicitud($url, $postData)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    ?>
</body>

</html>