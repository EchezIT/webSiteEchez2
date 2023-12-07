<?php
ob_start();
?>
<?php 
	include '../controlador/configBd.php';
	include '../controlador/ControlConexion.php';
	include '../controlador/ControlAlquilado.php';
	include '../modelo/Alquilado.php';
	include '../controlador/ControlEntidad.php';
	include '../controlador/ControlConexionPdo.php';
	include '../modelo/Entidad.php';

  session_start();
  if($_SESSION['email']==null)header('Location: ../login.php');

  $permisoParaEntrar=false;
	$listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
	//var_dump($listaRolesDelUsuario);
	for($i=0;$i<count($listaRolesDelUsuario);$i++){
		if($listaRolesDelUsuario[$i]->__get('name')=="Admin" || $listaRolesDelUsuario[$i]->__get('name')=="Admin-Global")

		$permisoParaEntrar=true;
	}
	if(!$permisoParaEntrar)header('Location: vistaHome.php');
?>
<?php
	
	$boton = "";
	$Id = "";
	$User_Name = "";
	$Serial = "";
	$PC_Name = "";
	$Installation_Date = "";
	$Plate_PC = "";
	$Specifications = "";
	$Ram = "";
	$Desktop_Laptop = "";
	$Domain = "";
	$Status_PC = "";
	$dateUpdate_Date = "";
	$bandera = 0;
	//$arregloRolesConsulta = [];
	//$listbox1 = array();
	$objControlAlquilado = new ControlAlquilado(null);
	$arregloAlquilado = $objControlAlquilado->listar();

	/*$objControlRol = new ControlRol(null);
	$arregloRoles = $objControlRol->listar();*/
	//var_dump($arregloRoles);
	if (isset($_POST['bt'])) $boton = $_POST['bt'];//toma del arreglo post el value del bt	
	if (isset($_POST['txtId'])) $Id = $_POST['txtId'];
	if (isset($_POST['txtUser_Name'])) $User_Name = $_POST['txtUser_Name'];
	if (isset($_POST['txtSerial'])) $Serial = $_POST['txtSerial'];
	if (isset($_POST['txtPC_Name'])) $PC_Name = $_POST['txtPC_Name'];
	if (isset($_POST['txtInstallation_Date'])) $Installation_Date = $_POST['txtInstallation_Date'];
	if (isset($_POST['txtPlate_PC'])) $Plate_PC = $_POST['txtPlate_PC'];
	if (isset($_POST['txtSpecifications'])) $Specifications = $_POST['txtSpecifications'];
	if (isset($_POST['txtRam'])) $Ram = $_POST['txtRam'];
	if (isset($_POST['txtDesktop_Laptop'])) $Desktop_Laptop = $_POST['txtDesktop_Laptop'];
	if (isset($_POST['txtDomain'])) $Domain = $_POST['txtDomain'];
	if (isset($_POST['txtStatus_PC'])) $Status_PC = $_POST['txtStatus_PC'];
	if (isset($_POST['txtdateUpdate_Date'])) $dateUpdate_Date = $_POST['txtdateUpdate_Date'];
	//if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
	//var_dump($listbox1);
	switch ($boton) {
		case 'Guardar':
			//session_start();
            //$_SESSION['msj'] = "se registró el usuario de forma correcta";
			$objAlquilado = new Alquilado($Id, $User_Name, $Serial, $PC_Name, $Installation_Date, $Plate_PC, $Specifications,
	        $Ram, $Desktop_Laptop, $Domain, $Status_PC, $dateUpdate_Date);
			$objControlAlquilado = new ControlAlquilado($objAlquilado);
			$objControlAlquilado->guardar();
			/*if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$id = $cadenas[0];
					$objRolUsuario = new RolUsuario($ema, $id);
					$objControlRolUsuario = new ControlRolUsuario($objRolUsuario);
					$objControlRolUsuario->guardar();
				}
			} */
			$bandera = 1;
			header('Location: vistaAlquilado.php');			
			break;
		case 'Consultar':
			$objAlquilado = new Alquilado(0,"", $Serial, "","",0,"","","","","","");
			$objControlAlquilado = new ControlAlquilado($objAlquilado);
			$objAlquilado = $objControlAlquilado->consultar();
			//$con = $objUsuario->getContrasena();
			$User_Name = $objAlquilado->getUser_Name();
			$PC_Name = $objAlquilado->getPC_Name();
			$Installation_Date = $objAlquilado->getInstallation_Date();
			$Plate_PC = $objAlquilado->getPlate_PC();
			$Specifications = $objAlquilado->getSpecifications();
			$Ram = $objAlquilado->getRam();
			$Desktop_Laptop = $objAlquilado->getDesktop_Laptop();
			$Domain = $objAlquilado->getDomain();
			$Status_PC = $objAlquilado->getStatus_PC();
			$dateUpdate_Date = $objAlquilado->getdateUpdate_Date();

			//Llenar el listbox1 con la lista de roles del ususario específico.
			//$objControlRolUsuario = new ControlRolUsuario(null);
			//$arregloRolesConsulta = $objControlRolUsuario->listarRolesDelUsuario($ema);
			//Asignarle los datos de arregloRolesConsulta al listbox1.

			//var_dump($arregloRolesConsulta);*/
			break;
		case 'Modificar': 
			//El modificar deberia hacerse con el llamado a un proceso almacenado que tengan control de transaciones.
			//paso 1. Modificar en la tabla usuario.
			/*$objUsuario = new Usuario($ema, $con);
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->modificar();
			//paso2. Borrar los registros asociados a la tabla intermedia.
			$objControlRolUsuario = new ControlRolUsuario(null);
			$arregloRolesConsulta = $objControlRolUsuario->borrarRolesDelUsuario($ema);
			//paso3. Guardar de nuevo en la tabla intermedia.
			if ($listbox1 != ""){
				for($i = 0; $i < count($listbox1); $i++){
					$cadenas = explode(";", $listbox1[$i]);
					$id = $cadenas[0];
					$objRolUsuario = new RolUsuario($ema, $id);
					$objControlRolUsuario = new ControlRolUsuario($objRolUsuario);
					$objControlRolUsuario->guardar();
				}
			}
			header('Location: vistaUsuarios.php');*/
			break;
		case 'Borrar':
			/*$objUsuario = new Usuario($ema, "");
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->borrar();
			header('Location: vistaUsuarios.php');*/
			break;
		case 'Limpiar':
			$Id = "";
			$User_Name = "";
			$Serial = "";
			$PC_Name = "";
			$Installation_Date = "";
			$Plate_PC = "";
			$Specifications = "";
			$Ram = "";
			$Desktop_Laptop = "";
			$Domain = "";
			$Status_PC = "";
			$dateUpdate_Date = "";		
			header('Location: vistaAlquilado.php');
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
<title>PCs Alquilados</title>
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
						<h2 class="table-title-name">PCs <b>Alquilados</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>PC Alquilado</span></a>
						
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
						<!--<th>Id</th>-->
						<th>Usuario</th>
						<th>Serial</th>
						<th>Nombre PC</th>
						<th>Fecha de instalación</th>
						<th>Plate PC</th>
						<th>Especificaciones</th>
						<th>Ram</th>
						<th>Desktop/Laptop</th>
						<th>Dominio</th>
						<th>Estado PC</th>
						<th>Fecha actualizada</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloAlquilado); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<!--<td><?php echo $arregloAlquilado[$i]->getId();?></td>-->
							<td><?php echo $arregloAlquilado[$i]->getUser_Name();?></td>
							<td><?php echo $arregloAlquilado[$i]->getSerial();?></td>
							<td><?php echo $arregloAlquilado[$i]->getPC_Name();?></td>
							<td><?php echo $arregloAlquilado[$i]->getInstallation_Date();?></td>
							<td><?php echo $arregloAlquilado[$i]->getPlate_PC();?></td>
							<td><?php echo $arregloAlquilado[$i]->getSpecifications();?></td>
							<td><?php echo $arregloAlquilado[$i]->getRam();?></td>
							<td><?php echo $arregloAlquilado[$i]->getDesktop_Laptop();?></td>
							<td><?php echo $arregloAlquilado[$i]->getDomain();?></td>
							<td><?php echo $arregloAlquilado[$i]->getStatus_PC();?></td>
							<td><?php echo $arregloAlquilado[$i]->getdateUpdate_Date();?></td>
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
			<form action="vistaAlquilado.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">PC Alquilado</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos del PC</a>
							</li>
							<!--<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por usuario</a>
							</li>-->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>
							<div class="row">
							    <div class="form-group col-md-6">
								<label>Nombre usuario</label>
									<input type="User_Name" id="txtUser_Name" name="txtUser_Name" class="form-control" 
									value="<?php echo $User_Name ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Serial</label>
									<input type="text" id="txtSerial" name="txtSerial" class="form-control" 
									value="<?php echo $Serial ?>" style="border-radius: 10px">
								</div>							
							</div>	
							<div class="row">	
								<div class="form-group col-md-6">
								<label>Nombre PC</label>
									<input type="PC_Name" id="txtPC_Name" name="txtPC_Name" class="form-control" 
									value="<?php echo $PC_Name ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Fecha de instalación</label>
									<input type="date" id="txtInstallation_Date" name="txtInstallation_Date" class="form-control" 
									value="<?php echo $Installation_Date ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label>Plate PC</label>
									<input type="txt" id="txtPlate_PC" name="txtPlate_PC" class="form-control" 
									value="<?php echo $Plate_PC ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Especificaciones</label>
									<input type="text" id="txtSpecifications" name="txtSpecifications" class="form-control" 
									value="<?php echo $Specifications ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label>Ram</label>
									<input type="Ram" id="txtRam" name="txtRam" class="form-control" 
									value="<?php echo $Ram ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Desktop/Laptop</label>
									<!--<input type="text" id="txtDesktop_Laptop" name="txtDesktop_Laptop" class="form-control" 
									value="<?php echo $Desktop_Laptop ?>" style="border-radius: 10px">-->
									<select id="txtDesktop_Laptop" name="txtDesktop_Laptop" class="form-control" 
									value="<?php echo $Desktop_Laptop ?>" style="border-radius: 10px" >
										<option selected>Desktop</option>
										<option selected>Laptop</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label>Dominio</label>
									<input type="Domain" id="txtDomain" name="txtDomain" class="form-control" 
									value="<?php echo $Domain ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Status PC</label>
									<input type="text" id="txtStatus_PC" name="txtStatus_PC" class="form-control" 
									value="<?php echo $Status_PC ?>" style="border-radius: 10px">
								</div>
							</div>
								<div class="form-group">
									<label>Date update</label>
									<input type="date" id="txtdateUpdate_Date" name="txtdateUpdate_Date" class="form-control" 
									value="<?php echo $dateUpdate_Date ?>" style="border-radius: 10px">
								</div>
			
								<div class="form-group">
									<input type="submit" id="btnGuardar" name="bt" class="btn btn-primary" value="Guardar">
									<input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
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
									<option value="<?php echo $arregloRoles[$i]->getId().";". $arregloRoles[$i]->getNombre(); ?>">
										<?php echo $arregloRoles[$i]->getId().";". $arregloRoles[$i]->getNombre(); ?>
									</option>
									<?php } ?>
								</select>
								<br>
								<label for="listbox1">Roles específicos del usuario</label>
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
							</div>
						</div>
						</div>				
									
				</div>			
			</form>
		</div>
	</div>
</div>

</body>
</html>