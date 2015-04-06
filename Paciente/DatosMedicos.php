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
        
        <title>Registro Control Medico</title>
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
           

                <form name="RegContMedico" method="POST" id="regContMed">
                    <p><label>Registro de control medico</label></p>
                    <div class="etiq"><label>No de expediente*:</label></div>
                    <div class="caTex"><input type="text" id="expNum" name="expNum" value="" size="5" /></div><br/>
                    <?php
				include '../transact/conectDB.php';
                $link = conectar();

                    $query = "SELECT * FROM tiposangre ORDER BY NumTipoSangre";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                    echo "<div class='etiq'><label>Tipo de Sangre:</label></div>
                    <div class='caTex'><select id='NumTipoSangre' name='NumTipoSangre'>";
                    if ($row = mysql_fetch_array($result)) {
                        do {
                            echo "<option value = '" . $row["NumTipoSangre"] . "'>" . $row["TipoSangre"] . "</option>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</select></div><br/>';
                    } else {
                        echo "<p>Error en registro de Tipo de Sangre</p>";
                    }
                    ?>

                    <div class="etiq"><label>Estatura*:</label></div>
                    <div class="caTex"><input type="text" id="altura" name="altura" value="" size="5" />cms</div><br/>
                    <div class="etiq"><label>Alergico a:</label></div>
                    <div class="caTex"><textarea  name="alerPac" rows="4" cols="20"></textarea></div><br/>
                    <div class="etiq"><label>Enfermedades crónicas:</label></div>
                    <div class="caTex"><textarea  name="enfCron" rows="4" cols="20"></textarea></div><br/>
                    <div class="etiq"><label>Medicamentos permanentes:</label></div>
                    <div class="caTex"><textarea name="medPerma" rows="4" cols="20"></textarea></div><br/>
                    <div class="etiq"><label>Antecedentes familiares:</label></div>
                    <div class="caTex"><textarea  name="antFam" rows="4" cols="20"></textarea></div><br/><br/>


                    <p>
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" />
                        <a href="consulDatosMedicos.php"><button type="button">Regresar</button></a>
                    </p>

                    <?php
                    if (!empty($_POST)) {
                        
                        $exp = $_POST['expNum'];
                        $query = "SELECT NumExpediente FROM fichapaciente where NumExpediente = $exp";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                        $queryx = "SELECT NumExpediente FROM datosmedicos WHERE NumExpediente = $exp";
                        $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                        if (mysql_num_rows($result) > 0 && mysql_num_rows($resultx) == 0) {
                            $array = array();
                            foreach ($_POST as $param_name => $param_val) {
                                $array[] = $param_val;
                            }
                            mysql_query("insert into datosmedicos (NumExpediente, TipoSangre, Altura, AlergiasPaciente, EnferCronicas, MedicamentoPermanentes, AntecFamiliares) values('$array[0]', '$array[1]', $array[2], '$array[3]', '$array[4]', '$array[5]', '$array[6]')", $link);
                            mysql_close($link);
                            echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='consulDatosMedicos.php'> Ver Catalogo de Datos Medicos</a>";
                        } else if (!mysql_num_rows($resultx) == 0) {
                            echo "<h2 style=color:red>Datos medicos ya existen</h2>";
                        } else {
                            echo "<h2 style=color:red>Numero de expediente no existe</h2>";
                        }
                    }
                    ?>   

                </form>

            </div>
        </div>    

    </body>
</html>
