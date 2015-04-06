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
 
        <title>Registrar Paciente</title>
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

            if (isset($_REQUEST["NumExpediente"])) {
                if (isset($_REQUEST["Editar"])) {
                    extract($_REQUEST);
                    //Modificamos el registro del usuario
                    $queryx = "update fichapaciente set NumExpediente='$NumExpediente', PriApellido='$PriApellido', 
				SegApellido='$SegApellido', PriNombre='$PriNombre', 	
			    SegNombre='$SegNombre', TerNombre='$TerNombre', SexPaciente='$SexPaciente', EdadPaciente=$EdadPaciente,
				FecNacimiento='$FecNacimiento', LugNacimiento='$LugNacimiento', 
				PaisNacimiento='$PaisNacimiento ', NumEstadoCivil=$NumEstadoCivil, Ocupacion='$Ocupacion', 
				TelPersonal='$TelPersonal', DirHabitual='$DirHabitual', 
				NumDepartamento=$NumDepartamento, NumMunicipio=$NumMunicipio, NumDependencia=$NumDependencia,
				TelTrabajo='$TelTrabajo', NumAfiliacion='$NumAfiliacion', contEmergencia='$contEmergencia', 
				TelEmergencia='$TelEmergencia' where NumExpediente=$NumExpediente";
                    $resultx = mysql_query($queryx, $link) or die($sql . ">>" . mysql . error());
                    if ($resultx) {
                        echo "<h2 color:blue><p><center>El Registro  se ha modificado...</center></p></h2>";
                    }
                }
            }

            $NumExpediente = $_REQUEST["NumExpediente"];

            $queryz = "select NumExpediente, PriApellido, SegApellido, PriNombre, SegNombre, 	
			SegNombre, TerNombre, EdadPaciente, FecNacimiento, LugNacimiento, Ocupacion, TelPersonal, DirHabitual, 
			TelTrabajo, NumAfiliacion, contEmergencia, TelEmergencia from fichapaciente where NumExpediente= '$NumExpediente'";
            //Realizando el query a la base de datos
            $resultz = mysql_query($queryz, $link) or die($sql . ">>" . mysql . error());
            //Determinando el query a la base de datos
            $num = mysql_num_rows($resultz);

            if ($num > 0) { //Verificamos si hay mas de 0 filas
                $row = mysql_fetch_assoc($resultz);
                extract($row);
            }
            ?>
 

                <!-- LIMITAR ALGUNOS CAMPOS-->

                <form name="RegPaciente" method="POST" id="regPac1">
                    <p><label>Registro de paciente</label></p><br/><br/>
                    <div class="etiq"><label>No de expediente*:</label></div>
                    <div class="caTex"><input type="text" id="NumExpediente" name="NumExpediente" value="<?php echo $NumExpediente; ?>" size="10" disabled/></div><br/>
                    <div class="etiq"><label>Primer apellido*:</label></div>
                    <div class="caTex"><input type="text" id="PriApellido" name="PriApellido" value="<?php echo $PriApellido; ?>" size="25" autofocus/></div><br/>
                    <div class="etiq"><label>Segundo apellido*:</label></div>
                    <div class="caTex"><input type="text" id="SegApellido" name="SegApellido" value="<?php echo $SegApellido; ?>" size="25" /></div><br/>
                    <div class="etiq"><label>Primer nombre*:</label></div>
                    <div class="caTex"><input type="text" id="PriNombre" name="PriNombre" value="<?php echo $PriNombre; ?>" size="25" /></div><br/>
                    <div class="etiq"><label>Segundo Nombre*:</label></div>
                    <div class="caTex"><input type="text" id="SegNombre" name="SegNombre" value="<?php echo $SegNombre; ?>" size="25" /></div><br/>
                    <div class="etiq"><label>Tercer nombre:</label></div>
                    <div class="caTex"><input type="text" id="TerNombre" name="TerNombre" value="<?php echo $TerNombre; ?>" size="25" /></div><br/>
                    <div class="etiq"><label>Sexo*:</label></div>
                    <div class="caTex"><select name="SexPaciente" id="SexPaciente">
                            <option value = 'M'>Masculino</option>
                            <option value = 'F'>Femenino</option>
                        </select></div><br/>
                    <div class="etiq"><label>Edad*:</label></div>
                    <div class="caTex"><input type="text" id="EdadPaciente" name="EdadPaciente" value="<?php echo $EdadPaciente; ?>" size="3" /></div><br/>
                    <div class="etiq"><label>Fecha de nacimiento*:</label></div>
                    <div class="caTex"><input type="text" id="datepicker" name="FecNacimiento" value="<?php echo $FecNacimiento; ?>" size="10" /></div><br/>
                    <div class="etiq"><label>Lugar de nacimiento*:</label></div>
                    <div class="caTex"><input type="text" id="LugNacimiento" name="LugNacimiento" value="<?php echo $LugNacimiento; ?>" size="25" /></div><br/>         
