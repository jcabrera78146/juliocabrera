<?php 
	
	$alert = '';
	
session_start();
if (!empty($_SESSION['active'])) 
{
	header('location: sistema/');
}else{

	if (!empty($_POST))
	{
		if (empty($_POST['usuario']) || empty($_POST['clave'])) 
		{
			$alert = 'Ingrese Usuario y Clave';
		}else{

			require_once "conexion.php";
			$user = $_POST['usuario'];
			$pass = $_POST['clave'];

			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario ='$user' AND clave= '$pass'");
			$result = mysqli_num_rows($query);

			if ($result > 0) 
			{
				$data = mysqli_fetch_array($query);
				
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email'] = $data['correo'];
				$_SESSION['user'] = $data['usuario'];
				$_SESSION['rol'] = $data['rol'];
				
				header('location: sistema/');
			}else{
				$alert = 'Usuario y Contraseña Incorrecto';
				session_destroy();
			}
		}
	}
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Sistema Colegio</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<section id="container">
		<form action="" method="post">

			<h3>Iniciar Sesión</h3>
			<img src="img/login.png" alt="Login" width="150" height="150">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"> <?php echo isset($alert) ? $alert: ''; ?> </div>
			<input type="submit" value="INGRESAR">
		</form>

	</section>
</body>
</html>