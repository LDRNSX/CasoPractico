<?php
$titulo = "CP";
$filecss = "../CSS/ejemplos.css";
$body = "";
include '../Vista/encabezado.phtml';
include '../Vista/nav-menu.php';

echo '<div class="col-sm-10">' . PHP_EOL;
echo"<h1>Caso práctico</h1>" . PHP_EOL;

echo "<ul>". PHP_EOL;
echo"<li>Crear la clase <b>archivos</b>.</li>" . PHP_EOL;
echo"<li>Crear la clase <b>ruta</b>.</li>" . PHP_EOL;
echo"<li>Crear la clase <b>tipo</b>.</li>" . PHP_EOL;
echo"<li>CRUD de la tabla archivos.</li>" . PHP_EOL;
echo "<ul>". PHP_EOL;
include "../Vista/piePagina.phtml";
?>