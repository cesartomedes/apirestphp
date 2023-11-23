<?php

$host="localhost";

$usuario = "root";

$password = "";

$basededatos = "api";

$conexion = new mysqli($host, $usuario, $password, $basededatos);

if ($conexion->connect_error) {
    die ('conexion no establecida'. $conexion->connect_error);
}

header('Content-type: application/json');
$metodo = $_SERVER['REQUEST_METHOD'];

switch($metodo)
{

        // select
        case 'GET':
        consultaSelect($conexion);
        break;

        // insert
        case 'POST':
        echo ' insercion de registros - POST';
        break;    
        
        //update
        case 'PUT':
        echo ' edicion de registros - PUT';
        break;    
        
        //delete
        case 'DELETE':
        echo ' borrado de registros - DELETE';
        break;    

        default:
        echo ' Metodo no permitido';
        break;
}

function consultaSelect($conexion){
    $sql = 'SELECT * FROM usuarios';
    $resultado = $conexion->query($sql);

    if ($resultado) {
        $datos = array();

        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        echo json_encode($datos);
    }
}