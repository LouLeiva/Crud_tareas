<?php 
//Variables de conexion a DB
$hostDB = 'localhost';
$db = 'crud_tareas';
$usuario = 'root';
$pass = '';

//Variables para almacenar datos
$idTareas = isset($_REQUEST['idTareas']) ? $_REQUEST['idTareas'] : null;
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$descripcion = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : null;
$fechaRegistro = isset($_REQUEST['fechaRegistro']) ? $_REQUEST['fechaRegistro'] : null;

//Conexion a la base
$hostPDO = "mysql:host=$hostDB;dbname=$db;";
$miPDO = new PDO($hostPDO, $usuario, $pass);

//Comprobamos si recibimos los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//Preparamos el Update o modificar
	$miUpdate = $miPDO->prepare('UPDATE tareas SET titulo = :titulo, descripcion = :descripcion, fechaRegistro = :fechaRegistro WHERE idTareas = :idTareas;');

	//Ejecutamos el update
	$miUpdate->execute(
		[
			'idTareas' => $idTareas,
			'titulo' => $titulo,
			'descripcion' => $descripcion,
			'fechaRegistro' => $fechaRegistro
		]
	);
	//Redireccionamos a la pagina de registros
	header('Location: index.php');
}
else
{
	$miConsulta = $miPDO->prepare('SELECT * FROM tareas WHERE idTareas = :idTareas');

	//Ejecuta la consulta
	$miConsulta->execute(
		[
			'idTareas' => $idTareas
		]
	);
}

//Se obtiene y se almacena un resultado
$tareas = $miConsulta->fetch();

?>

<!DOCTYPE html>
<html>
<head>
	<title>::ACTUALIZAR REGISTRO</title>
	<link rel="stylesheet" type="text/css" href="..//crud-tareas/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="..//crud-tareas/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<br>
		<h1>Actualizacion de Tareas</h1>
		<br>
		<br>
		<a href="index.php" class="btn btn-primary" role="button" >REGRESAR A LISTADO <span class="glyphicon glyphicon-home"></span></a>
		<br>
		<br>
	<!--Creando formulario-->
		<form class="form-horizontal" role="form" method="post" autocomplete="off">
			<div class="form-group">
				<label for="titulo" class="col-lg-2 control-label">Titulo de Tarea</label>
				<div class="col-lg-10">
				<input id="titulo" class="form-control" type="text" name="titulo" value="<?= $tareas['titulo'] ?>">
				</div>
			</div>		

			<div class="form-group">
				<label for="descripcion" class="col-lg-2 control-label">Descripción de Tarea</label>
				<div class="col-lg-10">
				<input id="descripcion" class="form-control" type="text" name="descripcion" value="<?= $tareas['descripcion'] ?>">
				</div>
			</div>

			<div class="form-group">
				<center>
					<input type="submit" class="btn btn-primary" align="center" value="ACTUALIZAR REGISTRO">
				</center>
			</div>
		</form>
	</div>


</body>
</html>