<?php
$titulo = "Caso practico";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo"<h1>Caso práctico: archivo a eliminar</h1>" . PHP_EOL;
echo '<a href="CasoPractico.php" class="volver">Volver<a/></br></br>' . PHP_EOL;

require_once '../Modelo/archivos.php';
require_once '../Modelo/ruta.php';
require_once '../Modelo/tipo.php';
$queryc = "INSERT INTO archivos ";
$queryc .= "(Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción)";
$queryc .= " VALUES('C:borrar', 'Borrar', 500, 1, 15/06/2021 15:21:35, 15/06/2021 15:21:35, 'borrar';";
$queryr = "SELECT IdArchivo, Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción";
$queryr .= " FROM archivos A JOIN rutas as R ON R.IdRuta= A.IdRuta";
$queryr .= " JOIN `Tipos de Contenidos` as T ON T.IdTIpoContenido = A.IdTIpoContenido;";

$archivo = new archivos("archivos", $queryc, $queryr);
$ruta = new rutas();
$tipo = new tipo();


if($_GET && !$_POST){

    $IdArchivo = $_GET['IdArchivo'];
    $fila = $archivo->buscaArchivos($IdArchivo);	
    $fila = $fila[0];
    
    
    $NombreArchivo = $fila["Nombre"];
    $Tamano = $fila["Tamano"];
    $FechaCreado = $fila["FechaCreado"]; 
    $FechaModifica  = $fila["FechaModifica"];

    $Persona = $fila["NombreTexto"];
    $Ruta = $fila["RutaTexto"];
    $Descripcion = $fila["TipoTexto"];

?>
<!--Formulario de captura-------------------------------------------------------------------------------------------------------------------------->

<div class="formulario">
        <h3>Registro a eliminar</h3>
        <form action="" method="post" enctype="multipart/form-data">
            Ruta: <br/>
            <input type="text" name="Ruta" value="<?php echo "$Ruta";?>" readonly><br/>
            
            Nombre del archivo: <br/>
            <input type="text" name="NombreArchivo" value="<?php echo "$NombreArchivo";?>" readonly><br/>
            
            Tamaño: <br/>
            <input type="text" name="Tamano"  value= "<?php echo "$Tamano";?>" readonly><br/>
            
            Persona: <br/>
            <input type="text" name="Persona" value="<?php echo "$Persona";?>" readonly><br/>
            
            Fecha de creación: <br/>
            <input type="text" name="FechaCreado" value="<?php echo "$FechaCreado";?>" readonly><br/>
            
            Fecha de última modificación: <br/>
            <input type="text" name="FechaModifica" value="<?php echo "$FechaModifica";?>" readonly><br/>
            
            Descripción: <br/>
            <input type="text" name="Descripcion"  value= "<?php echo "$Descripcion";?>" readonly><br/>

            <input type="submit" name="enviar" value="Eliminar">
            <input type="hidden" name="IdArchivo" value="<?php echo "$IdArchivo"?>">

        </form>
    </div>

 <?php
}else{

    $IdArchivo = $_GET['IdArchivo'];

    $Ruta  = $_POST["Ruta"];
    $NombreArchivo = $_POST["NombreArchivo"];
    $Tamano = $_POST["Tamano"];
    $Persona = $_POST["Persona"];
    $FechaCreado = $_POST["FechaCreado"];
    $FechaModifica  = $_POST["FechaModifica"];
    $Descripcion = $_POST["Descripcion"];

    $archivo->setIdArchivo($IdArchivo);
    $archivo->eliminaArchivos();
?>

<!--Formulario de validar-------------------------------------------------------------------------------------------------------------------------->
<div class="formulario">
        <h3>Registro eliminado</h3>
        <form action="CasoPractico.php" method="post" enctype="multipart/form-data">
            Ruta: <br/>
            <input type="text" name="Ruta" value="<?php echo "$Ruta";?>" readonly><br/>
            
            Nombre del archivo: <br/>
            <input type="text" name="NombreArchivo" value="<?php echo "$NombreArchivo";?>" readonly><br/>
            
            Tamaño: <br/>
            <input type="text" name="Tamano"  value= "<?php echo "$Tamano";?>" readonly><br/>
            
            Persona: <br/>
            <input type="text" name="usuario" value="<?php echo "$Persona";?>" readonly><br/>
            
            Fecha de creación: <br/>
            <input type="text" name="FechaCreado" value="<?php echo "$FechaCreado";?>" readonly><br/>
            
            Fecha de última modificación: <br/>
            <input type="text" name="FechaModifica" value="<?php echo "$FechaModifica";?>" readonly><br/>
            
            Descripción: <br/>
            <input type="text" name="Descripcion"  value= "<?php echo "$Descripcion";?>" readonly><br/>

            <input type="submit" name="enviar" value="Aceptar">

        </form>
    </div>

<?php
}

include "../Vista/piePagina.phtml";
?>