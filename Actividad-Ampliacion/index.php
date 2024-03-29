<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Do the connection
    $url = 'https://www.zaragoza.es/sede/servicio/urbanismo-infraestructuras/estacion-bicicleta?rf=html&srsname=wgs84&start=0&rows=50&distance=500';
    // https://www.zaragoza.es/docs-api_sede/#/Equipamientos%20y%20movilidad%3A%20Estaciones%20Bizi/get_servicio_urbanismo_infraestructuras_estacion_bicicleta

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error al realizar la solicitud cURL: ' . curl_error($ch);
    }

    curl_close($ch);

    // Aquí puedes procesar la respuesta, por ejemplo, imprimirla
    // echo $response;

    // Decodifico el JSON
    $data = json_decode($response, true);
    ?>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        header {
            background-color: rgb(172, 172, 172);
            padding: 1rem;
        }

        main {
            padding: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 1rem;
        }

        a {
            text-decoration: none;
        }
    </style>
    <link rel="shortcut icon" href="<?= $data['result'][0]['icon']; ?>" type="image/x-icon">
    <title>Bicis Zaragoza</title>
</head>

<body>
    <header>
        <h1>Conexión con el endpoint de bicicletas de Zaragoza</h1>
        <h2>Menu principal</h2>
    </header>
    <main>
        <a href="view-all.php"><button>Ver Estaciones cercanas al centro</button></a>
        <a href="view-muchas.php"><button>Ver Estaciones con muchas bicis (+15)</button></a>
        <a href="view-pocas.php"><button>Ver Estaciones con pocas bicis (-5)</button></a>
    </main>
</body>

</html>