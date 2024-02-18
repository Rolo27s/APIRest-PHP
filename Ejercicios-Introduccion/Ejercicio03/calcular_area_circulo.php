<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["radio"])) {
    $radio = $_GET["radio"];

    // Calcular el área del círculo
    $area = pi() * pow($radio, 2);

    // Devolver el resultado como JSON
    echo json_encode(["area" => $area]);
} else {
    // Si los parámetros no son válidos, devolver un error
    echo json_encode(["error" => "Parámetros incorrectos"]);
}
?>
