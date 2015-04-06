<?php

function session() {
    if (empty($_SESSION['usuario'])) {
        header("Location: /index.php");
        die();
    } else {
        if (isset($_GET['action']) && $_GET['action'] == "logout") {
            unset($_SESSION['usuario']);
            header("Location: /index.php");
        }
    }
}

function bienvenida() {
    echo ('Bienvenido, <b>' . $_SESSION["usuario"] . '</b> [<a href="?action=logout" data-ajax="false">Salir</a>]');
}
