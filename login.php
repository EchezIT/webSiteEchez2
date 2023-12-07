<?php
    ob_start();
?>
<?php
	include 'controlador/configBd.php';
    include_once 'controlador/ControlEntidad.php';
    include_once 'controlador/ControlConexionPdo.php';
	include 'controlador/ControlConexion.php';
	include 'controlador/ControlUsuario.php';
	include 'modelo/Usuario.php';
    include_once 'modelo/Entidad.php';
    session_start();
	$boton = "";
    $Id = "";
	$ema = "";
	$con = "";
	$objControlUsuario = new ControlUsuario(null);
	//var_dump($arregloUsuarios);
	if (isset($_POST['bt'])) $boton = $_POST['bt'];//toma del arreglo post el value del bt	
	if (isset($_POST['txtEmail'])) $ema = $_POST['txtEmail'];
	if (isset($_POST['txtContrasena'])) $con = $_POST['txtContrasena'];
	switch ($boton) {
		case 'Login':
			$objUsuario = new Usuario(0,"",$ema, $con);
			$objControlUsuario = new ControlUsuario($objUsuario);
			//$objControlUsuario->validarIngreso();
			$validacionExitosa = $objControlUsuario->validarIngreso();
            if($validacionExitosa){
                $_SESSION['email']=$ema;
                //$datosUsuario = ['email' => $email, 'contrasena' => $contrasena];
		//$objUsuario = new Entidad($datosUsuario);
                $objControlRolUsuario = new ControlEntidad('rol_usuario');

                $sql = "SELECT rol.id as id, rol.name as name
                    FROM rol_usuario INNER JOIN rol ON rol_usuario.fkidrol = rol.id
                    INNER JOIN usuario ON rol_usuario.fkidUsuario = usuario.id
                    WHERE Email = ?";
                $parametros = [$ema];
                $listaRolesDelUsuario = $objControlRolUsuario->consultar($sql, $parametros);
                $_SESSION['listaRolesDelUsuario']=$listaRolesDelUsuario;
                var_dump($listaRolesDelUsuario);
				//echo '<div class="alert alert-danger">DATOS CORRECTOS</div>';
                header('Location: vista/vistaHome.php'); 	
            }else{
                echo '<script>alert("Datos erroneos, reintente por favor");</script>';
            }
			//header('Location: vistaUsuarios.php');
			break;
		
		default:
			# code...
			break;            
	}
?>

<style>
/*author:starttemplate*/
/*reference site : starttemplate.com*/
body {
  background-image:url('https://echezgroup.com/wp-content/uploads/2023/08/COO-Echez-Group-y-experto-en-Proteccion-de-Marca.jpg');
  background-position:center;
  background-size:cover;
  
  -webkit-font-smoothing: antialiased;
  font: normal 14px Roboto,arial,sans-serif;
  font-family: 'Dancing Script', cursive!important;
}

.container {
    padding: 110px;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #ffffff!important;
    opacity: 1; /* Firefox */
    font-size:18px!important;
}
.form-login {
    background-color: rgba(0,0,0,0.55);
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    color:white;
    box-shadow:0 1px 0 #cfcfcf;
}
.form-control{
    background:transparent!important;
    color:white!important;
    font-size: 18px!important;
}
h1{
    color:white!important;
}
h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}

.form-control {
    border-radius: 10px;
}
.text-white{
    color: white!important;
}
.wrapper {
    text-align: center;
}
.footer p{
    font-size: 18px;
}
</style>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords"
            content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
        <meta name="author" content="leamug">
        <title>Echez Group</title>
        <link rel="shortcut icon" href="./vista/img/logo-DBD-01.png"/>
        <link href="css/style.css" rel="stylesheet" id="style">
        <!-- Bootstrap core Library -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
        <!-- Font Awesome-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-4 text-center">
                <h1 class='text-white'>Echez Group</h1>
                <div class="form-login"></br>
                    <h4>Secure Login</h4>
                    </br>
                    <form action="login.php" method="post">
                        <input type="text" id="userName" name="txtEmail" required="required" value="<?php echo $ema ?>" class="form-control input-sm chat-input" placeholder="username"/>
                        </br></br>
                        <input type="password" id="userPassword" name="txtContrasena" required="required" value="<?php echo $con ?>" class="form-control input-sm chat-input" placeholder="password"/>
                        </br></br>
                       <!--<div class="wrapper">
                                <span class="group-btn">
                                    <a href="#" name='bt' value="Login" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></a>
                                </span>
                        </div>-->
                        <div class="form-group">
                            <button type="submit" name='bt' class="btn btn-primary btn-md login-btn" value="Login">Login<i class="fa fa-sign-in"></i></button>
                        </div>
                        <div class="modal-footer">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        </br></br></br>
        <!--footer-->
        <div class="footer text-white text-center">
            <p>© 2023 Don't Count the Days, Make the Days Count.</p>
        </div>
        <!--//footer-->
    </div>
    </body>
</html>
