<?php

define("HTTP_OK", 200);
define("HTTP_BAD_REQUEST", 400);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    mostrarAyuda();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    procesarSolicitud();
} else {
    header("HTTP/1.1 " . HTTP_BAD_REQUEST);
}

function mostrarAyuda()
{
    header("HTTP/1.1 " . HTTP_OK);
    $respuesta = array(
        array(
            "metodo" => "GET",
            "descripción" => "Muestra esta ayuda / descripción",
        ),
        array(
            "metodo" => "POST",
            "descripción" => "Recibe dos números decimales y calcula elevar el primero al segundo",
            "parámetros" => array(
                "base" => "Número que será multiplicado para la potencia",
                "exponente" => "Número de veces que se multiplicará la base",
            ),
        ),
    );
    echo json_encode($respuesta);
}

function procesarSolicitud()
{
    if (!isset($_POST["base"]) || !isset($_POST["exponente"])) {
        responderError(1, "Faltan parámetros");
        return;
    }

    $base = $_POST["base"];
    $exponente = $_POST["exponente"];

    if (!is_numeric($base) || !is_numeric($exponente)) {
        responderError(2, "Los parámetros deben ser números");
        return;
    }

    $resultado = pow($base, $exponente);
    responderExitoso($resultado);
}

function responderError($codigo, $descripcion)
{
    header("HTTP/1.1 " . HTTP_BAD_REQUEST);
    $respuesta = array(
        "codigo" => $codigo,
        "descripcion" => $descripcion,
    );
    echo json_encode($respuesta);
}

function responderExitoso($resultado)
{
    header("HTTP/1.1 " . HTTP_OK);
    $respuesta = array(
        "codigo" => 0,
        "resultado" => $resultado,
    );
    echo json_encode($respuesta);
}
