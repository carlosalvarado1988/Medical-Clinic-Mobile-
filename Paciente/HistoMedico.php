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

        <title>Historial Clinico</title>
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
				include '../transact/conectDB.php';
                $link = conectar();
                include "../menu.html";
                ?>
          

			<div data-role="content">
			
                <form name="HistoClin" method="POST" id="histoClin">
                    <p><label>Historial clinico del paciente</label></p>
                    <div class="etiq"><label>No de historial*:</label></div>
                    <div class="caTex"><input type="text" id="histNum" name="histNum" value="" size="5" /></div><br/>
                    <div class="etiq"><label>No de expediente*:</label></div>
                    <div class="caTex"><input type="text" id="expNum" name="expNum" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Fecha de Consulta*:</label></div>
                    <div class="caTex"><input type="text" id="datepicker" name="fecCons" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Temperatura* (°C):</label></div>
                    <div class="caTex"><input type="text" id="temCons" name="temCons" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Pulsaciones por minuto*:</label></div>
                    <div class="caTex"><input type="text" id="pulsCons" name="pulsCons" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Presión arterial*:</label></div>
                    <div class="caTex"><input type="text" id="preArt" name="preArt" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Peso* (lbs):</label></div>
                    <div class="caTex"><input type="text" name="pesCons"  id="pesCons" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Sintomas*:</label></div>
                    <div class="caTex"><textarea name="sintCons" id="sintCons" rows="4" cols="20"></textarea></div><br/>
                    <?php
                    $query = "SELECT * FROM enfermedades ORDER BY NumEnfermedad";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                    echo "<div class='etiq'><label>Enfermedad:</label></div>
                    <div class='caTex'><select id='NumEnfermedad' name='NumEnfermedad'>";
                    if ($row = mysql_fetch_array($result)) {
                        do {
                            echo "<option value = '" . $row["NumEnfermedad"] . "'>" . $row["NomEnfermedad"] . "</option>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</select></div><br/>';
                    } else {
                        echo "<p>Error en registro de Enfermedades</p>";
                    }
                    ?>
                    <div class="etiq"><label>Diagnostico*:</label></div>
                    <div class="caTex"><textarea name="diagCons" id="diagCons" rows="4" cols="20"></textarea></div><br/>
                    <div class="etiq"><label>Doctor que atendio*:</label></div>
                    <div class="caTex"><input type="text" id="docAten" name="docAten" value="" size="20" /></div><br/>
                    <div class="etiq"><label>Nueva cita*:</label></div>
                    <div class="caTex"><select name="nueCita" >
                            <option value= 'N'>No</option>
                            <option value= 'S'>Si</option>
                        </select></div><br/>
                    <div class="etiq"><label>Realizar examenes*:</label></div>
                    <div class="caTex"><select name="realiExa" >
                            <option value= 'N'>No</option>
                            <option value= 'S'>Si</option>
                        </select></div><br/>
                    <div class="etiq"><label>Entregar medicamento*:</label></div>
                    <div class="caTex"><select name="entreMed" >
                            <option value= 'N'>No</option>
                            <option value= 'S'>Si</option>
                        </select></div><br/><br/><br/>

                    <p>
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" />
                        <a href="consulHistoMedico.php"><button type="button">Regresar</button></a>
                    </p>



                </form>
                <?php
                if (!empty($_POST)) {

                    $exp = $_POST['expNum'];
                    $query = "SELECT NumExpediente FROM fichapaciente where NumExpediente = $exp";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                    if (mysql_num_rows($result) > 0) {
                        $array = array();
                        foreach ($_POST as $param_name => $param_val) {
                            $array[] = $param_val;
                        }
                        mysql_query("insert into historialclinico (NumHistorialClinico, NumExpediente, FechaConsulta, TemperaturaPac, PulsacionesPac, PrecionArterial, PesoPac, SintomasPac, NumEnfermedad, Diagnostico, NumDoctor, PrograNueCita, RealizarExamenesLab, EntregaMedicamento) values('$array[0]', '$array[1]', '$array[2]', $array[3], $array[4], '$array[5]', $array[6], '$array[7]', '$array[8]', '$array[9]', '$array[10]', '$array[11]', '$array[12]', '$array[13]')", $link);
                        mysql_close($link);
                        echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='consulHistoMedico.php'> Ver Catalogo de Historiales Medicos</a>";
                    } else {
                        echo "<h2 style=color:red>Numero de Expediente inexistente</h2>";
                    }
                }
                ?>
				
				
            </div>
        </div>    

    </body>
</html>
