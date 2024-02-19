<!DOCTYPE html>
<html lang="en">

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
    <title>Document</title>
</head>

<body>
    <h1>Conexion con el endpoint de bicicletas de Zaragoza</h1>
    <?php
    foreach ($data['result'] as $result) {
        $status = $result['estado'];
        $address = $result['address'];
        $NbicEnabled = $result['bicisDisponibles'];
        $NancEnabled = $result['anclajesDisponibles'];
        $coordLong = $result['geometry']['coordinates'][0];
        $coordLat = $result['geometry']['coordinates'][1];

        echo    "Dirección: $address<br/> 
                Estado: $status <br/>
                Numero de bicis disponibles: $NbicEnabled <br/>
                Numero de anclajes disponibles: $NancEnabled <br/>
                Coordenadas: $coordLong, $coordLat <br/>
                <br/> ";
    }
    ?>
</body>

</html>