<?php
$query = "SELECT NumPais, NomPais FROM pais ORDER BY NomPais";
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
                    <div class='caTex'><select id='NumEstadoCivil' name='NumEstadoCivil'>";
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
                    <div class="caTex"><input type="text" id="Ocupacion" name="Ocupacion" value="<?php echo $Ocupacion; ?>" size="30" /></div><br/>
                    <div class="etiq"><label>Teléfono personal*:</label></div>
                    <div class="caTex"><input type="text" id="TelPersonal" name="TelPersonal" value="<?php echo $TelPersonal; ?>" size="10" /></div><br/>
                    <div class="etiq"><label>Dirección*:</label></div>
                    <div class="caTex"><textarea name="DirHabitual" id="DirHabitual" rows="4" cols="20"><?php echo $DirHabitual; ?></textarea></div><br/>
<?php
$query = "SELECT NumDepartamento, NomDepartamento FROM departamento ORDER BY NumDepartamento";
$result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());

echo "<div class='etiq'><label>Departamento:</label></div>
                    <div class='caTex'><select id='NumDepartamento' name='NumDepartamento'>";
if ($row = mysql_fetch_array($result)) {
    do {
        echo "<option value = '" . $row["NumDepartamento"] . "'>" . $row["NomDepartamento"] . "</option>";
    } while ($row = mysql_fetch_array($result));
    echo '</select></div><br/>';
} else {
    echo "<p>Error en registro de departamentos</p>";
}
?>

                   <div class='etiq'><label>Municipio:</label></div>
                    <div class='caTex'><select id='NumMunicipio' name='NumMunicipio'></select></div><br/>

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
                    <div class="caTex"><input type="text" id="TelTrabajo" name="TelTrabajo" value="<?php echo $TelTrabajo; ?>" size="10" /></div><br/>
                    <div class="etiq"><label>Número de afiliado*:</label></div>
                    <div class="caTex"><input type="text" id="NumAfiliacion" name="NumAfiliacion" value="<?php echo $NumAfiliacion; ?>" size="20" /></div><br/>
                    <div class="etiq"><label>Contacto de emergencia*:</label></div>
                    <div class="caTex"><input type="text" id="contEmergencia" name="contEmergencia" value="<?php echo $contEmergencia; ?>" size="30" /></div><br/>
                    <div class="etiq"><label>Teléfono de emergencia*:</label></div>
                    <div class="caTex"><input type="text" id="TelEmergencia" name="TelEmergencia" value="<?php echo $TelEmergencia; ?>" size="10" /></div><br/><br/>
                    <p> 
                        <input type="submit" value="Editar" name="Editar" data-ajax="false"/>
                        <input type="reset" value="Cancelar" name="canPro" onClick="$('label.error').remove();"/>
                        <a href="consulPaciente.php" data-ajax="false"><button type="button">Regresar</button></a>
                    </p>
                </form>

            </div>
        </div>    

        <script type="text/javascript">

                     $(document).on('pageinit', function() {
                llenar();
                $("#PaisNacimiento").val('68');
            });

            function llenar() {
                var arrayiddeps = <?php echo json_encode($arrayiddeps); ?>;
                var arrayidmuns = <?php echo json_encode($arrayidmuns); ?>;
                var arrayidnoms = <?php echo json_encode($arraynommuns); ?>;
                var combodep = $('#NumDepartamento').val();
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

            $('#NumDepartamento').change(function() {
                llenar();
            });


        </script>
    </body>
</html>