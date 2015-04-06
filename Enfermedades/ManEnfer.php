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
        
        <title>Registrar Enfermedad</title>
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

                <form name="RegEnfer" method="POST" id="regEnfer">
                    <p><label>Registrar enfermedad</label></p>
                    <div class="etiq"><label>No enfermedad*:</label></div>
                    <div class="caTex"><input type="text" id="idEnfer" name="idEnfer" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Nombre de la enfermedad*:</label></div>
                    <div class="caTex"><input type="text" id="nomEnfer" name="nomEnfer" value="" size="25" /></div><br/>
                    <div class="etiq"><label>Descripción*:</label></div>
                    <div class="caTex"><input type="text" id="descEnfer" name="descEnfer" value="" size="30" /></div><br/><br/>

                    <p>
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" />
<a href="mostraManEnfer.php"><button type="button">Regresar</button></a>
                    </p>

                    <?php
                    if (!empty($_POST)) {
                        $array = array();
                        foreach ($_POST as $param_name => $param_val) {
                            $array[] = $param_val;
                        }
                        include '../transact/conectDB.php';

                        $link = conectar();
                        mysql_query("insert into enfermedades (NumEnfermedad, NomEnfermedad, DescripEnfermedad) values('$array[0]', '$array[1]', '$array[2]')", $link);
                        mysql_close($link);
                        echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='mostraManEnfer.php'> Ver Catalogo de Enfermedades</a>";
                    }
                    ?>  

                </form>

            </div>
        </div>    

      
    </body>
</html>
