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

$path = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';

$buscardId = explode('/', $path);

$id = ($path!=='/') ? end($buscardId):null;

switch($metodo)
{

        // select
        case 'GET':
        consulta($conexion, $id);
        break;

        // insert
        case 'POST':
        insertar($conexion);
        echo ' insercion de registros - POST';
        break;    
        
        //update
        case 'PUT':
        actualizar($conexion, $id);
        break;    
        
        //delete
        case 'DELETE':
        borrar($conexion, $id);
        break;    

        default:
        echo ' Metodo no permitido';
        break;
}

function consulta($conexion, $id){
    $sql=($id===null) ? "SELECT * FROM usuarios":"SELECT * FROM usuarios WHERE id=$id";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        $datos = array();

        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        echo json_encode($datos);
    }
}

function insertar($conexion){
    $dato = json_decode(file_get_contents('php://input'), true);

    $nombre = $dato['nombre'];

    print_r($nombre);

    $sql = "INSERT INTO usuarios(nombre) VALUES ('$nombre')";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        $dato['id'] = $conexion->insert_id;

        echo json_encode($dato);
    }else{
        echo json_encode(array('error'=> 'error al registrar un usuario'));
    }

}
    function borrar($conexion, $id){
        echo "el id a borrar es: ".$id;

        $sql = "DELETE FROM usuarios WHERE id=$id";
        $resultado = $conexion->query($sql);
    
        if ($resultado) {
            echo json_encode(array('MENSAJE'=> 'Usuario eliminado'));
        }else{
            echo json_encode(array('error'=> 'error al borrar un usuario'));
        }

}

function actualizar($conexion, $id){

    $dato = json_decode(file_get_contents('php://input'), true);

    $nombre = $dato['nombre'];
    echo "el id a editar es: " .$id. " con el nombre ".$nombre; 

    $sql = "UPDATE usuarios SET nombre = '$nombre' WHERE id = '$id'";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        echo json_encode(array('MENSAJE'=> ' Usuario editado'));
    }else{
        echo json_encode(array('error'=> ' error al editar un usuario'));
    }


    
}
