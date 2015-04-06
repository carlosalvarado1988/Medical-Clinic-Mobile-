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
		<!-- DATEPICKER -->
		<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.min.css" /> 
        <link rel="stylesheet" href="../_assets/css/jqm-docs.css"/>

        <link rel="stylesheet" href="/resources/demos/style.css" />
        <title> Registrar Paciente</title>
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
		
		<!-- Optional Mousewheel support: https://github.com/brandonaaron/jquery-mousewheel -->
		<script type="text/javascript" src="PATH/TO/YOUR/COPY/OF/jquery.mousewheel.min.js"></script>
		
		<!-- DATEPICKER -->
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.en_US.utf8.js"></script>
		
 <script type="text/javascript">
 
 jQuery.extend(jQuery.mobile.datebox.prototype.options, {
    <!-- useLang: 'en'--> 
	'overrideDateFormat': '%Y/%m/%d',
    'overrideHeaderFormat': '%Y/%m/%d'
	 });  

	<!--    jQuery.extend(jQuery.mobile.datebox.prototype.options.lang, {--> 
  <!--   'en': {
	<!-- 	daysOfWeek: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Saabado'],--> 
    <!--     daysOfWeekShort: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],--> 
    <!--     monthsOfYear: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],--> 
   <!--      monthsOfYearShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],--> 
    <!--     durationLabel: ['Dias', 'Horas', 'Minutos', 'Segundos'],--> 
    <!--     durationDays: ['Dia', 'Dias'],--> 
  <!--     }--> 
    <!--  });--> 

   </script>

    </head>
    <body>		
        <?php
        include '../transact/conectDB.php';
        $link = conectar();

        $querym = "SELECT * from municipio";
        $resultm = mysql_query($querym, $link) or die();

        $arrayiddeps = array();
        $arrayidmuns = array();
        $arraynommuns = array();
        while ($mrow = mysql_fetch_array($resultm)) {


            $arrayiddeps[] = $mrow['NumDepartamento'];
            $arrayidmuns[] = $mrow['NumMunicipio'];
            $arraynommuns[] = $mrow['NomMunicipio'];
        }
        include "../menu.html";
        ?>


        <!-- LIMITAR ALGUNOS CAMPOS-->



        <div data-role="content">

            <form name="RegPaciente" method="POST" id="RegPaciente">
                <p><label>Registro de paciente</label></p><br/><br/>
                <div ><label>No de expediente*:</label></div>
                <div ><input type="text" id="expNum" name="expNum" value="" size="10" required autofocus/></div><br/>
                <div ><label>Primer apellido*:</label></div>
                <div ><input type="text" id="primApe" name="primApe" value="" size="25" required/></div><br/>
                <div ><label>Segundo apellido*:</label></div>
                <div ><input type="text" id="segmApe" name="segApe" value="" size="25" required/></div><br/>
                <div ><label>Primer nombre*:</label></div>
                <div ><input type="text" id="NomPri" name="NomPri" value="" size="25" required/></div><br/>
                <div ><label>Segundo Nombre*:</label></div>
                <div ><input type="text" id="segNom" name="segNom" value="" size="25" required/></div><br/>
                <div ><label>Tercer nombre:</label></div>
                <div ><input type="text" name="terNom" value="" size="25" required/></div><br/>
                <div ><label>Sexo*:</label></div>
                <div ><select name="sexPac" id="sexPac" required>
                        <option value = 'M'>Masculino</option>
                        <option value = 'F'>Femenino</option>
                    </select></div><br/>
                <div ><label>Edad*:</label></div>
                <div ><input type="text" id="edadPac" name="edadPac" value="" size="3" required/></div><br/>
                <div ><label>Fecha de nacimiento*:</label></div>
                <div ><input name="fecNac" id="datebox" type="date" data-role="datebox" data-options='{"mode": "calbox", "calUsePickers": true, "calNoHeader": true}'required/></div><br/>
                <div ><label>Lugar de nacimiento*:</label></div>
                <div ><input type="text" id="lugNac" name="lugNac" value="" size="25" required /></div><br/>
                <?php
                $query = "SELECT NumPais, NomPais FROM pais ORDER BY NomPais";
                $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                echo "<div><label>Pais de Nacimiento:</label></div>
                    <div><select id='PaisNacimiento' name='PaisNacimiento'>";
                if ($row = mysql_fetch_array($result)) {
                    do {
                        echo "<option value = '" . $row["NumPais"] . "'>" . $row["NomPais"] . "</option>";
                    } while ($row = mysql_fetch_array($result));
                    echo '</select></div><br/>';
                } else {
                    echo "<p>Error en registro de Estado Civil</p>";
                }
                ?>
                <?php
                $query = "SELECT * FROM estadocivil ORDER BY NumEstadoCivil";
                $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                echo "<div><label>Estado Civil:</label></div>
                    <div ><select id='estCivil' name='estCivil'>";
                if ($row = mysql_fetch_array($result)) {
                    do {
                        echo "<option value = '" . $row["NumEstadoCivil"] . "'>" . $row["EstadoCivil"] . "</option>";
                    } while ($row = mysql_fetch_array($result));
                    echo '</select></div><br/>';
                } else {
                    echo "<p>Error en registro de Estado Civil</p>";
                }
                ?>
                <div ><label>Ocupación*:</label></div>
                <div ><input type="text" id="ocuPac" name="ocuPac" value="" size="30" required/></div><br/>
                <div ><label>Teléfono personal*:</label></div>
                <div ><input type="text" id="telPer" name="telPer" value="" size="10" required/></div><br/>
                <div ><label>Dirección*:</label></div>
                <div ><textarea name="dirPac" id="dirPac" rows="4" cols="20" required></textarea></div><br/>
                <?php
                $query = "SELECT * FROM departamento ORDER BY NumDepartamento";
                $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                echo "<div ><label>Departamento:</label></div>
                    <div><select id='depPac' name='depPac' required>";
                if ($row = mysql_fetch_array($result)) {
                    do {
                        echo "<option value = '" . $row["NumDepartamento"] . "'>" . $row["NomDepartamento"] . "</option>";
                    } while ($row = mysql_fetch_array($result));
                    echo '</select></div><br/>';
                } else {
                    echo "<p>Error en registro de departamentos</p>";
                }
                ?>
                <div ><label>Municipio:</label></div>
                <div ><select id='NumMunicipio' name='NumMunicipio'></select></div><br/>

                <?php
                $query = "SELECT NumDependencia, NomDependencia FROM lugartrabjo ORDER BY NumDependencia";
                $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                echo "<div><label>Dependencia:</label></div>
                    <div><select id='NumDependencia' name='NumDependencia' required>";
                if ($row = mysql_fetch_array($result)) {
                    do {
                        echo "<option value = '" . $row["NumDependencia"] . "'>" . $row["NomDependencia"] . "</option>";
                    } while ($row = mysql_fetch_array($result));
                    echo '</select></div><br/>';
                } else {
                    echo "<p>Error en registro de departamentos</p>";
                }
                ?>
                <div ><label>Teléfono trabajo*:</label></div>
                <div ><input type="text" id="telTra" name="telTra" value="" size="10" /></div><br/>
                <div ><label>Número de afiliado*:</label></div>
                <div ><input type="text" id="numAfi" name="numAfi" value="" size="20" /></div><br/>
                <div ><label>Contacto de emergencia*:</label></div>
                <div ><input type="text" id="contEmer" name="contEmer" value="" size="30" /></div><br/>
                <div ><label>Teléfono de emergencia*:</label></div>
                <div ><input type="text" id="telEmer" name="telEmer" value="" size="10" /></div><br/><br/>
                <p> 
                    <input type="submit" data-inline="true" value="Enviar" name="envDatos" id="envDatos" />
                    <input type="reset" data-inline="true" value="Cancelar" name="canPro" onClick="$('label.error').remove();"/>
                    <a href="consulPaciente.php"><button type="button" data-inline="true">Regresar</button></a>
                </p>
                <?php
                if (!empty($_POST)) {

                    $array = array();
                    foreach ($_POST as $param_name => $param_val) {
                        $array[] = $param_val;
                    }
                    $querypac = "select NumExpediente from fichapaciente where NumExpediente = $array[0]";
                    $resultpac = mysql_query($querypac, $link);
                    if (mysql_num_rows($resultpac) == 0) {
                        mysql_query("insert into fichapaciente (NumExpediente, PriApellido, SegApellido, PriNombre, SegNombre, TerNombre, SexPaciente, EdadPaciente, FecNacimiento, LugNacimiento, PaisNacimiento, NumEstadoCivil, Ocupacion, TelPersonal, DirHabitual, NumDepartamento, NumMunicipio, NumDependencia, TelTrabajo, NumAfiliacion, contEmergencia, TelEmergencia) values($array[0], '$array[1]', '$array[2]', '$array[3]', '$array[4]', '$array[5]', '$array[6]', $array[7], '$array[8]', '$array[9]', '$array[10]', '$array[11]', '$array[12]', '$array[13]', '$array[14]', '$array[15]', '$array[16]', '$array[17]', '$array[18]', $array[19], '$array[20]', '$array[21]')", $link);
                        mysql_close($link);
                        echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='consulPaciente.php'> Ver Catalogo de Pacientes</a>";
                    } else {
                        echo "<h2 style=color:red>El Expediente ya existe</h2>       <a href='consulPaciente.php'> Ver Catalogo de Pacientes</a>";
                    }
                }
                ?>


            </form>
        </div><!-- /content -->

        <script type="text/javascript">
            $(document).on('pageinit', function() {
                llenar();
                $("#PaisNacimiento").val('68');
            });

            $('#envDatos').on('click', function() {
                $('#RegPaciente').validate({
                    rules: {
                        'expNum': {required: true, number: true},
                        'primApe': 'required',
                        'segApe': 'required',
                        'segNom': 'required',
                        'sexPac': 'required',
                        'edadPac': {required: true, number: true},
                        'fecNac': {required: true, date: true},
                        'paNac': 'required',
                        'lugNac': 'required',
                        'ocuPac': 'required',
                        'dirPac': 'required',
                        'depPac': 'required',
                        'munPac': 'required',
                        'telPer': 'required',
                        'depTrab': 'required',
                        'telTra': 'required',
                        'numAfi': {required: true, number: true},
                        'NomPri': 'required',
                        'contEmer': 'required',
                        'telEmer': 'required'
                    },
                    messages: {
                        'expNum': {required: 'Valor requerido para procesar información', number: 'El valor debe ser numerico'},
                        'primApe': 'Valor requerido para procesar información',
                        'segApe': 'Valor requerido para procesar información',
                        'segNom': 'Valor requerido para procesar información',
                        'sexPac': 'Valor requerido para procesar información',
                        'edadPac': {required: 'Valor requerido para procesar información', number: 'El valor debe ser numerico'},
                        'fecNac': {required: 'Valor requerido para procesar información', date: 'Formato de fecha invalido'},
                        'paNac': 'Valor requerido para procesar información',
                        'lugNac': 'Valor requerido para procesar información',
                        'ocuPac': 'Valor requerido para procesar información',
                        'dirPac': 'Valor requerido para procesar información',
                        'depPac': 'Valor requerido para procesar información',
                        'munPac': 'Valor requerido para procesar información',
                        'telPer': 'Valor requerido para procesar información',
                        'depTrab': 'Valor requerido para procesar información',
                        'telTra': 'Valor requerido para procesar información',
                        'numAfi': {required: 'Valor requerido para procesar información', number: 'El valor debe ser numerico'},
                        'NomPri': 'Valor requerido para procesar información',
                        'contEmer': 'Valor requerido para procesar información',
                        'telEmer': 'Valor requerido para procesar información'

                    },
                    debug: true,
                    submitHandler: function(form) {
                        form.submit();
                        
                    }
                });
            });

            function llenar() {
                var arrayiddeps = <?php echo json_encode($arrayiddeps); ?>;
                var arrayidmuns = <?php echo json_encode($arrayidmuns); ?>;
                var arrayidnoms = <?php echo json_encode($arraynommuns); ?>;
                var combodep = $('#depPac').val();
                var combomun = $('#NumMunicipio');
                var arraysize = arrayiddeps.length;
                combomun.empty();
                for (var c = 0; c <= arraysize; c++) {
                    if (arrayiddeps[c] == combodep) {
                        combomun.append(
                                $('<option/>')
                                .attr('value', arrayidmuns[c])
                                .text(arrayidnoms[c]));
                    }
                    ;
                }
                ;
            }

            $('#depPac').change(function() {
                llenar();
            });

        </script>
    </body>
</html>