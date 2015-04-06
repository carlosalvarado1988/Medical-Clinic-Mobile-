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
        
        <title>Municipios</title>
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

                    if (!isset($_POST['Depa'])) {
                        $query = "SELECT * FROM departamento ORDER BY NumDepartamento";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                        echo "<form name='selExp' method='POST' id='selDepa'><p><label>Seleccione el Departamento</label><br/>
                    <div class='etiq'><label>Departamento:</label></div>
                    <div class='caTex'><select id='Depa' name='Depa'>";
                        if ($row = mysql_fetch_array($result)) {
                            do {
                                echo "<option value = '" . $row["NumDepartamento"] . "'>" . $row["NomDepartamento"] . "</option>";
                            } while ($row = mysql_fetch_array($result));
                            echo "</select></div><br/>";
                        } else {
                            echo "<p>Error en registro de departamentos</p>";
                        }

                        echo "<br/><p><input type='submit' value='Ver Municipios'/></p>";
                    } else {
                        $dep = $_POST['Depa'];
                        //$query = "SELECT * FROM municipio WHERE NumDepartamento = $dep ORDER BY NomMunicipio";
                        $query = "SELECT * FROM municipio AS m INNER JOIN departamento AS d ON m.NumDepartamento = d.NumDepartamento WHERE m.NumDepartamento = $dep";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                        if ($row = mysql_fetch_array($result)) {
                            echo '<table class="zebra"><thead><tr><th>Municipio</th><th>Departamento</th><th>Accion</th></tr></thead><tbody>';
                            do {

                                echo "<tr><td>" . $row["NomMunicipio"] . "</td><td>" . $row["NomDepartamento"] . "</td><td><a href='ActuMunicipio.php?NumMunicipio=" . $row["NumMunicipio"] . "'><center><img src = '../images/edit.png' alt='Editar' height='25' width='25'></a></center></td></tr>";
                            } while ($row = mysql_fetch_array($result));

                            echo "</tbody></table><p><a href='mostrarMunic.php'  data-ajax='false'>Seleccionar otro Departamento</a>";
                        } else {
                            echo "<p> No se ha encontrado ningun registro</p><p><a href='mostrarMunic.php'  data-ajax='false'>Seleccionar otro Departamento</a></p>";
                        }
                    }
                    ?>

				<a href="RegMunicipio.php"><button type="button" data-inline="true">Registrar Municipio</button></a>


    
            </div>
        </div>    

       
    </body>
</html>






