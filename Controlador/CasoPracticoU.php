<?php
$titulo = "Caso practico";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo"<h1>Caso práctico: archivo a modificar</h1>" . PHP_EOL;
echo '<a href="CasoPractico.php" class="volver">Volver<a/></br></br>' . PHP_EOL;

require_once '../Modelo/archivos.php';
require_once '../Modelo/ruta.php';
require_once '../Modelo/tipo.php';
require_once '../Modelo/personas.php';

$queryc = "INSERT INTO archivos ";
$queryc .= "(Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción)";
$queryc .= " VALUES('C:borrar', 'Borrar', 500, 1, 15/06/2021 15:21:35, 15/06/2021 15:21:35, 'borrar';";
$queryr = "SELECT IdArchivo, Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción";
$queryr .= " FROM archivos A JOIN rutas as R ON R.IdRuta= A.IdRuta";
$queryr .= " JOIN `Tipos de Contenidos` as T ON T.IdTIpoContenido = A.IdTIpoContenido;";

$archivo = new archivos("archivos", $queryc, $queryr);
$ruta = new rutas();
$tipo = new tipo();
$persona = new personas();


if($_GET && !$_POST){

    $IdArchivo = $_GET['IdArchivo'];
    $fila = $archivo->buscaArchivos($IdArchivo);	
    $fila = $fila[0];
    
    
    $NombreArchivo = $fila["Nombre"];
    $Tamano = $fila["Tamano"];
    $FechaCreado = $fila["FechaCreado"]; 
    $FechaModifica  = $fila["FechaModifica"];
    $IdRuta = $fila["IdRuta"];
    $IdTipoContenido = $fila["IdTipoContenido"];
    $IdPersona = $fila["IdPersona"];

    $Ruta = array($ruta->listaRuta());
    $Ruta = $Ruta[0];

    $Descripcion = array($tipo->listaTipoContenido());
    $Descripcion = $Descripcion[0];

    $Persona = array($persona->listaDatos());
    $Persona = $Persona[0];
?>
<!--Formulario de captura-------------------------------------------------------------------------------------------------------------------------->


<div class="formulario">
    <h3>Registro a modificar</h3>
    <form action="" method="post" enctype="multipart/form-data">
        Ruta: <br/>
        <select name="IdRuta">    
        <?php foreach ($Ruta as $valores){?>
        <option value="<?php echo ''.$valores["IdRuta"].'' ?>"
        <?php if ($valores["IdRuta"] == $IdRuta) {echo 'selected';}?> > 
        <?php echo ''.$valores["Ruta"].'</option>'; }'' ?>
        </select>
        <br/>
        
        Nombre del archivo: <br/>
        <input type="text" name="NombreArchivo" value="<?php echo "$NombreArchivo";?>" required><br/>
        
        Tamaño: <br/>
        <input type="number" name="Tamano" value="<?php echo "$Tamano";?>" required><br/>
        
        Persona: <br/>
        <select name="IdPersona">
        <?php foreach ($Persona as $valores){?>
        <option value="<?php echo ''.$valores["IdPersona"].'' ?>"
        <?php if ($valores["IdPersona"] == $IdPersona) {echo 'selected';}?> > 
        <?php echo ''.$valores["Nombre"].'</option>'; }'' ?>
        </select>
        <br/>
        
        Fecha de creación: <br/>
        <input type="datetime-local" name="FechaCreado" value="<?php echo date('Y-m-d\TH:i', strtotime($FechaCreado));?>" required><br/>
        
        Fecha de última modificación: <br/>
        <input type="datetime-local" name="FechaModifica" value="<?php echo date('Y-m-d\TH:i', strtotime($FechaModifica));?>" required><br/>
        
        Descripción: <br/>
        <select name="IdTipoContenido">
        <?php foreach ($Descripcion as $valores){?>
        <option value="<?php echo ''.$valores["IdTipoContenido"].'' ?>"
        <?php if ($valores["IdTipoContenido"] == $IdTipoContenido) {echo 'selected';}?> > 
        <?php echo ''.$valores["Descripción"].'</option>'; }'' ?>
        </select>
        <br/>

        <input type="submit" name="enviar" value="Modificar">
        <input type="hidden" name="IdArchivo" value="<?php echo "$IdArchivo"?>">

    </form>
    </div>

 <?php
}else{

    $IdArchivo = $_GET['IdArchivo'];

    $Ruta  = $_POST["IdRuta"];
    $NombreArchivo = $_POST["NombreArchivo"];
    $Tamano = $_POST["Tamano"];
    $Persona = $_POST["IdPersona"];
    $FechaCreado = $_POST["FechaCreado"];
    $FechaModifica  = $_POST["FechaModifica"];
    $Descripcion = $_POST["IdTipoContenido"];

    $archivo->setIdArchivo($IdArchivo);
    $archivo->setRuta($Ruta);
    $archivo->setNombreArchivo($NombreArchivo);
    $archivo->setTamano($Tamano);
    $archivo->setPersona($Persona);
    $archivo->setFCrea($FechaCreado);
    $archivo->setFMod($FechaModifica);
    $archivo->setTipo($Descripcion);
    $archivo->modificaArchivos();
?>

<!--Formulario de validar-------------------------------------------------------------------------------------------------------------------------->
<div class="formulario">
        <h3>Registro modificado</h3>
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