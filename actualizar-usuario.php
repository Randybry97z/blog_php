<?php
/*
var_dump($_POST);
*/
if (isset($_POST)) {

  //Conexión SQL
  require_once 'includes/conexion.php';


  //Recoger los valores del formulario de actualizacion
  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
  $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

  //Array de errores
  $errores = array();

  //Validar datos antes de guardar en bd

  //Validar nombre
  if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
    $nombre_validate = true;
  }else{
    $nombre_validate = false;
    $errores['nombre'] = "El nombre no es válido";
  }

  //Validar apellidos
  if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
    $apellidos_validate = true;
  }else{
    $apellidos_validate = false;
    $errores['apellidos'] = "El apellido no es válido";
  }

  //Validar email
  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_validate = true;
  }else{
    $email_validate = false;
    $errores['email'] = "El email no es válido";
  }

  $guardar_usuario = false;
  if (count($errores) == 0) {
    $usuario = $_SESSION['usuario'];
    $guardar_usuario = true;

    //Comprobar si existe el email
    $sql = "SELECT id,email FROM usuarios WHERE email = '$email';";
    $isset_email = mysqli_query($db,$sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

  if (isset($isset_user['id']) == $usuario['id'] || empty($isset_user)) {

    // Actualizar usuario en base de datos en tabla usuarios

    $sql = "UPDATE usuarios SET ".
    "nombre='$nombre', apellido='$apellidos', email='$email'".
    "WHERE id= ".$usuario['id'];
    $guardar = mysqli_query($db,$sql);

/*    var_dump(mysqli_error($db));
    die(); */

    if ($guardar) {
      $_SESSION['usuario']['nombre'] = $nombre;
      $_SESSION['usuario']['apellidos'] = $apellidos;
      $_SESSION['usuario']['email'] = $email;
      $_SESSION['completado'] = "El registro se ha actualizado con éxito";
    }else {
      $_SESSION['errores']['general'] = "Fallo al actualizar el usuario";
    }
  }else{
    $_SESSION['errores']['general'] = "El usuario ya existe";

  }

  }else {
    $_SESSION['errores'] = $errores;
  }
}

header('Location: perfil.php');

?>
