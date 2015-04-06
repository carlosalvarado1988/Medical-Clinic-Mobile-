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
        
        <title>Consulta de Historial Medico</title>
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
                    <div class='etiq'><label>No de expediente*:</label></div>
                    <div class='caTex'><input type='text' id='exp' name='exp' value='' size='5' /></div>
                    <br/></p><p><input type='submit' value='Enviar'/></p>";
                    } else {
                        include '../transact/conectDB.php';
                        if (!isset($_GET['p']) || !is_numeric($_GET['p'])) {
                            $p = 0;
                        } else {
                            $p = $_GET['p'] - 1;
                        }
                        $exp = $_GET['exp'];
                        $link = conectar();
                        $query = "SELECT * FROM historialclinico WHERE NumExpediente = $exp ORDER BY FechaConsulta DESC LIMIT $p, 1";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                        if ($row = mysql_fetch_array($result)) {
                            $queryx = "SELECT COUNT(*) FROM historialclinico WHERE NumExpediente = $exp";
                            $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                            $queryz = "SELECT PriNombre, PriApellido FROM fichapaciente WHERE NumExpediente = $exp";
                            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());
                            $arraypaciente = mysql_fetch_array($resultz);
                            $nombre = $arraypaciente[0];
                            $apellido = $arraypaciente[1];
                            echo "<p><b>Historial clinico de " . $nombre . " " . $apellido . "</b></p><p><a href='consulHistoMedico.php'>Ver otro expediente</a></p>";
                            echo '<table class="zebra"><thead><tr><th>Descripcion</th><th>Datos</th></tr></thead><tbody>';
                            do {
                                echo "<tr><td>Numero de Historial</td><td>" . $row["NumHistorialClinico"] . "</td></tr>
                                    <tr><td>Fecha Consulta</td><td>" . $row["FechaConsulta"] . "</td></tr>
		<tr><td>Temperatura</td><td>" . $row["TemperaturaPac"] . "</td></tr>
		<tr><td>Pulsaciones</td><td> " . $row["PulsacionesPac"] . "</td></tr>
		<tr><td>Presion Arterial</td><td> " . $row["PrecionArterial"] . "</td></tr>
		<tr><td>Peso</td><td>" . $row["PesoPac"] . "</td></tr>
		<tr><td>Sintomas</td><td >" . $row["SintomasPac"] . "</td></tr>
		<tr><td>Enfermedad</td><td >" . $row["NumEnfermedad"] . "</td></tr>
		<tr><td>Diagnostico</td><td >" . $row["Diagnostico"] . "</td></tr>
		<tr><td>Doctor que atendio</td><td>" . $row["NumDoctor"] . "</td></tr>
		<tr><td>Nueva Cita Programada</td><td>" . $row["PrograNueCita"] . "</td></tr>
		<tr><td>Examenes de Laboratorio</td><td>" . $row["RealizarExamenesLab"] . "</td></tr>
		<tr><td>Medicamentos Entregados</td><td>" . $row["EntregaMedicamento"] . "</td></tr>";
                            } while ($row = mysql_fetch_array($result));
                            echo '</tbody></table><br/>';
                            echo '<p><b>Pagina: </b>';
                            $max = mysql_fetch_array($resultx);
                            $maxx = $max[0];
                            for ($c = 1; $c <= $maxx; $c++) {
                                echo "<a href='?exp=$exp&amp;p=$c'>[$c]</a>";
                            }
                            echo '</p>';
                        } else {
                            echo "<p><b>No se ha encontrado ningun registro</b><p><p><a href='consulHistoMedico.php'>Reintentar</a></p>";
                        }
                    }
                    ?>
            
                <a href="HistoMedico.php"><button type="button" data-inline="true">Registrar Historial</button></a>
            </div>
        </div>    
       
    </body>
</html>