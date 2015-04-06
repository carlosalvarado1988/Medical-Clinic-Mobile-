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
        
        <title>Enfermedades</title>
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
                $query = "SELECT * FROM enfermedades ORDER BY NumEnfermedad ASC";
                $result = mysql_query($query, $link) or die($sql . ">>" . mysql . error());
                ?>
   

           
                <?php
                include "../menu.html";
                ?>
          

          <div data-role="content">

          

                    <table>

                        <thead>
                            <tr>

                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Editar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($row = mysql_fetch_array($result)) {
                                do {

                                    echo "<tr><td>" . $row["NomEnfermedad"] . "</td><td>" . $row["DescripEnfermedad"] . "</td><td><a href='ActuManEnfer.php?NumEnfermedad=" . $row["NumEnfermedad"] . "'><center><img src = '../images/edit.png' alt='Editar' height='25' width='25'></a></center></td></tr>";
                                } while ($row = mysql_fetch_array($result));
                                echo "</table> \n";
                            } else {
                                echo "� No se ha encontrado ning�n registro !";
                            }
                            ?>


                        </tbody>

                    </table>
				<a href="ManEnfer.php"><button type="button" data-inline="true">Registrar Enfermedad</button></a>

            </div>
        </div>    


    </body>
</html>






