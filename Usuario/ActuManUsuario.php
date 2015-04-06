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
        
        <title>Actualizar Usuario</title>
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
            <?php
            include '../transact/conectDB.php';
            $link = conectar();

            if (isset($_REQUEST["id"])) {
                if (isset($_REQUEST["Editar"])) {

                    extract($_REQUEST);
                    $queryw = "select id from usuarios where usuario = '$usuario' and contrasena = '$antigua'";
                    $resultw = mysql_query($queryw, $link) or die($sql . ">>" . mysql . error());

                    if (mysql_num_rows($resultw)) {
                        $queryx = "update usuarios set usuario ='$usuario', contrasena='$contrasena', correo='$correo' where id=$id";
                        $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                        if ($resultx) {
                            echo "<h2 color:blue><p><center>El Registro  se ha modificado...</center></p></h2>";
                        }
                    } else {
                        echo "<h2 color:blue><p><center>Contraseña incorrecta</center></p></h2>";
                    }
                }
            }

            $id = $_REQUEST["id"];

            $queryz = "select id, usuario, contrasena, correo from usuarios
            where id=$id";
            //Realizando el query a la base de datos
            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());


            //Determinando el query a la base de datos
            $num = mysql_num_rows($resultz);

            if ($num > 0) { //Verificamos si hay mas de 0 filas
                $row = mysql_fetch_assoc($resultz);
                extract($row);
            }
            ?>
            

                <form name="RegPais" method="POST" id="actuUsu">
                    <p><label>Registrar Usuario</label></p>
                    <div class="etiq"><label>ID de Usuario:</label></div>
                    <div class="caTex"><input type="text" id="id" name="id" value="<?php echo $id; ?>" size="5" disabled/></div><br>
                    <div class="etiq"><label>Nombre de Usuario:</label></div>
                    <div class="caTex"><input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" size="5" /></div><br>
                    <div class="etiq"><label>Antigua Contrasena:</label></div>
                    <div class="caTex"><input type="password" id="antigua" name="antigua" value="" size="25" /></div><br/><br/>
                    <div class="etiq"><label>Nueva Contrasena:</label></div>
                    <div class="caTex"><input type="password" id="contrasena" name="contrasena" value="" size="25" /></div><br/><br/>
                    <div class="etiq"><label>Reescribir Contrasena:</label></div>
                    <div class="caTex"><input type="password" id="conpassUsu" name="conpassUsu" value="" size="25" /></div><br/><br/>
                    <div class="etiq"><label>Email:</label></div>
                    <div class="caTex"><input type="text" id="correo" name="correo" value="<?php echo $correo; ?>" size="25" /></div><br/><br/>

                    <p>
                        <input type="submit" value="Editar" name="Editar"/>
                        <input type="reset" value="Cancelar" name="canPro" />
                        <a href="mostraUsuario.php"><button type="button">Regresar</button></a>
                    </p>



                </form>

            </div>
        </div>    

       
    </body>
</html>
