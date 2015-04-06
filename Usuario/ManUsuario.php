<!DOCTYPE HTML>
<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/transact/sessioncheck.php";
include $path;
session();
?>
<html lang="es">
    <head>
        
        <title>Registrar Usuario</title>
         <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet"  href="../../../css/themes/default/jquery.mobile-1.3.0-beta.1.css">
        <link rel="stylesheet" href="../_assets/css/jqm-docs.css"/>

        <link rel="stylesheet" href="/resources/demos/style.css" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


        <script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../js/jquery.validate.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <script src="../../../js/jquery.mobile-1.3.0-beta.1.js"></script>
        <script src="../../docs/_assets/js/jqm-docs.js"></script>
        <script src="../jquery.mobile.validate.js" type="text/javascript"></script>

    </head>
    <body>


                <?php
                include "../menu.html";
                ?>
             <div data-role="content">

                <form name="RegPais" method="POST" id="regUsu">
                    <p><label>Registrar Usuario</label></p>
                    <div class="etiq"><label>Nombre de Usuario:</label></div>
                    <div class="caTex"><input type="text" id="nomUsu" name="nomUsu" value="" size="5" /></div><br>
                    <div class="etiq"><label>Contraseña:</label></div>
                    <div class="caTex"><input type="password" id="passUsu" name="passUsu" value="" size="25" /></div><br/><br/>
                    <div class="etiq"><label>Reescribir Contraseña:</label></div>
                    <div class="caTex"><input type="password" id="conpassUsu" name="conpassUsu" value="" size="25" /></div><br/><br/>
                    <div class="etiq"><label>Email:</label></div>
                    <div class="caTex"><input type="text" id="emailUsu" name="emailUsu" value="" size="25" /></div><br/><br/>

                    <p>
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" />
					<a href="mostraUsuario.php"><button type="button">Regresar</button></a>
                    </p>

                    <?php
                    if (!empty($_POST)) {
                        $array = array();
                        foreach ($_POST as $param_name => $param_val) {
                            $array[] = $param_val;
                        }
                        include '../transact/conectDB.php';

                        $link = conectar();
                        mysql_query("insert into usuarios (usuario, contrasena, correo) values('$array[0]', '$array[1]', '$array[3]')", $link);
                        mysql_close($link);
                        echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='mostraUsuario.php'> Ver Catalogo de Usuarios</a>";
                    }
                    ?>

                </form>

            </div>
        </div>    

      
    </body>
</html>
