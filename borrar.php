<?php 
//Variables de conexion a DB
$hostDB = 'localhost';
$db = 'crud_tareas';
$usuario = 'root';
$pass = '';

$hostPDO = "mysql:host=$hostDB;dbname=$db;";
$miPDO = new PDO($hostPDO, $usuario, $pass);

//Obtiene el codigo de la tarea a borrar
$idTareas = isset($_REQUEST['idTareas']) ? $_REQUEST['idTareas'] : null;

//Prepara el Delete
$miDelete = $miPDO->prepare('DELETE FROM tareas WHERE idTareas = :idTareas');

$miDelete->execute([

	idTareas => $idTareas
]);

header('Location: index.php');
?>