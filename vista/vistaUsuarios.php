<?php
ob_start();
?>
<?php 
	include '../controlador/configBd.php';
	include '../controlador/ControlConexion.php';
	include '../controlador/ControlUsuario.php';
	include '../controlador/ControlRol.php';
	include '../controlador/ControlRolUsuario.php';
	include '../modelo/Usuario.php';
	include '../modelo/Rol.php';
	include '../modelo/RolUsuario.php';
	include '../controlador/ControlEntidad.php';
	include '../controlador/ControlConexionPdo.php';
	include '../modelo/Entidad.php';

  session_start();
  if($_SESSION['email']==null)header('Location: ../login.php');

  $permisoParaEntrar=false;
	$listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
	//var_dump($listaRolesDelUsuario);
	for($i=0;$i<count($listaRolesDelUsuario);$i++){
		if($listaRolesDelUsuario[$i]->__get('name')=="Admin-Global")
		$permisoParaEntrar=true;
	}
	if(!$permisoParaEntrar)header('Location: vistaHome.php');
?>
<?php
	
	$boton = "";
	$Id = 0;
	$Name = "";
	$Email = "";
	$Password = "";
	$bandera = 0;
	$arregloRolesConsulta = [];
	$listbox1 = array();
	$objControlUsuario = new ControlUsuario(null);
	$arregloUsuarios = $objControlUsuario->listar();

	$objControlRol = new ControlRol(null);
	$arregloRoles = $objControlRol->listar();
	//var_dump($arregloRoles);
	if (isset($_POST['bt'])) $boton = $_POST['bt'];//toma del arreglo post el value del bt
	if (isset($_POST['txtId'])) $Id = $_POST['txtId'];	
	if (isset($_POST['txtName'])) $Name = $_POST['txtName'];
	if (isset($_POST['txtEmail'])) $Email = $_POST['txtEmail'];
	if (isset($_POST['txtPassword'])) $Password = $_POST['txtPassword'];
	if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
	//var_dump($listbox1);
	switch ($boton) {
		case 'Guardar':
			//session_start();
            //$_SESSION['msj'] = "se registró el usuario de forma correcta";
			$objUsuario = new Usuario(0,$Name,$Email, $Password);
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->guardar();
			if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$IdRol = $cadenas[0];
					$objRolUsuario = new RolUsuario($Id, $IdRol);
					$objControlRolUsuario = new ControlRolUsuario($objRolUsuario);
					$objControlRolUsuario->guardar();
				}
			} 
			$bandera = 1;
			header('Location: vistaUsuarios.php');			
			break;
		case 'Consultar':
			$objUsuario = new Usuario(0,"",$Email,"");
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objUsuario = $objControlUsuario->consultar();
			$Id = $objUsuario->getId();
			$Name = $objUsuario->getName();
			$Password = $objUsuario->getPassword();
			//Llenar el listbox1 con la lista de roles del ususario específico.
			$objControlRolUsuario = new ControlRolUsuario(null);
			$arregloRolesConsulta = $objControlRolUsuario->listarRolesDelUsuario($Id);
			//Asignarle los datos de arregloRolesConsulta al listbox1.

			//var_dump($arregloRolesConsulta);
			break;
		case 'Modificar': 
			//El modificar deberia hacerse con el llamado a un proceso almacenado que tengan control de transaciones.
			//paso 1. Modificar en la tabla usuario.
			$objUsuario = new Usuario(0,$Name,$Email,$Password);
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->modificar();
			//paso2. Borrar los registros asociados a la tabla intermedia.
			$objControlRolUsuario = new ControlRolUsuario(null);
			$arregloRolesConsulta = $objControlRolUsuario->borrarRolesDelUsuario($Id);
			//paso3. Guardar de nuevo en la tabla intermedia.
			if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$IdRol = $cadenas[0];
					$objRolUsuario = new RolUsuario($Id, $IdRol);
					$objControlRolUsuario = new ControlRolUsuario($objRolUsuario);
					$objControlRolUsuario->guardar();
				}
			}
			header('Location: vistaUsuarios.php');
			break;
		case 'Borrar':
			$objUsuario = new Usuario(0,"",$Email,"");
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->borrar();
			header('Location: vistaUsuarios.php');
			break;
			case 'Limpiar':
				$Id = 0;
				$Name = "";
				$Email = "";
				$Password = "";		
				header('Location: vistaUsuarios.php');
				break;
		
		default:
			# code...
			break;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Usuarios</title>
