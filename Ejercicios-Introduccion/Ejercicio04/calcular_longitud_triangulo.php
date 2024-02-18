<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lado1"]) && isset($_GET["lado2"]) && isset($_GET["lado3"])) {
    $lado1 = $_GET["lado1"];
    $lado2 = $_GET["lado2"];
    $lado3 = $_GET["lado3"];

    // Calcular la longitud del perímetro del triángulo
    $perimetro = $lado1 + $lado2 + $lado3;

    // Devolver el resultado como JSON
    echo json_encode(["perimetro" => $perimetro]);
} else {
    // Si los parámetros no son válidos, devolver un error
    echo json_encode(["error" => "Parámetros incorrectos"]);
}
?>
