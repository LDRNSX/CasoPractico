<?php
$titulo = "CP";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo"<h1>Caso práctico</h1>" . PHP_EOL;

require_once '../Modelo/archivos.php';

//Paginacion----------------------------------------------------------------------------------------------------------------------------------------------
$per_page_record = 10;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
  $page_no = $_GET['page_no'];
} else {
  $page_no = 1;
}

$start_from = ($page_no - 1) * $per_page_record;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

//Conexion base de datos------------------------------------------------------------------------------------------------------------------------------
$queryc = "INSERT INTO archivos ";
$queryc .= "(Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción)";
$queryc .= " VALUES('C:borrar', 'Borrar', 500, 1, 15/06/2021 15:21:35, 15/06/2021 15:21:35, 'borrar';";
$queryr = "SELECT IdArchivo, Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción";
$queryr .= " FROM archivos A JOIN rutas as R ON R.IdRuta= A.IdRuta";
$queryr .= " JOIN `Tipos de Contenidos` as T ON T.IdTIpoContenido = A.IdTIpoContenido";
$queryr .= " LIMIT $start_from, $per_page_record;";

$archivo = new archivos("archivos", $queryc, $queryr);

//Tabla-------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo '<br/><a href="CasoPracticoC.php?IdArchivo=0" class="agregar">Agregar nuevo<a/></br></br>' . PHP_EOL;

foreach ($archivo->tablaArchivos("CasoPractico") as $key => $value) {
	echo $value;
}


//--Variables de la base de datos para la paginacion------------------------------------------------------------------------------------------------------------------------------------------>
/*$consulta = "SELECT COUNT(*) FROM archivos";     
$resultado = mysqli_query($conexion, $consulta);     
$columna = mysqli_fetch_row($resultado);*/
  $columna = $archivo->contarArchivos(); 
  $total_records = $columna[0];
  // Number of pages required.   
  $total_pages = ceil($total_records / $per_page_record);  
  $second_last = $total_pages - 1;   
  $paglink = "";   
?>

<!-- Paginacion--------------------------------------------------------------------------------------------------------------------------------->
<div class="pagination">
    <div class="ir">
    <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page_no . "/" . $total_pages; ?>" required>
    <button onClick="go2Page();">Ir</button>
</div>
<script>
  function go2Page() {
    var page = document.getElementById("page").value;
    page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
    window.location.href = 'CasoPractico.php?page=' + page;
  }
</script>

<!-- Botones para moverte de paginas, siguiente, anterior, etc--------------------------------------------------------------------------------------------------------------------------------->
<?php if($page_no > 1){
echo "<div><a href='?page_no=1'>Primera</a></div>";
} ?>
    
<div <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($page_no > 1){
echo "href='?page_no=$previous_page'";
} ?>>Anterior</a>
</>

<?php
if ($total_pages <= 10){  	 
	for ($counter = 1; $counter <= $total_pages; $counter++){
	if ($counter == $page_no) {
	echo "<div class='active'><a>$counter</a></div>";	
	        }else{
        echo "<div><a href='?page_no=$counter'>$counter</a></div>";
                }
        }
}
if($page_no <= 4) {			
  for ($counter = 1; $counter < 8; $counter++){		 
   if ($counter == $page_no) {
      echo "<div class='active'><a>$counter</a></div>";	
     }else{
            echo "<div><a href='?page_no=$counter'>$counter</a></div>";
                 }
 }
 echo "<div><a>...</a></div>";
 echo "<div><a href='?page_no=$second_last'>$second_last</a></div>";
 echo "<div><a href='?page_no=$total_pages'>$total_pages</a></div>";
 }
elseif($page_no > 4 && $page_no < $total_pages - 4) {		 
  echo "<div><a href='?page_no=1'>1</a></div>";
  echo "<div><a href='?page_no=2'>2</a></div>";
  echo "<div><a>...</a></div>";
  for (
       $counter = $page_no - $adjacents;
       $counter <= $page_no + $adjacents;
       $counter++
       ) {		
       if ($counter == $page_no) {
    echo "<div class='active'><a>$counter</a></div>";	
    }else{
          echo "<div><a href='?page_no=$counter'>$counter</a></div>";
            }                  
         }
  echo "<div><a>...</a></div>";
  echo "<div><a href='?page_no=$second_last'>$second_last</a></div>";
  echo "<div><a href='?page_no=$total_pages'>$total_pages</a></div>";
  }
?>

<div <?php if($page_no >= $total_pages){
echo "class='disabled'";
} ?>>
<a <?php if($page_no < $total_pages) {
echo "href='?page_no=$next_page'";
} ?>>Siguiente</a>
</div>

<?php if($page_no < $total_pages){
echo "<div><a href='?page_no=$total_pages'>Última &rsaquo;&rsaquo;</a></div>";
} ?>
</div>


<?php
include "../Vista/piePagina.phtml";
?>