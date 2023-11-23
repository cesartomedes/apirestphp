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
print_r($metodo);

switch($metodo)
{

        // select
        case 'GET':
        echo ' consulta de registros - GET';
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