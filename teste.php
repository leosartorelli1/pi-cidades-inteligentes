<?php
    if (!extension_loaded("mongodb")){
        die("A extensão MongoDB não está instalada.");
    } else{
        echo("Driver Instalado!!!");
    }
?>