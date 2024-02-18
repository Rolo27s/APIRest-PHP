<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["base"]) && isset($_GET["altura"])) {
    $base = $_GET["base"];
    $altura = $_GET["altura"];

    // Calcular el área del rectángulo
    $area = $base * $altura;

    // Devolver el resultado como JSON
    echo json_encode(["area" => $area]);
} else {
    // Si los parámetros no son válidos, devolver un error
    echo json_encode(["error" => "Parámetros incorrectos"]);
}
?>
