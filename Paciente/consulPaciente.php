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

        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet"  href="../../../css/themes/default/jquery.mobile-1.3.0-beta.1.css">
        <link rel="stylesheet" href="../_assets/css/jqm-docs.css"/>

        <link rel="stylesheet" href="/resources/demos/style.css" />
        <title>Consulta de Pacientes</title>
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

            <table data-role="table">

                <thead>
                    <tr>
                        <th nowrap='nowrap'>N° Expediente</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th nowrap='nowrap'>Contacto Emer</th>
                        <th nowrap='nowrap'>Telefono Emergencia</th>
                        <th nowrap='nowrap'>Editar</th>
                        <th nowrap='nowrap'>Ver Historial</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!isset($_GET['p']) || !is_numeric($_GET['p'])) {
                        $p = 0;
                    } else {
                        $p = ($_GET['p'] - 1) * 10;
                    }
                    include '../transact/conectDB.php';
                    $link = conectar();
                    $query = "SELECT NumExpediente, PriApellido, SegApellido, PriNombre, SegNombre, TerNombre, contEmergencia, TelEmergencia FROM fichapaciente ORDER BY NumExpediente ASC LIMIT $p, 10";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                    if ($row = mysql_fetch_array($result)) {
                        $queryx = "SELECT COUNT(*) FROM  fichapaciente";
                        $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());

                        do {

//                                    echo "<tr><td nowrap='nowrap'>" . $row["NumExpediente"] . "</td><td nowrap='nowrap'>" . $row["PriApellido"] . " " . $row["SegApellido"] . "</td><td nowrap='nowrap'>" . $row["PriNombre"] . " " . $row["SegNombre"] . " " . $row["TerNombre"] . "</td><td nowrap='nowrap'>" . $row["contEmergencia"] . "</td><td nowrap='nowrap' >" . $row["TelEmergencia"] . "</td><td><a href='ActuPac.php?NumExpediente=" . $row["NumExpediente"] . "'><center><img src = '../images/edit.png' alt='Editar' height='25' width='25'></a></center></td><td><a href='consulHistoMedico.php?exp=" . $row["NumExpediente"] . "'><center><img src = '../images/view.png' alt='Ver' height='25' width='25'></a></center></td></tr>";
                            echo "<tr><td>" . $row["NumExpediente"] . "</td><td>" . $row["PriApellido"] . " " . $row["SegApellido"] . "</td><td>" . $row["PriNombre"] . " " . $row["SegNombre"] . " " . $row["TerNombre"] . "</td><td>" . $row["contEmergencia"] . "</td><td>" . $row["TelEmergencia"] . "</td><td><center><a href='ActuPac.php?NumExpediente=" . $row["NumExpediente"] . "' data-ajax='false'><img src = '../images/edit.png' alt='Editar' height='25' width='25' /></a></center></td><td><center><a href='consulHistoMedico.php?exp=" . $row["NumExpediente"] . "'><img src = '../images/view.png' alt='Ver' height='25' width='25' /></a></center></td></tr>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</tbody></table><p><b>Pagina: </b>';
                        $max = mysql_fetch_array($resultx);
                        $maxx = ceil($max[0] / 10);
                        for ($c = 1; $c <= $maxx; $c++) {
                            echo "<a href='?p=$c'>[$c]</a>";
                        }
                        echo "</p>";
                    } else {
                        echo "! No se ha encontrado ning�n registro !";
                    }
                    ?>

                <a href="RegPaciente.php"><button type="button" data-inline="true">Registrar Paciente</button></a>
        </div><!-- /content -->	

    </div>
</body>
</html>