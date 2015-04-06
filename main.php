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
        <link rel="StyleSheet" media="screen" type="text/css" href="FormatosEstilos/jquery.mobile-1.3.2.css">
        <!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" /> */ -->
        <title>SISTEMA CLINICA EMPRESARIAL MINISTERIO DE HACIENDA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet"  href="../../../css/themes/default/jquery.mobile-1.3.0-beta.1.css">
        <link rel="stylesheet" href="../_assets/css/jqm-docs.css"/>


        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

        <script src="../../../js/jquery.mobile-1.3.0-beta.1.js"></script>
        <script src="../../docs/_assets/js/jqm-docs.js"></script>
		<script type="text/javascript">
			$(document).bind("mobileinit", function () {
				$.mobile.ajaxEnabled = false;
			});
		</script>
    </head>
    <body>


        <div data-role="page" class="ui-responsive-panel">


            <div data-role="header" data-theme="f">

                <h1>CLINICA EMPRESARIAL</h1>
                <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
                <a href="#add-form" data-icon="plus" data-iconpos="notext">Add</a>

            </div><!-- /header -->
            <div data-role="content">
                <div class="content-primary">	
                    <ul data-role="listview">
                        <li>
                            <h3>Control de Pacientes</h3>
                            <p>Administracion de informacion de Pacientes.</p>

                            <ul>
                                <li><a href="Paciente/consulPaciente.php">Registro Paciente</a></li>
                                <li><a href="/Paciente/consulDatosMedicos.php">Registro Clinico</a></li>
                                <li><a href="/Paciente/consulHistoMedico.php">Historial Clinico</a></li>

                            </ul>
                        </li>
                        <li>

                            <h3>Control de Citas</h3>
                            <p>Administracion de Citas de Pacientes</p>

                            <ul>

                                <li><a href="/Cita/consulCita.php">Registro de Citas</a></li>
                            </ul>
                        </li>
                        <li>
                            <h3>Control de Examenes de Laboratorio</h3>
                            <p>Administracion de Examenes de Laboratorio de Pacientes.</p>

                            <ul>

                                <li><a href="/ExaLab/consulExaLabo.php">Registro de examen</a></li>
                            </ul>
                        </li>
						<li>
                            <h3>Control de Recetas</h3>
                            <p>Administracion de Recetas de Pacientes.</p>

                            <ul>

                                <li><a href="/ControlMed/consulMedicamento.php">Registro de receta</a></li>
                            </ul>
                        </li>
                        <li>
                            <h3>Mantenimiento</h3>
                            <p>Administracion de los catalogos de informacion</p>

                            <ul>

                                <li><a href="/Depart/MostraDep.php">Departamento</a></li>
								<li><a href="/Munic/mostrarMunic.php">Municipio</a></li>
								<li><a href="/LugTraba/MostraLugTrab.php">Dependencia</a></li>
								<li><a href="/Enfermedades/mostraManEnfer.php">Registro de enfermedades</a></li>
								<li><a href="/EstCivil/mostraManEstCivil.php">Registro Estado Civil</a></li>
								<li><a href="/Pais/mostraManPais.php">Registro de Pais</a></li>
								<li><a href="/TipSangre/MostraTipSan.php">Tipo de Sangre</a></li>
								<li><a href="/Usuario/mostraUsuario.php">Usuarios</a></li>
                            </ul>


                        </li>
						
                    </ul>
                </div><!--/content-primary -->


            </div><!-- /content -->
                <div data-role="panel" data-inset="false" data-position="left" data-position-fixed="false" data-display="reveal" id="nav-panel" data-theme="a">
        <ul data-role="listview" data-theme="a" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
            <li data-icon="delete" style="background-color:#111;">
                <a href="#" data-rel="close">Cerrar menu</a>			
            </li>

        </ul>




        <h3>Control de Pacientes</h3>
        <ul data-role="listview" data-theme="a" data-inset="false" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
            <li><a href="/Paciente/consulPaciente.php">Pacientes</a></li>
            <li><a href="/Paciente/consulDatosMedicos.php">Registro Clinico</a></li>
            <li><a href="/Paciente/consulHistoMedico.php">Historial Clinico</a></li>
        </ul>


        <h3>Control de Citas</h3>
        <ul data-role="listview" data-theme="a" data-inset="false" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
            <li><a href="/Cita/consulCita.php">Registro de Citas</a></li>
        </ul>



        <h3>Control de Examenes de Laboratorio</h3>
        <ul data-role="listview" data-theme="a" data-inset="false" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
            <li><a href="/ExaLab/consulExaLabo.php">Registro de examen</a></li>
        </ul>
		
		<h3>Control de Recetas</h3>
        <ul data-role="listview" data-theme="a" data-inset="false" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
            <li><a href="/ControlMed/consulMedicamento.php">Registro de receta</a></li>
        </ul>



        <h3>Mantenimiento</h3>
        <ul data-role="listview" data-theme="a" data-inset="false" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
            <li><a href="/Depart/MostraDep.php">Departamento</a></li>
            <li><a href="/Munic/mostrarMunic.php">Municipio</a></li>
            <li><a href="/LugTraba/MostraLugTrab.php">Dependencia</a></li>
            <li><a href="/Enfermedades/mostraManEnfer.php">Registro de enfermedades</a></li>
            <li><a href="/EstCivil/mostraManEstCivil.php">Registro Estado Civil</a></li>
            <li><a href="/Pais/mostraManPais.php">Registro de Pais</a></li>
            <li><a href="/TipSangre/MostraTipSan.php">Tipo de Sangre</a></li>
			<li><a href="/Usuario/mostraUsuario.php">Usuarios</a></li>
        </ul>



    </div><!-- /panel -->	

            <style>
                .userform { padding:.8em 1.2em; }
                .userform h2 { color:#555; margin:0.3em 0 .8em 0; padding-bottom:.5em; border-bottom:1px solid rgba(0,0,0,.1); }
                .userform label { display:block; margin-top:1.2em; }
                .switch .ui-slider-switch { width: 6.5em !important }
                .ui-grid-a { margin-top:1em; padding-top:.8em; margin-top:1.4em; border-top:1px solid rgba(0,0,0,.1); }
            </style>

            <div data-role="panel" data-position="right" data-position-fixed="false" data-display="overlay" id="add-form" data-theme="b">

                <form class="userform">
                    <h2>Create new user</h2>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="" data-clear-btn="true" data-mini="true">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="status" value="" data-clear-btn="true" data-mini="true">

                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true">

                    <div class="switch">
                        <label for="status">Status</label>
                        <select name="status" id="slider" data-role="slider" data-mini="true">
                            <option value="off">Inactive</option>
                            <option value="on">Active</option>
                        </select>
                    </div>

                    <div class="ui-grid-a">
                        <div class="ui-block-a"><a href="#" data-rel="close" data-role="button" data-theme="c" data-mini="true">Cancel</a></div>
                        <div class="ui-block-b"><a href="#" data-rel="close" data-role="button" data-theme="b" data-mini="true">Save</a></div>
                    </div>
                </form>

                <!-- panel content goes here -->
            </div><!-- /panel -->	
            <div data-role="footer"> 
                <h4> 
                    <?php
                    bienvenida();
                    ?>
                </h4> 

            </div> 

        </div> 


    </body>
</html>

