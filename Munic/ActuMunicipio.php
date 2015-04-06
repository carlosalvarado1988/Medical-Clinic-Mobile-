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
        
        <title>Registrar Departamento</title>
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

            if (isset($_REQUEST["NumMunicipio"])) {
                if (isset($_REQUEST["Editar"])) {

                    extract($_REQUEST);
                    //Modificamos el registro del usuario
                    $queryx = "update municipio set NomMunicipio='$NomMunicipio', NumDepartamento='$idDep' where NumMunicipio='$NumMunicipio'";
                    $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                    if ($resultx) {
                        echo "<h2 color:blue><p><center>El Registro  se ha modificado...</center></p></h2>";
                    }
                }
            }

            $NumMunicipio = $_REQUEST["NumMunicipio"];

            $queryz = "select NumMunicipio, NomMunicipio from municipio
            where NumMunicipio='$NumMunicipio'";
            //Realizando el query a la base de datos
            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());


            //Determinando el query a la base de datos
            $num = mysql_num_rows($resultz);

            if ($num > 0) { //Verificamos si hay mas de 0 filas
                $row = mysql_fetch_assoc($resultz);
                extract($row);
            }
            ?>


      

                <form name="RegMunicipio" method="POST" id="regMun">
                    <p><label>Registrar municipio</label></p>
                    <div class="etiq"><label>No municipio*:</label></div>
                    <div class="caTex"><input type="text" id="NumMunicipio" name="NumMunicipio" value="<?php echo $NumMunicipio; ?>" size="5" disabled/></div><br/>
                    <div class="etiq"><label>Nombre del municipio*:</label></div>
                    <div class="caTex"><input type="text" id="NomMunicipio" name="NomMunicipio" value="<?php echo $NomMunicipio; ?>" size="25" autofocus/></div><br/><br/>
                        <?php
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
                        <input type="submit" value="Editar" name="Editar"/>
                        <input type="reset" value="Cancelar" name="canPro" />
                        <a href="mostrarMunic.php"><button type="button">Regresar</button></a>
                    </p>



                </form>

            </div>
        </div>    

  
    </body>
</html>