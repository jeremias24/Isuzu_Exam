<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php

//including the database connection file

include_once("classes/Crud.php");

$crud = new Crud();

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table

$result = $crud->delete($id, 'products');

if ($result) {
	//redirecting to the display page (index.php in our case)
	header("Location:index.php");
}

//redirecting to the display page (view.php in our case)
header("Location:view.php");
?>

