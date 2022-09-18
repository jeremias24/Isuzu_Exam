<?php session_start();
include("layouts/header.php");
?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file

include_once("classes/Crud.php");
$crud = new Crud();

if (isset($_POST['Submit'])) {
	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$loginId = $_SESSION['id'];

	// checking empty fields
	if (empty($name) || empty($qty) || empty($price)) {

		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if (empty($qty)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}

		if (empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty) 

		$result = $crud->execute("INSERT INTO products(name, qty, price, login_id) VALUES('$name','$qty','$price', '$loginId')");


		//display success message
		echo "<div class='alert alert-success'><font color='green'>Product added successfully. </div>";


		echo "<div class='alert alert-info'> <a href='view.php'>View Result</a> </div>";
	}
}
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
					<a class="nav-link" href="view.php">View Products</a>
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

	<br />

	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Add Products
			</div>


			<form action="add.php" method="post" name="form1">

				<div class="card-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
					</div>

					<div class="form-group">
						<label>Quantity</label>
						<input type="number" name="qty" class="form-control" placeholder="Enter Product Quantity" required>
					</div>

					<div class="form-group">
						<label>Price</label>
						<input type="number" name="price" class="form-control" placeholder="Enter Product Price" required>
					</div>
				</div>

				<div class="card-footer">
					<input type="submit" name="Submit" value="Save" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>


<?php
include("layouts/footer.php");
?>