<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION['usuario'])) {
    if (!empty($_POST)) {
        $usuario = $_POST['txtusuario'];
        $password = $_POST['txtpassword'];
        include 'transact/conectDB.php';
        $link = conectar();
        $query = "SELECT usuario, contrasena FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$password'";
        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
        if (mysql_fetch_row($result)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: main.php");
        } else {
            echo('Usuario o password incorrecto');
        }
    }
} else {
    header("Location: main.php");
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>LOGIN</title>
        <style type="text/css">
            form{

                border-radius: 12px;
                border: 1px solid #C7C7C7;
                background-color: #8EA7CC;
                padding: 20px;
                width: 550px;

                margin: auto;
            }
            body {background: #C0D9D9 url("../images/fondBody.jpg") repeat; font-family: Arial,Helvetica;    font-size: large;}
        </style>
    </head>
    <body>
    <center>
        <font  color="black">
        <h1> LOGIN</h1>
        </font>
    </center>
    <br>
    <form method="POST">
        <center>
            <table>
                <tr>
                    <td>Usuario:</td><td><input type="text" name="txtusuario"></td><br>
                </tr>
                <tr>
                    <td>Contraseña:</td><td><input type="password" name="txtpassword"></td>
                </tr>
            </table>
            <br>
             <input type="submit" value="Acceder">
        </center>

       

    </form>


</body>
</html>