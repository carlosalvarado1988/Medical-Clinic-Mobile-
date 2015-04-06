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
        
        <title>Registrar Receta</title>
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



                <form name="RegMed" method="POST" id="RegMed" action="#">
                    <p><label>CONTROL RECETAS</label></p>
                    <div class="etiq"><label>No de historial*:</label></div>
                    <div class="caTex"><input type="text" id="histNum" name="histNum" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Numero Medicamento*:</label></div>
                    <div class="caTex"><input type="text" id="NumeroMedicamento" name="NumeroMedicamento" value="" size="5" /></div><br/>
                    <div class="etiq"><label>Dosis Medicamento*:</label></div>
                    <div class="caTex"><input type="text" id="DosisMedicamento" name="DosisMedicamento" value="" size="10" /></div><br/>
                    <div class="etiq"><label>Cantidad Medicamento*:</label></div>
                    <div class="caTex"><input type="text" id="CantidadMedicamento" name="CantidadMedicamento" value="" size="5" /></div><br/>
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
                        if (mysql_num_rows($result) > 0) {
                            $array = array();
                            foreach ($_POST as $param_name => $param_val) {
                                $array[] = $param_val;
                            }

                            mysql_query("insert into controlmedicamento (NumHistorialClinico, NumMedicamento, DosisMedicamento, CantMedicamento) values('$array[0]', '$array[1]', '$array[2]', $array[3])", $link);
                            mysql_close($link);
                            echo "<h2 style=color:red>Registro almacenado satisfactoriamente</h2>       <a href='consulMedicamento.php'> Ver Catalogo de Medicamento</a>";
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