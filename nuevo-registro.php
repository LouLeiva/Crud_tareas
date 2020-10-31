<?php 
		//Validamos si recibimos datos del metodo POST del formulario
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			//Recogemos las variables
			$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
			$descripcion = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : null;
			$fechaRegistro = isset($_REQUEST['fechaRegistro']) ? $_REQUEST['fechaRegistro'] : null;

			//Volvemos a conectar a la base
			$db = 'crud_tareas';
			$usuario = 'root';
			$pass = '';

			$hostPDO = "mysql:host=$hostDB;dbname=$db;";
			$miPDO = new PDO($hostPDO, $usuario, $pass);
			//Preparando Insert
			$miInsert = $miPDO->prepare('INSERT INTO tareas (titulo, descripcion, fechaRegistro) VALUES (:titulo, :descripcion, :fechaRegistro)');
			//Ejecutando Insert
			$miInsert->execute(
				array(
						'titulo' => $titulo,
						'descripcion' => $descripcion,
						'fechaRegistro' => $fechaRegistro	
					)
			);

			//Una vez realizado el insert - Redireccionamos la pagina a la consulta de registros
			header('Location: index.php');
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>::NUEVO REGISTRO</title>
	<link rel="stylesheet" type="text/css" href="..//crud-tareas/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="..//crud-tareas/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<br>
	<h1>Registro de Nueva Tarea</h1>
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
			<input id="titulo" class="form-control" type="text" name="titulo">
			</div>
		</div>		

		<div class="form-group">
			<label for="descripcion" class="col-lg-2 control-label">Descripción de Tarea</label>
			<div class="col-lg-10">
			<input id="descripcion" class="form-control" type="text" name="descripcion">
			</div>
		</div>

		<div class="form-group">
			<center>
				<input type="submit" class="btn btn-success" align="center" value="GUARDAR REGISTRO">
				<input type="reset" class="btn btn-info" align="center" value="LIMPIAR FORMULARIO">
			</center>
		</div>
	</form>
</div>


</body>
</html>