<link rel="shortcut icon" href="../vista/img/logo-DBD-01.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../vista/css/misCss1.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="../vista/js/misFunciones2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
	<!--<script>alert('Usuario registrado');</script>-->
	<?php
	if($boton == 'Guardar'){
		?>
		<script>
			alert('Usuario registrado');
		</script>
	<?php
	}
	?>
<!--<div class="container-xl">-->
	<!--Se agrega una barra de navegación para acceder a los CRUDs, y agregar la funcionalidad "buscar"-->	
	<div class="navBar">
			<?php require('./navbar.php')?>
	</div>
	<div class="table-responsive">
		
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2 class="table-title-name">Gestión <b>Usuarios</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-gestion" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión Usuarios</span></a>
						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Contraseña</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloUsuarios); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td><?php echo $arregloUsuarios[$i]->getName();?></td>
							<td><?php echo $arregloUsuarios[$i]->getEmail();?></td>
							<td><?php echo $arregloUsuarios[$i]->getPassword();?></td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
<!--</div>-->
<!-- crud Modal HTML -->
<div id="crudModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaUsuarios.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos de usuario</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por usuario</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>
								<div class="form-group">
								<label>Id</label>
									<input type="text" id="txtId" name="txtId" class="form-control" value="<?php echo $Id ?>" disabled>
								</div>
								<div class="form-group">
								<label>Email</label>
									<input type="email" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $Email ?>">
								</div>
								<div class="form-group">
								<label>Nombre</label>
									<input type="text" id="txtName" name="txtName" class="form-control" value="<?php echo $Name ?>">
								</div>
								<div class="form-group">
									<label>Contraseña</label>
									<input type="text" id="txtPassword" name="txtPassword" class="form-control" value="<?php echo $Password ?>">
								</div>
								<div class="form-group">
									<input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
									<input type="submit" id="btnConsultar" name="bt" class="btn btn-primary" value="Consultar">
									<input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
									<input type="submit" id="btnBorrar" name="bt" class="btn btn-danger" value="Borrar">
									<input type="submit" id="btnLimpiar" name="bt" class="btn btn-warning" value="Limpiar">
								</div>
							</div>
							
							
							<div id="menu1" class="container tab-pane fade"><br>
							<div class="container">
								<div class="form-group">
									<label for="combobox1">Todos los roles</label>
								<select class="form-control" id="combobox1" name="combobox1">
									<?php for($i=0; $i<count($arregloRoles); $i++){ ?>
									<option value="<?php echo $arregloRoles[$i]->getId().";". $arregloRoles[$i]->getName(); ?>">
										<?php echo $arregloRoles[$i]->getId().";". $arregloRoles[$i]->getName(); ?>
									</option>
									<?php } ?>
								</select>
								<br>
								<label for="listbox1">Roles específicos del usuario</label>
								<select multiple class="form-control" id="listbox1" name="listbox1[]">
									<?php for($i=0; $i<count($arregloRolesConsulta); $i++){ ?>
									<option value="<?php echo $arregloRolesConsulta[$i]->getId().";". $arregloRolesConsulta[$i]->getName(); ?>">
										<?php echo $arregloRolesConsulta[$i]->getId().";". $arregloRolesConsulta[$i]->getName(); ?>
									</option>
									<?php } ?>
								</select>
								</div>
									<div class="form-group">
										<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1', 'listbox1')">Agregar Item</button>
										<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1')">Remover Item</button>
									</div>
								</div>
							</div>
						</div>
						</div>				
									
				</div>
				<!--<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">					
				</div>-->
			</form>
		</div>
	</div>
</div>

</body>
</html>