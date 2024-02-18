<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usar Servicio Web con B.DD.</title>
</head>

<body>
	<?php
	require_once("REST_bd_datos.php");

	if ($_SERVER["REQUEST_METHOD"] == "GET") {	// muestra el formulario
	?>
		<h1>Añadir municipio</h1>
		<form method="post">
			Nombre: <input name="nombre" /><br />

			Provincia:
			<select name="provincia" />
			<option>Almería</option>
			<option>Cádiz</option>
			<option>Córdoba</option>
			<option>Granada</option>
			<option>Huelva</option>
			<option>Jaén</option>
			<option>Málaga</option>
			<option>Sevilla</option>
			</select>
			<br />

			Población: <input name="poblacion" type="number" min="0" /><br />

			<button>Crear</button>
		</form>
	<?php
	} else if ($_SERVER["REQUEST_METHOD"] == "POST") {	// añadir un municipio
		echo "<h1>Procesar añadir municipio</h1>";

		// preparo la petición
		$ch = curl_init(URL_S_WEB);
		curl_setopt($ch, CURLOPT_POST, 1);		// esto hace que sea POST
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);	// aquí se le mandan los datos en modo POST
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// le digo que espero respuesta
		$json_response = curl_exec($ch);		// lanzo la petición

		// si la respuesta es erronea (devuelve FALSE)
		if ($json_response === false) {
			echo "<p>Error en la solicitud al servicio web: " . curl_error($ch) . "</p>";
		} else {
			// sino, fue bien... decodifico el JSON
			$data = json_decode($json_response, true);
			// si hay datos y esos datos traen el campo esperado...
			if ($data && isset($data["filas_creadas"])) {
				$resultado = $data["filas_creadas"];
				echo "<p>Se han creado $resultado filas</p>";
			} else {	// no hay datos o no traen el campo esperado
				echo "<p>No se pudo obtener el resultado del servicio web.</p>";
			}
		}
		// cierro el canal de comunicación
		curl_close($ch);
	}
	?>
	<br /><br /><br />
	<a href="REST_bd_Andalucia_mostrar.php">Volver al listado</a>
</body>

</html>