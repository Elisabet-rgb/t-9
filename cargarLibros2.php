 <?php
/**
 * Mostrar una lista de titulos relacionados con el parámetro q
 * @access public
 * @param string
 * @author Elisabet Rodriguez Barbosa  <erodba6@gmail.com>
 * @return correcto mostrando un array asociativo con los datos.
 * @return null si hay un error
 */
$salida = "";

if (isset($_GET["q"]))//seteamos el parametro q
{
	$nombre = $_GET["q"];

	
	$mysqli = new mysqli("sql308.byethost8.com","b8_27138338","Alejandro1","b8_27138338_Libros");
		if (!$mysqli->connect_error)
	{
		$mysqli->set_charset("utf8");
		$sql = "SELECT * FROM Autor WHERE nombre  LIKE '%$nombre%' ORDER BY nombre";	
		if (($resultado = $mysqli->query($sql)) && (!$mysqli->error))
		{	
		
		if(isset($_GET ["id"]))
		$id=$_GET ["id"];
		else $id="";
	
 while ($fila = $resultado->fetch_assoc())
            {
                //Procesar result set como asociativo
                $salida = $salida . "<br>". $fila["nombre"]. " - ". $fila["id"] . "<br>"; 
                //Obtener libros del autor
                $sql = "SELECT * FROM Libro WHERE id_autor='{$fila[id]}' ORDER BY titulo";
                		echo $mysqli->error;
                if (($resultado2 = $mysqli->query($sql)) && (!$mysqli->error))
                {   
                 //Trabajar con datos
                 while ($fila2 = $resultado2->fetch_assoc())
                 {
                     //Procesar result set como asociativo
                    $salida = $salida . "&nbsp;&nbsp;" . $fila2["titulo"] . "<br>";
                  }

			
}}
        $resultado->free();
		$resultado2->free();
		$mysqli->close();
		
		
}}
echo $salida;
}