<?php
//Iniciar sesión y conexión a bd
require_once 'includes/conexion.php';


//Recoger datos de formulario
if (isset($_POST)) {

  //BORRAR ERROR ANTIGUO
    if (isset($_SESSION['error-login'])) {
          session_unset($_SESSION['error-login']);
        }
  //Recoger datos de formulario
  $email = trim($_POST['email']);
  $pass = $_POST['password'];


  //Consulta a bd si el email y contraseña coinciden
  $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
  $login = mysqli_query($db, $sql);
  if ($login && mysqli_num_rows($login) == 1) {
    $usuario = mysqli_fetch_assoc($login);
  /*  var_dump($usuario);
    die(); */
    //Comprobar contraseña /cifrar
    $verify = password_verify($pass, $usuario['password']);
    if ($verify) {
      //Usar sesión para guardar datos de usuario logueado
      $_SESSION['usuario'] = $usuario;

    }else {
      //Si falla hacer sesión con el fallo
      $_SESSION['error-login'] = "Login Incorrecto";
    }
  }else {
    //Mensaje de error
    $_SESSION['error-login'] = "Login Incorrecto";
  }

}


//Redirigir al index.php
header('Location: index.php');


?>
