<?php
/*
var_dump($_POST);
*/
if (isset($_POST)) {

  //Conexión SQL
  require_once 'includes/conexion.php';

  //Iniciar Sesión
  if (!isset($_SESSION)) {
    session_start();
  }

  //Recoger los valores del formulario de registro
  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
  $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
  $password = isset($_POST['contraseña']) ? mysqli_real_escape_string($db, $_POST['contraseña']) : false;

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

  //Validar password
  if (!empty($password)) {
    $password_validate = true;
  }else{
    $password_validate = false;
    $errores['contraseña'] = "La contraseña está vacía";
  }


  $guardar_usuario = false;
  if (count($errores) == 0) {
    $guardar_usuario = true;

    //Cifrar la contraseña
    $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

    // Insertar usuario en base de datos en tabla usuarios

    $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
    $guardar = mysqli_query($db,$sql);

/*    var_dump(mysqli_error($db));
    die(); */

    if ($guardar) {
      $_SESSION['completado'] = "El registro se ha completado con éxito";
    }else {
      $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
    }

  }else {
    $_SESSION['errores'] = $errores;
  }
}

header('Location: index.php');

?>
