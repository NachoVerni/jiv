<?php
	function fc_log($msg = "empty")
	{
		$fecha_log	= date('Y-m-d');
		$hora_log	= date('H:i:s');

		if(is_string($msg)) {
			$mensaje = $msg; 
		}
		else{
			$mensaje = var_export($msg, true); //el true es para que no lo imprima en pantalla
		}

		//Verificar que exista la carpeta de log, sino crearla
	    if (!file_exists(__DIR__."/../../log/")) {
	        mkdir(__DIR__."/../../log/");
	    }

		$nombre_archivo = 'log_'.$fecha_log.'.log';
		$ruta = __DIR__."/../../log/";
		$ruta_completa = $ruta.$nombre_archivo;
		
		$linea = "HORA: ".$hora_log.PHP_EOL."    LOG: ".$mensaje.PHP_EOL.PHP_EOL;
	    file_put_contents($ruta_completa, $linea, FILE_APPEND);
	    chmod($ruta_completa, 0600);
	}
?>