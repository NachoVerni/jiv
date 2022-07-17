<?php
    $conn = mysqli_connect($DB_DIRECCION, $DB_USUARIO, $DB_CLAVE, $DB_NOMBRE, $DB_PUERTO);
    if($conn == false)
    {
    	die('no se pudo establecer conexion con la base de datos'.mysqli_connect_error());
    }
    $conn->set_charset("utf8");//IMPORTATE, esto es para que si se reciben caracteres UTF-8, es decir, acentos, ñ, etc al momento de leer las variables de entrada del POST, por ejemplo $_POST['variable'] se puedan escribir en la base de datos al INSERT todos los caracteres de 'variables' sin problemas.

    if($conn->connect_error) 
    {
        die("Connection failed: ".$conn->connect_error);
    }

    $sql = "SET SESSION time_zone = '-3:00'";
    $conn->query($sql);
    if($conn->error) 
    {
        die("timezone set failed: ".$conn->error);
    }
?>