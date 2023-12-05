<!--<?php
ob_start();
?>-->
<?php 
	include '../controlador/configBd.php';
	include '../controlador/ControlConexion.php';
	include '../controlador/ControlRol.php';
	include '../modelo/Rol.php';
	//include '../controlador/ControlEntidad.php';
	//include '../controlador/ControlConexionPdo.php';
	//include '../modelo/Entidad.php';

  //session_start();
  /*if($_SESSION['Name']==null)header('Location: ../login2.php');

  $permisoParaEntrar=false;
	$listaRolesDelRol = $_SESSION['listaRolesDelRol'];
	var_dump($listaRolesDelRol);
	for($i=0;$i<count($listaRolesDelRol);$i++){
		if($listaRolesDelRol[$i]->__get('nombre')=="admin")$permisoParaEntrar=true;
	}
	if(!$permisoParaEntrar)header('Location: vistaHome.php');*/
?>
<?php
	
	$boton = "";
	$Id = "";
	$Name = "";
	$Description = "";
	$bandera = 0;
	$arregloRolesConsulta = [];
	$listbox1 = array();
	$objControlRol = new ControlRol(null);
	$arregloRoles = $objControlRol->listar();

	/*$objControlRol = new ControlRol(null);
	$arregloRoles = $objControlRol->listar();*/
	//var_dump($arregloRoles);
	if (isset($_POST['bt'])) $boton = $_POST['bt'];//toma del arreglo post el value del bt	
	if (isset($_POST['txtName'])) $Name = $_POST['txtName'];
	if (isset($_POST['txtDescription'])) $Description = $_POST['txtDescription'];
	//if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
	//var_dump($listbox1);
	switch ($boton) {
		case 'Guardar':
			//session_start();
            //$_SESSION['msj'] = "se registró el Rol de forma correcta";
			$objRol = new Rol(0,$Name, $Description);
			$objControlRol = new ControlRol($objRol);
			$objControlRol->guardar();
			/*if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$id = $cadenas[0];
					$objRolRol = new RolRol($ema, $id);
					$objControlRolRol = new ControlRolRol($objRolRol);
					$objControlRolRol->guardar();
				}
			} 
			$bandera = 1;*/
			header('Location: vistaRol.php');			
			break;
		case 'Consultar':
			$objRol = new Rol(0,$Name, "");
			$objControlRol = new ControlRol($objRol);
			$objRol = $objControlRol->consultar();
			$Description = $objRol->getDescription();
			//Llenar el listbox1 con la lista de roles del ususario específico.
			//$objControlRolRol = new ControlRolRol(null);
			//$arregloRolesConsulta = $objControlRolRol->listarRolesDelRol($);
			//Asignarle los datos de arregloRolesConsulta al listbox1.

			//var_dump($arregloRolesConsulta);
			break;
		case 'Modificar': 
			//El modificar deberia hacerse con el llamado a un proceso almacenado que tengan control de transaciones.
			//paso 1. Modificar en la tabla Rol.
			$objRol = new Rol(0,$Name, $Description);
			$objControlRol = new ControlRol($objRol);
			$objControlRol->modificar();
			//paso2. Borrar los registros asociados a la tabla intermedia.
			//$objControlRolRol = new ControlRolRol(null);
			//$arregloRolesConsulta = $objControlRolRol->borrarRolesDelRol($ema);
			//paso3. Guardar de nuevo en la tabla intermedia.
			/*if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$id = $cadenas[0];
					$objRolRol = new RolRol($ema, $id);
					$objControlRolRol = new ControlRolRol($objRolRol);
					$objControlRolRol->guardar();
				}
			}*/
			header('Location: vistaRol.php');
			break;
		case 'Borrar':
			$objRol = new Rol(0,$Name, "");
			$objControlRol = new ControlRol($objRol);
			$objControlRol->borrar();
			header('Location: vistaRol.php');
			break;
		case 'Limpiar':
			$Name = "";
			$Description = "";		
			header('Location: vistaRol.php');
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
<title>Roles</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../vista/css/misCss.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="../vista/js/misFunciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
	<!--<script>alert('Rol registrado');</script>-->
	<!--<?php
	if($boton == 'Guardar'){
		?>
		<script>
			alert('Rol registrado');
		</script>
	<?php
	}
	?>-->
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
						<h2 class="miEstilo">Gestión <b>Roles</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión Roles</span></a>
						
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
						<th>Descripción</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloRoles); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td><?php echo $arregloRoles[$i]->getName();?></td>
							<td><?php echo $arregloRoles[$i]->getDescription();?></td>
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
			<form action="vistaRol.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Rol</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos del Rol</a>
							</li>
							<!--<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por Rol</a>
							</li>-->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>
							<div class="form-group">
								<label>Nombre</label>
									<input type="Name" id="txtName" name="txtName" class="form-control" value="<?php echo $Name ?>">
								</div>
								<div class="form-group">
									<label>Descripción</label>
									<input type="text" id="txtDescription" name="txtDescription" class="form-control" value="<?php echo $Description ?>">
								</div>
								<div class="form-group">
									<input type="submit" id="btnGuardar" name="bt" class="btn btn-primary" value="Guardar">
									<input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
									<input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
									<input type="submit" id="btnBorrar" name="bt" class="btn btn-danger" value="Borrar">
									<input type="submit" id="btnLimpiar" name="bt" class="btn btn-warning" value="Limpiar">
								</div>
							</div>
							
							
							<!--<div id="menu1" class="container tab-pane fade"><br>
							<div class="container">
								<div class="form-group">
									<label for="combobox1">Todos los roles</label>
								<select class="form-control" id="combobox1" name="combobox1">
									<?php for($i=0; $i<count($arregloRoles); $i++){ ?>
									<option value="<?php echo $arregloRoles[$i]->getId().";". $arregloRoles[$i]->getNombre(); ?>">
										<?php echo $arregloRoles[$i]->getId().";". $arregloRoles[$i]->getNombre(); ?>
									</option>
									<?php } ?>
								</select>
								<br>
								<label for="listbox1">Roles específicos del Rol</label>
								<select multiple class="form-control" id="listbox1" name="listbox1[]">
									<?php for($i=0; $i<count($arregloRolesConsulta); $i++){ ?>
									<option value="<?php echo $arregloRolesConsulta[$i]->getId().";". $arregloRolesConsulta[$i]->getNombre(); ?>">
										<?php echo $arregloRolesConsulta[$i]->getId().";". $arregloRolesConsulta[$i]->getNombre(); ?>
									</option>
									<?php } ?>
								</select>
								</div>
									<div class="form-group">
										<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1', 'listbox1')">Agregar Item</button>
										<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1')">Remover Item</button>
									</div>
								</div>
							</div>-->
						</div>
						</div>				
									
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>