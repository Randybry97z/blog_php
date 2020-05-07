<?php

if (isset($_POST)) {
  //Conexión SQL
  require_once 'includes/conexion.php';

  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

  //Array de errores
  $errores = array();

  //Validar datos antes de guardar en bd

  //Validar nombre
  if (!empty($nombre) && !is_numeric($nombre)) {
    $nombre_validate = true;
  }else{
    $nombre_validate = false;
    $errores['nombre'] = "El nombre no es válido";
  }

  if (count($errores) == 0) {
    $sql = "INSERT INTO categorias VALUES (NULL, '$nombre');";
    $guardar = mysqli_query($db,$sql);
  }

}

header("Location: index.php");
?>
