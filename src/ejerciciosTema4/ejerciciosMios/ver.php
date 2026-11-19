<?php
if (isset($_COOKIE["usuario"])) {
    echo "Bienvenida ". $_COOKIE["usuario"];
}else{
    echo "No hay ningún usuario guardado";
}
