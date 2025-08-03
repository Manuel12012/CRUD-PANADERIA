<?php

// Creamos la funcion para conectar la base de datos
function conectarDB(){
$db = mysqli_connect("localhost", "root", "","db_panaderia");

// Si la conexion falla mostrara error
if(!$db){
    echo "No se puedo conectar a la base de datos";
    exit;

    
}
return $db;

}