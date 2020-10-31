<?php  
//Variables de conexion a DB
$hostDB = 'localhost';
$db = 'crud_tareas';
$usuario = 'root';
$pass = '';

$hostPDO = "mysql:host=$hostDB;dbname=$db;";
$miPDO = new PDO($hostPDO, $usuario, $pass);
//Preparando Consulta
$miConsulta = $miPDO->prepare('SELECT * FROM tareas');
//Ejecutando Consulta
$miConsulta->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<title>::REGISTROS::</title>
	<link rel="stylesheet" type="text/css" href="..//crud-tareas/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="..//crud-tareas/css/bootstrap.min.css">

</head>
<body>
	<div class="container">
	<br>
	<h1>Bienvenida Karla Leiva</h1>
	<br>
	<a href="nuevo-registro.php" class="btn btn-primary btn-lg" role="button" >Nuevo Registro <span class="glyphicon glyphicon-pencil"></span></a>
	<br>
	<br>
	<div class="table-responsive">
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Titulo de Tarea</th>
			<th>Descripción de Tarea</th>
			<th>Fecha de Registro</th>
			<td></td>
			<td></td>
		</tr>
		</thead>
		<?php foreach ($miConsulta as $clave => $valor): ?>
		<tbody>
		<tr>
			<td><?=$valor['titulo'] ?></td>
			<td><?=$valor['descripcion'] ?></td>
			<td><?=$valor['fechaRegistro'] ?></td>
			<td><a class="btn btn-success" href="modificar.php?idTareas=<?= $valor['idTareas']?>">Modificar<span class="glyphicon glyphicon-repeat"></span></td>
			<td><a class="btn btn-danger" href="borrar.php?idTareas=<?= $valor['idTareas']?>">Borrar <span class="glyphicon glyphicon-trash"></span></td>
		</tr>
		</tbody>
		<?php endforeach ?>
	</table>
	</div>
	</div>
</body>
</html>