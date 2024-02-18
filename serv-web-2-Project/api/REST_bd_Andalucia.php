<?php

/**
 *	GET      => Muestra todos los municipios de la b.dd.
 *	GET[pr.] => Muestra todos los municipios de la b.dd. de una provincia
 *	GET[id]  => Muestra el municipio de la b.dd. con la id pasada
 *	POST     => Inserta un municipio en la b.dd.
 *	PUT      => Modifica un municipio en la b.dd.
 *	DELETE   => Borra un municipio en la b.dd.
 */
require_once("REST_bd_datos.php");
require_once("REST_bd.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        mostrarMunicipio($_GET);
    } else if (isset($_GET["provincia"]) && $_GET["provincia"] != "") {
        mostrarProvincia($_GET);
    } else {
        mostrarTodos();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    crearMunicipio($_POST);
} else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    modificarMunicipio($_GET);        // si, $_GET, no es $_PUT porque no existe

} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    borrarMunicipio($_GET);            // si, $_GET, no es $_DELETE porque no existe

} else {  // si no es ningún método autorizado
    header("HTTP/1.1 400 Bad Request");
}


function mostrarTodos()
{
    $bd = new BaseDatosAndalucia();
    $todos = $bd->cargarTodosMunicipios();
    header("HTTP/1.1 200 OK");
    echo json_encode($todos);
}

function mostrarMunicipio($datos)
{
    $bd = new BaseDatosAndalucia();
    $municipio = $bd->cargarMunicipio($datos);
    header("HTTP/1.1 200 OK");
    echo json_encode($municipio);
}

function mostrarProvincia($datos)
{
    $bd = new BaseDatosAndalucia();
    $municipios = $bd->cargarAlgunosMunicipios($datos);
    header("HTTP/1.1 200 OK");
    echo json_encode($municipios);
}

function crearMunicipio($datos)
{
    $bd = new BaseDatosAndalucia();
    $res = array("filas_creadas" => $bd->guardarMunicipio($datos));
    header("HTTP/1.1 200 OK");
    echo json_encode($res);
}

function modificarMunicipio($datos)
{
    $bd = new BaseDatosAndalucia();
    $res = array("filas_modificadas" => $bd->modificarMunicipio($datos));
    header("HTTP/1.1 200 OK");
    echo json_encode($res);
}

function borrarMunicipio($datos)
{
    $bd = new BaseDatosAndalucia();
    $res = array("filas_borradas" => $bd->borrarMunicipio($datos));
    header("HTTP/1.1 200 OK");
    echo json_encode($res);
}
