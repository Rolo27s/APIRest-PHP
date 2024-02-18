<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usar Servicio Web con B.DD.</title>
	<style>
		table {
			border: 1px solid black;
			padding: 2px 5px;
			min-width: 500 px;
		}

		tr,
		td {
			border: 1px solid black;
			padding: 2px 5px;
		}

		th {
			border: 1px solid black;
			padding: 2px 5px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<?php
	require_once("REST_bd_datos.php");

	$url = URL_S_WEB;
	// miro si es filtro o todos
	if (isset($_GET["provincia"]) && $_GET["provincia"] != "") {
		// es filtro, lo añado
		$url .= "?provincia=" . $_GET["provincia"];
	}
	// abro la conexión GET... sí, es como abrir un archivo
	$con = fopen($url, "r");
	$res = "";
	// mientras haya datos...
	while (!feof($con)) {
		// leo caracter a caracter (hay otras formas posibles)
		$car = fgetc($con);
		$res .= $car;
	}
	// cierro la conexión... SIEMPRE!
	fclose($con);
	// como es un JSON, lo decodifico
	$res = json_decode($res, true);
	?>
	<br /><br /><br /><br />
	<div style="width:75%; margin: 0 auto;">
		<span><button onclick="location='REST_bd_Andalucia_mostrar.php'">Mostrar todos</button></span>
		<br />
		<span><button onclick="location='REST_bd_Andalucia_nuevo.php'">Nuevo</button></span>
		<br />
		<span>
			<form>
				Provincia:
				<select name="provincia" />
				<option <?php if ($_GET["provincia"] == "Almería") echo "selected" ?>>Almería</option>
				<option <?php if ($_GET["provincia"] == "Cádiz")   echo "selected" ?>>Cádiz</option>
				<option <?php if ($_GET["provincia"] == "Córdoba") echo "selected" ?>>Córdoba</option>
				<option <?php if ($_GET["provincia"] == "Granada") echo "selected" ?>>Granada</option>
				<option <?php if ($_GET["provincia"] == "Huelva")  echo "selected" ?>>Huelva</option>
				<option <?php if ($_GET["provincia"] == "Jaén")    echo "selected" ?>>Jaén</option>
				<option <?php if ($_GET["provincia"] == "Málaga")  echo "selected" ?>>Málaga</option>
				<option <?php if ($_GET["provincia"] == "Sevilla") echo "selected" ?>>Sevilla</option>
				</select>
				<button>Filtrar</button>
			</form>
		</span>
		<br />
		<?php
		echo "<table><tr><th>Nombre</th><th>Provincia</th><th>Población</th><th>Acciones</th></tr>\n";
		foreach ($res as $pobl) {
			echo "<tr><td>{$pobl['nombre']}</td><td>{$pobl['provincia']}</td><td>{$pobl['poblacion']}</td><td>\n";
			echo "<button onclick=\"location='REST_bd_Andalucia_editar.php?id={$pobl['id']}'\">Editar</button>\n";
			echo "<button onclick=\"location='REST_bd_Andalucia_borrar.php?id={$pobl['id']}'\">Borrar</button>\n";
			echo "</td></tr>\n";
		}
		echo "</table>\n\n";
		?>
	</div>
</body>

</html>