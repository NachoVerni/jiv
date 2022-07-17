<?php
    if(session_status() === PHP_SESSION_NONE) session_start();

    $sesion_id                  = $_SESSION[$SESION."id"]                   ?? 0;
    $sesion_permisos            = $_SESSION[$SESION."permisos"]             ?? 0;

    $sesion_esta_logueado  = ($sesion_id > 0);
    $sesion_es_admin       = $sesion_esta_logueado && ($sesion_permisos >= 99);
?>