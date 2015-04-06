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
        
        <title>Consulta de Datos Medicos</title>
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
                        $exp = $_GET['exp'];
                        $link = conectar();
                        $query = "SELECT * FROM datosmedicos WHERE NumExpediente = $exp";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                        if ($row = mysql_fetch_array($result)) {
                            $queryz = "SELECT PriNombre, PriApellido FROM fichapaciente WHERE NumExpediente = $exp";
                            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());
                            $arraypaciente = mysql_fetch_array($resultz);
                            $nombre = $arraypaciente[0];
                            $apellido = $arraypaciente[1];
                            echo "<p><b>Datos Medicos de " . $nombre . " " . $apellido . "</b></p><p><a href='consulDatosMedicos.php'>Ver otro expediente</a></p>";
                            echo "<table class='zebra'><thead><tr><th nowrap='nowrap'>Descripcion</th><th nowrap='nowrap'>Datos</th></tr></thead><tbody>";
                            do {
                                echo "<tr><td nowrap='nowrap'>Tipo de Sangre</td><td nowrap='nowrap'>" . $row["TipoSangre"] . "</td></tr>
		<tr><td nowrap='nowrap'>Estatura</td><td nowrap='nowrap'>" . $row["Altura"] . "</td></tr>
		<tr><td nowrap='nowrap'>Alergias</td><td nowrap='nowrap'> " . $row["AlergiasPaciente"] . "</td></tr>
		<tr><td nowrap='nowrap'>Enfermedades Cronicas</td><td nowrap='nowrap'> " . $row["EnferCronicas"] . "</td></tr>
		<tr><td nowrap='nowrap'>Medicamento Permanente</td><td nowrap='nowrap'>" . $row["MedicamentoPermanentes"] . "</td></tr>
		<tr><td nowrap='nowrap'>Antecedentes</td><td nowrap='nowrap' >" . $row["AntecFamiliares"] . "</td></tr>";
                            } while ($row = mysql_fetch_array($result));
                            echo '</tbody></table>';
                        } else {
                            echo "<p><b>No se ha encontrado ningun registro</b><p><p><a href='consulDatosMedicos.php'>Reintentar</a></p>";
                        }
                    }
                    ?>
                <a href="DatosMedicos.php"><button type="button" data-inline="true">Registrar Datos</button></a>
            </div>
        </div>    

    </body>
</html>