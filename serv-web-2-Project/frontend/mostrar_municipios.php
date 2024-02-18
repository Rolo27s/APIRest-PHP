<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mostrar Municipios</title>
</head>

<body>
    <?php
    require_once("../api/REST_bd_datos.php");

    // Obtener la URL para la solicitud al servicio web
    $url = URL_S_WEB;
    if (isset($_GET["provincia"]) && $_GET["provincia"] != "") {
        $url .= "?provincia=" . urlencode($_GET["provincia"]);
    }

    // Realizar la solicitud GET al servicio web para obtener los municipios
    $json_response = file_get_contents($url);
    $municipios = json_decode($json_response, true);

    // Verificar si se obtuvieron los municipios correctamente
    if ($municipios === null) {
        echo "<p>No se pudo obtener la lista de municipios.</p>";
    } else {
        // Mostrar el formulario de filtrado por provincia
    ?>
        <h1>Lista de municipios</h1>
        <div>
            <span>
                <form>
                    Provincia:
                    <select name="provincia">
                        <option value="">Todas</option>
                        <?php
                        // Generar opciones para el filtro por provincia
                        $provincias = ["Almería", "Cádiz", "Córdoba", "Granada", "Huelva", "Jaén", "Málaga", "Sevilla"];
                        foreach ($provincias as $provincia) {
                            $selected = isset($_GET["provincia"]) && $_GET["provincia"] == $provincia ? "selected" : "";
                            echo "<option value='$provincia' $selected>$provincia</option>";
                        }
                        ?>
                    </select>
                    <button>Filtrar</button>
                </form>
            </span><br />

            <?php
            // Mostrar la tabla de municipios
            echo "<table><tr><th>Nombre</th><th>Provincia</th><th>Población</th><th>Acciones</th></tr>\n";
            foreach ($municipios as $municipio) {
                echo "<tr><td>{$municipio['nombre']}</td><td>{$municipio['provincia']}</td><td>{$municipio['poblacion']}</td><td>\n";
                echo "<button onclick=\"window.location.href='editar_municipio.php?id={$municipio['id']}'\">Editar</button>\n";
                echo "<button onclick=\"confirmarBorrado({$municipio['id']})\">Borrar</button>\n";
                echo "</td></tr>\n";
            }
            echo "</table>\n\n";
            ?>
            <span><a href="agregar_municipio.php">Añadir nuevo Municipio</a></span><br />
        </div>
    <?php } ?>
    <script>
        function confirmarBorrado(id) {
            if (confirm("¿Está seguro de borrar este registro?")) {
                // Si el usuario confirma, redirige a la página de borrado con el ID del municipio
                window.location.href = "borrar_municipio.php?id=" + id;
            }
        }
    </script>
</body>

</html>