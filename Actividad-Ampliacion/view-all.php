<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Do the connection
    $url = 'https://www.zaragoza.es/sede/servicio/urbanismo-infraestructuras/estacion-bicicleta?rf=html&srsname=wgs84&start=0&rows=50';
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
    </style>
    <link rel="shortcut icon" href="<?= $data['result'][0]['icon']; ?>" type="image/x-icon">
    <title>Bicis Zaragoza</title>
</head>

<body>
    <header>
        <h1>Conexión y consumo de endpoint: Bicicletas de Zaragoza</h1>
        <h2>Bicicletas cercanas al centro</h2>
    </header>
    <main>
        Datos a fecha: <?= $data['result'][0]['lastUpdated']; ?>
        <table>
            <thead>
                <tr>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Número de <br /> bicis disponibles</th>
                    <th>Número de <br /> anclajes disponibles</th>
                    <th>Coordenadas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['result'] as $result) : ?>
                    <tr>
                        <td><?php echo $result['address']; ?></td>
                        <td><?php echo $result['estado']; ?></td>
                        <td><?php echo $result['bicisDisponibles']; ?></td>
                        <td><?php echo $result['anclajesDisponibles']; ?></td>
                        <td><?php echo $result['geometry']['coordinates'][0] . ', ' . $result['geometry']['coordinates'][1]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php">Volver al menu principal</a>
    </main>
</body>

</html>