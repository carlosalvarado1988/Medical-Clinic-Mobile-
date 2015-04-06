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
    
        <title>Registrar Cita</title>
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
                <form name="RegCita" method="POST" id="RegCita">
                    <p><label>CONTROL CITA</label></p>
                    <div class="etiq"><label>N° de historial*:</label></div>
                    <div class="caTex"><input type="text" id="histNum" name="histNum" value="" size="5" /></div><br/>
                    <div class="etiq"><label>N° de Doctor que atendio*:</label></div>
                    <div class="caTex"><input type="text" id="docAten" name="docAten" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Fecha*:</label></div>
                    <div class="caTex"><input type="text" id="datepicker" name="FechaProgramada" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Hora*:</label></div>
                    <div class="caTex"><input type="text" id="HoraCita" name="HoraCita" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Observaciones*:</label></div>
                    <div class="caTex"><textarea  name="Observaciones" rows="4" cols="20"></textarea></div><br/>

                    <p>
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" />
                    </p>                          

                    <?php
                    if (!empty($_POST)) {
                        include '../transact/conectDB.php';
                        $link = conectar();
                        $hist = $_POST['histNum'];
                        $query = "SELECT NumHistorialClinico FROM historialclinico where NumHistorialClinico = $hist";
                        $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                        $queryx = "SELECT NumHistorialClinico FROM controlcita where NumHistorialClinico = $hist";
                        $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                        if (mysql_num_rows($result) > 0 && mysql_num_rows($resultx) == 0) {
                            $array = array();
                            foreach ($_POST as $param_name => $param_val) {
                                $array[] = $param_val;
                            }
                            mysql_query("insert into controlcita (NumHistorialClinico, NumDoctorAtender, FechaProgramada, HoraCita, Observaciones) values('$array[0]', '$array[1]', '$array[2]', '$array[3]', '$array[4]')", $link);
                            mysql_close($link);
                            echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='consulCita.php'> Ver Catalogo de Citas</a>";
                        } else if (!mysql_num_rows($resultx) == 0){
                            echo "<h2 style=color:red>Ya existe Cita para este expediente</h2>";
                        } else {
                            echo "<h2 style=color:red>Numero de Historial inexistente</h2>";
                        }
                    }
                    ?>

                </form>

            </div>
        </div>    

    </body>
</html>