<?php include("config.php"); ?>
<?php include("contenido/includes/db.php"); ?>

<?php
    //GET
    if(isset($_GET["clave"]))     $clave        = $_GET["clave"];         else $clave       = "";
?>

<?php
    //CONFIGURACION
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $fecha  = date('Y-m-d');
    $hora   = date('H:i:s');
?>

<?php
    echo "<div style='text-align: center; padding-top: 4%; padding-left: 5%; padding-right: 5%;'>";
    echo "<h2 style='margin-bottom: 4%;'>Panel de migraciones</h2>";
?>

<?php

    //Verificar si se recibió por GET la clave correcta que permite ejecutar las migraciones
    $ejecutar = false;
    if($clave == "1234")
        $ejecutar = true;

    //Buscar todos los archivos dentro de la carpeta que contiene las migraciones
    $archivos_migraciones = scandir('contenido/migraciones');
    $archivos_sin_migrar  = 0;

    //Verificar con esta query que la tabla de "Migraciones" exista
    $sql = "SELECT 1 FROM Migraciones LIMIT 1";
    $resultado = $conn->query($sql);

    if(!$resultado)
    {
        //La tabla de "Migraciones" no existe, creamos la tabla
        echo "<span style='color: #4669cf;'><br>INICIO: Agregar tabla de migraciones";
        $sql = "CREATE TABLE IF NOT EXISTS Migraciones (id int(11) NOT NULL AUTO_INCREMENT, nombre varchar(100) NOT NULL, numero int(11) NOT NULL, fecha_creacion varchar(10) NOT NULL, hora_creacion varchar(8) NOT NULL, PRIMARY KEY (id)) ENGINE=InnoDB  DEFAULT CHARSET=latin1";
        $conn->query($sql);
        echo "<br>FIN: Agregar tabla de migraciones</span><br><br><br><br>";
    }

    echo "<hr>";

    //Buscar el número más grande que tengan las migraciones anteriores
    $sql = "SELECT COALESCE((MAX(numero) + 1), 1) AS max FROM Migraciones";
    $resultado = mysqli_fetch_array($conn->query($sql));

    if(!is_null($resultado))
    {
        $numero = $resultado["max"];

        //Recorrer cada uno de los archivos de la carpeta migraciones
        foreach ($archivos_migraciones as $archivo_migracion) 
        {
            if (stripos($archivo_migracion, "php")) 
            {
                $nombre = str_replace(".php", "", $archivo_migracion);

                //Buscar si existe una migracion cuyo nombre coincida con el nombre del archivo
                $sql = "SELECT * FROM Migraciones WHERE nombre = '$nombre'";
                $migracion = mysqli_fetch_array($conn->query($sql));

                if(is_null($migracion))
                {
                    //La migración todavía no fue ejecutada
                    $archivos_sin_migrar++;
                    
                    if($ejecutar)
                    {
                        //Hay que ejecutar la migración
                        try
                        {
                            echo "<br>Ejecutando migración <b>".$nombre."...</b>";

                            $incluir = "contenido/migraciones/".$nombre.".php";

                            $migracion_exitosa = false; //Esta variables si todo va bien se debe sobreescribir dentro del siguiente include luego de la query:
                            include($incluir);
                            
                            if($migracion_exitosa)
                            {
                                $sql = "INSERT INTO Migraciones (nombre, numero, fecha_creacion, hora_creacion) VALUES ('$nombre', $numero, '$fecha', '$hora')";
                                $resultado = $conn->query($sql);

                                if($resultado)
                                {
                                    echo "<br><b style='color: #2c9a21;'>Migración OK</b>";
                                }
                                else
                                {
                                    echo "<br><b style='color: #cf4646;'>ERROR (MySQL Guardar): No se ha podido guardar la migración.</b>";
                                    echo "<br>".$conn->error;
                                    break;
                                }
                            }
                            else
                            {
                                echo "<br><b style='color: #cf4646;'>ERROR (MySQL Ejecutar): No se ha podido ejecutar la migración.</b>";
                                    echo "<br>".$conn->error;
                                break;
                            }
                        }
                        catch (Throwable $e) 
                        { 
                            echo "<br>ERROR (PHP Throwable): No se ha podido ejecutar. Detalle: <br><br>".$e."<br><br>";
                            echo "<br>".$conn->error;
                            break;
                        }
                        catch(Exception $e)
                        {
                            echo "<br>ERROR (PHP Exception): No se ha podido ejecutar. Detalle: <br><br>".$e."<br><br>";
                            echo "<br>".$conn->error;
                            break;
                        }
                    }
                    else
                    {
                        echo "La migración <b>".$nombre."</b> está pendiente.";
                    }

                    echo "<hr>";
                }
            }
        }
    }
    else
    {
        echo "<br><b style='color: #cf4646;'>ERROR (MySQL Buscar Número Máximo): No se ha podido preparar la migración.</b>";
    }

    if ($archivos_sin_migrar == 0) 
    {
        echo "<br><h3 style='color: #2c9a21;'>Excelente! No hay migraciones pendientes</h3>";
    }

?>

<?php
    echo "</div>";
?>