<!DOCTYPE HTML>
<html lang="es">
    <head>
        <link rel="StyleSheet" media="screen" type="text/css" href="../FormatosEstilos/FormaPaginas.css">
        <link rel="stylesheet" type="text/css" href="../FormatosEstilos/jquery-ui1.7.2.custom.css" />
        <link rel="stylesheet" href="/resources/demos/style.css" />
        <title>Registrar Paciente</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	       

	<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
       

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script> 
	 <script type="text/javascript" src="../js/jquery.validate.js"></script>

        <script type="text/javascript">
            jQuery(function($) {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
                    weekHeader: 'Sm',
                    dateFormat: 'yy/mm/dd',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);
            });



            $(document).ready(function() {
                $("#datepicker").datepicker({
                    minDate: new Date(1900, 1, 1),
                    maxDate: new Date(2050, 12, 31),
                    changeMonth: true,
                    changeYear: true,
                    showOn: 'button',
                    buttonImageOnly: true,
                    buttonImage: '../images/datepicker.png'});
            });
        </script>



    </head>
    <body>

        <div id="contenedor">
            <div id="encabezado">
                <img src="../images/banner.png" width="960" height="110" alt="banner"/>
                <?php
                session_start();
                include "../transact/sessioncheck.php";
                session();
                ?>
            </div>

            <div id="menu">
                <?php
                include "../menu.html";
                include '../transact/conectDB.php';
                $link = conectar();
                ?>

            </div>

            <div id="cuerpo">




                <!-- LIMITAR ALGUNOS CAMPOS-->




                <form name="RegPaciente" method="POST" id="RegPaciente">
                    <p><label>Registro de paciente</label></p><br/><br/>
                    <div class="etiq"><label>No de expediente*:</label></div>
                    <div class="caTex"><input type="text" id="expNum" name="expNum" value="" size="10" autofocus/></div><br/>
                    <div class="etiq"><label>Primer apellido*:</label></div>
                    <div class="caTex"><input type="text" id="primApe" name="primApe" value="" size="25" /></div><br/>
                    <div class="etiq"><label>Segundo apellido*:</label></div>
                    <div class="caTex"><input type="text" id="segmApe" name="segApe" value="" size="25" /></div><br/>
                    <div class="etiq"><label>Primer nombre*:</label></div>
                    <div class="caTex"><input type="text" id="NomPri" name="NomPri" value="" size="25" /></div><br/>
                    <div class="etiq"><label>Segundo Nombre*:</label></div>
                    <div class="caTex"><input type="text" id="segNom" name="segNom" value="" size="25" /></div><br/>
                    <div class="etiq"><label>Tercer nombre:</label></div>
                    <div class="caTex"><input type="text" name="terNom" value="" size="25" /></div><br/>
                    <div class="etiq"><label>Sexo*:</label></div>
                    <div class="caTex"><select name="sexPac" id="sexPac">
                            <option value = 'M'>Masculino</option>
                            <option value = 'F'>Femenino</option>
                        </select></div><br/>
                    <div class="etiq"><label>Edad*:</label></div>
                    <div class="caTex"><input type="text" id="edadPac" name="edadPac" value="" size="3" /></div><br/>
                    <div class="etiq"><label>Fecha de nacimiento*:</label></div>
                    <div class="caTex"><input type="text" id="datepicker" name="fecNac" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Lugar de nacimiento*:</label></div>
                    <div class="caTex"><input type="text" id="lugNac" name="lugNac" value="" size="25" /></div><br/>
                    <?php
                    $query = "SELECT NumPais, NomPais FROM pais ORDER BY NumPais";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                    echo "<div class='etiq'><label>Pais de Nacimiento:</label></div>
                    <div class='caTex'><select id='PaisNacimiento' name='PaisNacimiento'>";
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

                    echo "<div class='etiq'><label>Estado Civil:</label></div>
                    <div class='caTex'><select id='estCivil' name='estCivil'>";
                    if ($row = mysql_fetch_array($result)) {
                        do {
                            echo "<option value = '" . $row["NumEstadoCivil"] . "'>" . $row["EstadoCivil"] . "</option>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</select></div><br/>';
                    } else {
                        echo "<p>Error en registro de Estado Civil</p>";
                    }
                    ?>
                    <div class="etiq"><label>Ocupación*:</label></div>
                    <div class="caTex"><input type="text" id="ocuPac" name="ocuPac" value="" size="30" /></div><br/>
                    <div class="etiq"><label>Teléfono personal*:</label></div>
                    <div class="caTex"><input type="text" id="telPer" name="telPer" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Dirección*:</label></div>
                    <div class="caTex"><textarea name="dirPac" id="dirPac" rows="4" cols="20"></textarea></div><br/>
                    <?php
                    $query = "SELECT * FROM departamento ORDER BY NumDepartamento";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                    echo "<div class='etiq'><label>Departamento:</label></div>
                    <div class='caTex'><select id='depPac' name='depPac'>";
                    if ($row = mysql_fetch_array($result)) {
                        do {
                            echo "<option value = '" . $row["NumDepartamento"] . "'>" . $row["NomDepartamento"] . "</option>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</select></div><br/>';
                    } else {
                        echo "<p>Error en registro de departamentos</p>";
                    }
                    ?>

                    <?php
		   	
                    $query = "SELECT NumMunicipio, NomMunicipio FROM municipio ORDER BY NumMunicipio";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                    echo "<div class='etiq'><label>Municipio:</label></div>
                    <div class='caTex'><select id='NumMunicipio' name='NumMunicipio'>";
                    if ($row = mysql_fetch_array($result)) {
                        do {
                            echo "<option value = '" . $row["NumMunicipio"] . "'>" . $row["NomMunicipio"] . "</option>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</select></div><br/>';
                    } else {
                        echo "<p>Error en registro de departamentos</p>";
                    }
                    ?>

                    <?php
                    $query = "SELECT NumDependencia, NomDependencia FROM lugartrabjo ORDER BY NumDependencia";
                    $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

                    echo "<div class='etiq'><label>Dependencia:</label></div>
                    <div class='caTex'><select id='NumDependencia' name='NumDependencia'>";
                    if ($row = mysql_fetch_array($result)) {
                        do {
                            echo "<option value = '" . $row["NumDependencia"] . "'>" . $row["NomDependencia"] . "</option>";
                        } while ($row = mysql_fetch_array($result));
                        echo '</select></div><br/>';
                    } else {
                        echo "<p>Error en registro de departamentos</p>";
                    }
                    ?>
                    <div class="etiq"><label>Teléfono trabajo*:</label></div>
                    <div class="caTex"><input type="text" id="telTra" name="telTra" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Número de afiliado*:</label></div>
                    <div class="caTex"><input type="text" id="numAfi" name="numAfi" value="" size="20" /></div><br/>
                    <div class="etiq"><label>Contacto de emergencia*:</label></div>
                    <div class="caTex"><input type="text" id="contEmer" name="contEmer" value="" size="30" /></div><br/>
                    <div class="etiq"><label>Teléfono de emergencia*:</label></div>
                    <div class="caTex"><input type="text" id="telEmer" name="telEmer" value="" size="10" /></div><br/><br/>
                    <p> 
                        <input type="submit" value="Enviar" name="envDatos" />
                        <input type="reset" value="Cancelar" name="canPro" onClick="$('label.error').remove();"/>
                        <a href="consulPaciente.php"><button type="button">Regresar</button></a>
                    </p>
                    <?php
                    if (!empty($_POST)) {
                        $array = array();
                        foreach ($_POST as $param_name => $param_val) {
                            $array[] = $param_val;
                        }
			
                        mysql_query("insert into fichapaciente (NumExpediente, PriApellido, SegApellido, PriNombre, SegNombre, TerNombre, SexPaciente, EdadPaciente, FecNacimiento, LugNacimiento, PaisNacimiento, NumEstadoCivil, Ocupacion, TelPersonal, DirHabitual, NumDepartamento, NumMunicipio, NumDependencia, TelTrabajo, NumAfiliacion, contEmergencia, TelEmergencia) values($array[0], '$array[1]', '$array[2]', '$array[3]', '$array[4]', '$array[5]', '$array[6]', $array[7], '$array[8]', '$array[9]', '$array[10]', '$array[11]', '$array[12]', '$array[13]', '$array[14]', '$array[15]', '$array[16]', '$array[17]', '$array[18]', $array[19], '$array[20]', '$array[21]')", $link);
                        mysql_close($link);
                        echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='consulPaciente.php'> Ver Catalogo de Pacientes</a>";
                    }
                    ?>


                </form>

            </div>
        </div>    

        <script type="text/javascript">
            $("#accordion > li > div").click(function() {
                if (false == $(this).next().is(':visible')) {
                    $('#accordion ul').slideUp(300);
                }
                $(this).next().slideToggle(300);
            });
            $('#accordion ul:eq(0)').show();



            $(function() {
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

        </script>
    </body>
</html>