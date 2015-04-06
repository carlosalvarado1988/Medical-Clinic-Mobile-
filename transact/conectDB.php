<?php function conectar() { 
	if (!($link=mysql_connect("127.0.0.1:3306","root",""))){
		echo "Error conectando a la base de datos."; 
		exit(); 
	}
	if (!mysql_select_db("clinica", $link)){
		echo "Error seleccionando la base de datos.";
		exit(); 
	}
	 return $link; 
         
} ?>