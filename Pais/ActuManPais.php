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
        
        <title>Registrar País</title>
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

            if (isset($_REQUEST["NumPais"])) {
                if (isset($_REQUEST["Editar"])) {

                    extract($_REQUEST);
                    //Modificamos el registro del usuario
                    $queryx = "update pais  set NomPais ='$NomPais ' where NumPais='$NumPais'";
                    $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                    if ($resultx) {
                        echo "<h2 color:blue><p><center>El Registro  se ha modificado...</center></p></h2>";
                    }
                }
            }

            $NumPais = $_REQUEST["NumPais"];

            $queryz = "select NumPais, NomPais  from pais
            where NumPais='$NumPais'";
            //Realizando el query a la base de datos
            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());


            //Determinando el query a la base de datos
            $num = mysql_num_rows($resultz);

            if ($num > 0) { //Verificamos si hay mas de 0 filas
                $row = mysql_fetch_assoc($resultz);
                extract($row);
            }
            ?>
       

                <form name="RegPais" method="POST" id="regPais">
                    <p><label>Registrar país</label></p>
                    <div class="etiq"><label>No país*:</label></div>
                    <div class="caTex"><input type="text" id="NumPais" name="NumPais" value="<?php echo $NumPais; ?>" size="5" disabled/></div><br>
                    <div class="etiq"><label>Nombre del país*:</label></div>
                    <div class="caTex"><input type="text" id="NomPais" name="NomPais" value="<?php echo $NomPais; ?>" size="25" autofocus/></div><br/><br/>

                    <p>
                        <input type="submit" value="Editar" name="Editar"/>
                        <input type="reset" value="Cancelar" name="canPro" />
                        <a href="mostraManPais.php"><button type="button">Regresar</button></a>
                    </p>



                </form>

            </div>
        </div>    

        
    </body>
</html>

