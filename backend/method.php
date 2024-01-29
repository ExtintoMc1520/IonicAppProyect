<?php
require "config/Conexion.php";

// Verificar el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Consulta SQL para seleccionar datos de la tabla
        $sql = "SELECT id, nombre, genero, temporada, capitulos FROM serie";

        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            // Devolver los resultados en formato JSON
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla.";
        }
        break;

    case 'POST':
        // Verificar si es una solicitud POST
        if ($method === 'POST') {
            // Recibir los datos del formulario HTML
            $nombre = $_POST['nombre'];
            $genero = $_POST['genero'];
            $temporada = $_POST['temporada'];
            $capitulos = $_POST['capitulos'];

            // Insertar los datos en la tabla
            $sql = "INSERT INTO serie (nombre, genero, temporada, capitulos) VALUES ('$nombre', '$genero','$temporada', '$capitulos')"; // Reemplaza con el nombre de tu tabla

            if ($conexion->query($sql) === TRUE) {
                echo "Datos insertados con éxito.";
            } else {
                echo "Error al insertar datos: " . $conexion->error;
            }
        } else {
            echo "Esta API solo admite solicitudes POST.";
        }
        break;

    case 'PATCH':
        // Verificar si es una solicitud PATCH
        if ($method === 'PATCH') {
            parse_str(file_get_contents("php://input"), $datos);

            $id = $datos['id'];
            $nombre = $datos['nombre'];
            $genero = $datos['genero'];
            $temporada = $datos['temporada'];
            $capitulos = $datos['capitulos'];

            // Lógica de actualización
            $actualizaciones = array();
            if (!empty($nombre)) {
                $actualizaciones[] = "nombre = '$nombre'";
            }
            if (!empty($genero)) {
                $actualizaciones[] = "genero = '$genero'";
            }
            if (!empty($temporada)) {
                $actualizaciones[] = "temporada = '$temporada'";
            }
            if (!empty($capitulos)) {
                $actualizaciones[] = "capitulos = '$capitulos'";
            }

            $actualizaciones_str = implode(', ', $actualizaciones);
            $sql = "UPDATE serie SET $actualizaciones_str WHERE id = $id";

            if ($conexion->query($sql) === TRUE) {
                echo "Registro actualizado con éxito.";
            } else {
                echo "Error al actualizar registro: " . $conexion->error;
            }
        } else {
            echo "Método de solicitud no válido.";
        }
        break;

    case 'PUT':
        // Verificar si es una solicitud PUT
        if ($method === 'PUT') {
            parse_str(file_get_contents("php://input"), $datos);

            $id = $datos['id'];
            $nombre = $datos['nombre'];
            $genero = $datos['genero'];
            $temporada = $datos['temporada'];
            $capitulos = $datos['capitulos'];

            // Lógica de actualización
            $sql = "UPDATE serie SET nombre = '$nombre', genero = '$genero', temporada = '$temporada', capitulos = '$capitulos'  WHERE id = $id";

            if ($conexion->query($sql) === TRUE) {
                echo "Registro actualizado con éxito.";
            } else {
                echo "Error al actualizar registro: " . $conexion->error;
            }
        } else {
            echo "Método de solicitud no válido.";
        }
        break;

    case 'DELETE':
        // Verificar si es una solicitud DELETE
        if ($method === 'DELETE') {
            // Procesar solicitud DELETE
            $id = $_GET['id'];
            $sql = "DELETE FROM serie WHERE id = $id";

            if ($conexion->query($sql) === TRUE) {
                echo "Registro eliminado con éxito.";
            } else {
                echo "Error al eliminar registro: " . $conexion->error;
            }
        } else {
            echo "Método de solicitud no válido.";
        }
        break;

    default:
        echo 'undefined request type!';
}

// Cerrar conexión
$conexion->close();

