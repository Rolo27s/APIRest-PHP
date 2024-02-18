<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["palabra"])) {
    $palabra = $_GET["palabra"];

    // Convertir la palabra a minúsculas para asegurar que todas las vocales sean contadas correctamente
    $palabra = strtolower($palabra);

    // Contar la cantidad de vocales en la palabra
    $cantidad_vocales = preg_match_all('/[aeiouáéíóú]/i', $palabra);

    // Devolver el resultado como JSON
    echo json_encode(["cantidad_vocales" => $cantidad_vocales]);
} else {
    // Si el parámetro no es válido, devolver un error
    echo json_encode(["error" => "Parámetro incorrecto"]);
}
