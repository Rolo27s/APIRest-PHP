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
		if (isset($_GET["id"]) && $_GET["id"] != "") {
			// 1º pido los datos al S.W.
			$con = fopen(URL_S_WEB . "?id=" . $_GET["id"], "r");
			$res = "";
			while (!feof($con)) {
				$car = fgetc($con);
				$res .= $car;
			}
			fclose($con);
			$datos = json_decode($res, true)[0];
	?>
			<h1>Editar municipio</h1>
			<form method="post">
				<input name="id" type="hidden" value="<?php echo $datos["id"] ?>" />

				Nombre: <input name="nombre" value="<?php echo $datos["nombre"] ?>" /><br />

				Provincia:
				<select name="provincia">
					<option <?php if ($datos["provincia"] == "Almería") echo "selected" ?>>Almería</option>
					<option <?php if ($datos["provincia"] == "Cádiz")   echo "selected" ?>>Cádiz</option>
					<option <?php if ($datos["provincia"] == "Córdoba") echo "selected" ?>>Córdoba</option>
					<option <?php if ($datos["provincia"] == "Granada") echo "selected" ?>>Granada</option>
					<option <?php if ($datos["provincia"] == "Huelva")  echo "selected" ?>>Huelva</option>
					<option <?php if ($datos["provincia"] == "Jaén")    echo "selected" ?>>Jaén</option>
					<option <?php if ($datos["provincia"] == "Málaga")  echo "selected" ?>>Málaga</option>
					<option <?php if ($datos["provincia"] == "Sevilla") echo "selected" ?>>Sevilla</option>
				</select>
				<br />

				Población: <input name="poblacion" type="number" min="0" value="<?php echo $datos["poblacion"] ?>" /><br />

				<button>Editar</button>
			</form>
	<?php
		} else {
			echo "<strong>Error, falta el parametro 'id' del municipio a editar</strong>";
		}
	} else if ($_SERVER["REQUEST_METHOD"] == "POST") {	// añadir un municipio
		echo "<h1>Procesar editar municipio</h1>";
		$url = URL_S_WEB . "?id=" . $_POST["id"];
		$url .= "&nombre=" . urlencode($_POST["nombre"]);
		$url .= "&provincia=" . urlencode($_POST["provincia"]);
		$url .= "&poblacion=" . urlencode($_POST["poblacion"]);

		// preparo la petición con los datos por $_GET
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");		// esto hace que sea PUT
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		// le digo que espero respuesta
		$json_response = curl_exec($ch);		// lanzo la petición

		// si la respuesta es erronea (devuelve FALSE)
		if ($json_response === false) {
			echo "<p>Error en la solicitud al servicio web: " . curl_error($ch) . "</p>";
		} else {
			// sino, fue bien... decodifico el JSON
			$data = json_decode($json_response, true);
			// si hay datos y esos datos traen el campo esperado...
			if ($data && isset($data["filas_modificadas"])) {
				$resultado = $data["filas_modificadas"];
				echo "<p>Se han editado $resultado filas</p>";
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