<?php
// URL de la API
$url = "https://www.zaragoza.es/sede/servicio/monumento.json?rows=100&fl=title,horario,geometry";

// Inicializar cURL
$ch = curl_init();

// Establecer la URL y otras opciones necesarias
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la petición cURL y guardar la respuesta en una variable
$response = curl_exec($ch);

// Verificar si ocurrió algún error
if (curl_errno($ch)) {
    echo 'Error al hacer la petición: ' . curl_error($ch);
} else {
    // Imprimir la respuesta
    echo $response;
}

// Cerrar la conexión cURL
curl_close($ch);
