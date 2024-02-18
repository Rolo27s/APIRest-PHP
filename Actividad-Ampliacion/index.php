<?php

$url = 'https://www.zaragoza.es/sede/servicio/urbanismo-infraestructuras/estacion-bicicleta?rf=html&srsname=wgs84&start=0&rows=50&distance=500';

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error al realizar la solicitud cURL: ' . curl_error($ch);
}

curl_close($ch);

// Aquí puedes procesar la respuesta, por ejemplo, imprimirla
echo $response;
