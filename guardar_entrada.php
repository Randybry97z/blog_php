<?php

if (isset($_POST)) {
  //Conexión SQL
  require_once 'includes/conexion.php';

  $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
  $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
  $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
  $usuario = $_SESSION['usuario']['id'];
  //Array de errores
  $errores = array();

  //Validar datos antes de guardar en bd

  //Validar titulo
  if (empty($titulo)) {
    $errores['titulo'] = "El titulo no es válido";
  }
  if (empty($descripcion)) {
    $errores['descripcion'] = "No hay descripcion de entrada";
  }
  if (empty($categoria) && !is_numeric($categoria)) {
    $errores['categoria'] = "No existe la categoria";
  }
  /*  var_dump($errores);
  die(); */

  if (count($errores) == 0) {
    if ($_GET['editar']) {
      $entrada_id = $_GET['editar'];
      $usuario_id = $_SESSION['usuario']['id'];
      $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id = $categoria ".
              "WHERE id = $entrada_id AND usuario_id = $usuario_id ";
    } else {
      $sql = "INSERT INTO entradas VALUES (NULL, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
    }

    $guardar = mysqli_query($db,$sql);
    header("Location: index.php");
  }else {
    $_SESSION['errores-entrada'] = $errores;
    if($_GET['editar']){
      header("Location: editar_entrada.php?id=".$_GET['editar']);
    }else{
    header("Location: crear_entradas.php");
  }
  }

}
?>
