<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["base"]) && isset($_GET["altura"])) {
    $base = $_GET["base"];
    $altura = $_GET["altura"];

    // Calcular el área del triángulo
    $area = 0.5 * $base * $altura;

    // Devolver el resultado como JSON
    echo json_encode(["area" => $area]);
} else {
    // Si los parámetros no son válidos, devolver un error
    echo json_encode(["error" => "Parámetros incorrectos"]);
}

/*
El método json_encode() en PHP toma un array PHP y lo convierte en una representación en formato JSON.

json_encode(): Esta función convierte ese array asociativo en una cadena de texto en formato JSON. 
Por lo tanto, el resultado será algo similar a {"area": valor_del_area}, 
donde valor_del_area será el valor de la variable $area, representado en JSON.
*/
