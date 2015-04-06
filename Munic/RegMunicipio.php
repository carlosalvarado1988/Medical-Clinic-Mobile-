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
        
        <title>Registrar Municipio</title>
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

        

                <form name="RegMunicipio" method="POST" id="regMun">
                    <p><label>Registrar municipio</label></p>
                    <div class="etiq"><label>No municipio*:</label></div>
                    <div class="caTex"><input type="text" id="idMun" name="idMun" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Nombre del municipio*:</label></div>
                    <div class="caTex"><input type="text" id="nomMun" name="nomMun" value="" size="25" /></div><br/><br/>
                        <?php
                        include '../transact/conectDB.php';
                        $link = conectar();
                        $query = "SELECT * FROM departamento ORDER BY NumDepartamento";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                        echo "<div class='etiq'><label>Departamento:</label></div>
                    <div class='caTex'><select id='idDep' name='idDep'>";
                        if ($row = mysql_fetch_array($result)) {
                            do {
                                echo "<option value = '" . $row["NumDepartamento"] . "'>" . $row["NomDepartamento"] . "</option>";
                            } while ($row = mysql_fetch_array($result));
                            echo '</select></div><br/>';
                        } else {
                            echo "<p>Error en registro de departamentos</p>";
                        }
                        ?>
                    <p>
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" />
                        <a href="mostrarMunic.php"><button type="button">Regresar</button></a>
                    </p>

                    <?php
                    if (!empty($_POST)) {

                        $dep = $_POST['idDep'];
                        $mun = $_POST['idMun'];
                        $query = "SELECT NumDepartamento FROM departamento where NumDepartamento = $dep";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                        $queryx = "SELECT NumMunicipio from municipio where NumMunicipio = $mun";
                        $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                        if (mysql_num_rows($result) > 0 && mysql_num_rows($resultx) == 0) {
                            $array = array();
                            foreach ($_POST as $param_name => $param_val) {
                                $array[] = $param_val;
                            }
                            mysql_query("insert into municipio (NumMunicipio, NomMunicipio, NumDepartamento) values('$array[0]', '$array[1]', '$array[2]')", $link);
                            mysql_close($link);
                            echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='mostrarMunic.php'> Ver Municipios</a>";
                        } else if (mysql_num_rows($result) == 0) {
                            echo "<h2 style=color:red>Numero de Departamento inexistente</h2>";
                        } else {
                            echo "<h2 style=color:red>Numero de municipio ya existe</h2>";
                        }
                    }
                    ?>      

                </form>

            </div>
        </div>    

        
    </body>
</html>