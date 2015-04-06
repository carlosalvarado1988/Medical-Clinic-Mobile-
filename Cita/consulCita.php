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
        
        <title>Consulta de Citas</title>
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
                    if (!isset($_GET['exp']) || !is_numeric($_GET['exp'])) {
                        echo "<form name='selExp' method='GET' id='selExp'><p><label>Escriba el numero de expediente</label></br>
                    <div class='etiq'><label>N° de expediente:</label></div>
                    <div class='caTex'><input type='text' id='exp' name='exp' value='' size='5' /></div>
                    <br/></p><p><input type='submit' value='Enviar'/></p>";
                    } else {
                        include '../transact/conectDB.php';
                        $link = conectar();
                        $exp = $_GET['exp'];
                        $queryx = "SELECT * FROM controlcita AS c INNER JOIN historialclinico AS h ON c.NumHistorialClinico=h.NumHistorialClinico AND h.NumExpediente = $exp ORDER BY c.FechaProgramada DESC";
                        $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                        if ($row = mysql_fetch_array($resultx)) {
                            $queryz = "SELECT PriNombre, PriApellido FROM fichapaciente WHERE NumExpediente = $exp";
                            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());
                            $arraypaciente = mysql_fetch_array($resultz);
                            $nombre = $arraypaciente[0];
                            $apellido = $arraypaciente[1];
                            echo "<p><b>Citas de " . $nombre . " " . $apellido . "</b></p><p><a href='consulCita.php'>Ver otro expediente</a></p>";
                            echo "<table class='zebra'><thead><tr><th nowrap='nowrap'>Historial Clinico</th><th nowrap='nowrap'>Doctor</th><th nowrap='nowrap'>Fecha Programada</th><th nowrap='nowrap'>Hora Programada</th><th nowrap='nowrap'>Observaciones</th></tr></thead><tbody>";
                            do {
                                echo "<tr><td>" . $row["NumHistorialClinico"] . "</td><td>" . $row["NumDoctorAtender"] . "</td><td>" . $row["FechaProgramada"] . "</td><td>" . $row["HoraCita"] . "</td><td>" . $row["Observaciones"] . "</td></tr>";
                            } while ($row = mysql_fetch_array($resultx));
                            echo '</tbody></table>';
                        } else {
                            echo "<p><b>No se ha encontrado ningun registro</b><p><p><a href='consulCita.php'>Reintentar</a></p>";
                        }
                    }
                    ?>
       <a href="RegCita.php"><button type="button" data-inline="true">Registrar Cita</button></a>
            </div>
        </div>    

        
    </body>
</html>