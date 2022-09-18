<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
//fetching data in descending order (lastest entry first)

include_once("classes/Crud.php");
include_once("layouts/header.php");


$crud = new Crud();

//fetching data in descending order (lastest entry first)
$query = "SELECT * FROM products WHERE login_id=" . $_SESSION['id'] . " ORDER BY id DESC";
$result = $crud->getData($query);

?>



<div class="container-fluid">


	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="add.php">Add New Product</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Account
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
				</li>

			</ul>

		</div>
	</nav>

	<!--a href="index.php">Home</a> | <a href="add.php">Add New Data</a> | <a href="logout.php">Logout</a-->
	<br /><br />

	<div class="card">
		<div class="card-header">
			Products Master List
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table width='100%' class="table table-bordered" id="sample-table">
					<thead>
						<tr>
							<td>Name</td>
							<td>Quantity</td>
							<td>Price (peso)</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>

						<?php
						foreach ($result as $key => $res) {
							echo "<tr>";
							echo "<td>" . $res['name'] . "</td>";
							echo "<td>" . $res['qty'] . "</td>";
							echo "<td>" . $res['price'] . "</td>";
							echo "<td><a href=\"edit.php?id=$res[id]\" class='btn btn-primary'>Edit</a>  <a href=\"delete.php?id=$res[id]\" class='btn btn-danger' onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
						}
						?>

					</tbody>
					<tfoot>
						<tr>
							<td>Name</td>
							<td>Quantity</td>
							<td>Price (peso)</td>
							<td>Action</td>
						</tr>
					</tfoot>

				</table>
			</div>
		</div>

	</div>

</div>

<?php include_once("layouts/footer.php"); ?>

<script>
	$(document).ready(function() {
		$('#sample-table').DataTable();
	});
</script>