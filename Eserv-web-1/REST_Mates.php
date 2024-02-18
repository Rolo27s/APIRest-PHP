<?php

/**
 *	GET  => ayuda / explicación del servicio web
 *	POST => potencia de 2 números
 */
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	header("HTTP/1.1 200 OK");
	$respuesta = array(
		array(
			"metodo"      => "GET",
			"descripción" => "Muestra esta ayuda / descripción",
		),
		array(
			"metodo"      => "POST",
			"descripción" => "recibe dos números decimales y calcula elevar el primero al segundo",
			"parámetros"  => array(
				"base"      => "Número que será multiplicado para la potencia",
				"exponente" => "Número de veces que se multiplicará la base",
			),
		),
	);
	echo json_encode($respuesta);
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!isset($_POST["base"])) {
		$respuesta = array(
			"codigo"      => 1,
			"descripcion" => "Falta el parámetro 'base'",
		);
	} else if (!isset($_POST["exponente"])) {
		$respuesta = array(
			"codigo"      => 2,
			"descripcion" => "Falta el parámetro 'exponente'",
		);
	} else if (!is_numeric($_POST["base"])) {
		$respuesta = array(
			"codigo"      => 3,
			"descripcion" => "El parámetro 'base' no es un número real",
		);
	} else if (!is_numeric($_POST["exponente"])) {
		$respuesta = array(
			"codigo"      => 4,
			"descripcion" => "El parámetro 'exponente' no es un número real",
		);
	} else {	// no hay errores en los datos...
		$base      = $_POST["base"];
		$exponente = $_POST["exponente"];
		$respuesta = array(
			"codigo"    => 0,
			"resultado" => pow($base, $exponente),
		);
	}
	// se codifica la respuesta en JSON y se devuelve
	header("HTTP/1.1 200 OK");
	echo json_encode($respuesta);
} else {  // si no es GET o POST...
	header("HTTP/1.1 400 Bad Request");
}
