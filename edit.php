<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("classes/Crud.php");
$crud = new Crud();

include_once("layouts/header.php");



if (isset($_POST['update'])) {
	$id = $_POST['id'];

	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];

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
	} else {
		//updating the table




		//$result = mysqli_query($mysqli, "UPDATE products SET name='$name', qty='$qty', price='$price' WHERE id=$id");

		//$result = $crud->execute("UPDATE users SET name='$name',age='$age',email='$email' WHERE id=$id");

		$result =  $crud->execute("UPDATE products SET name='$name', qty='$qty', price='$price' WHERE id=$id");

		//redirectig to the display page. In our case, it is view.php
		header("Location: view.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
//$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");

//$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");

$result = $crud->getData("SELECT * FROM products WHERE id=$id");

foreach ($result as $res) {
	$name = $res['name'];
	$qty = $res['qty'];
	$price = $res['price'];
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
				Update Product
			</div>


			<form name="form1" method="post" action="edit.php">

				<div class="card-body">

					<div class="form-group">
						<label>Product Name</label>
						<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter Product Name" required>
					</div>

					<div class="form-group">
						<label>Quantity </label>
						<input type="number" name="qty" value="<?php echo $qty; ?>" class="form-control" placeholder="Enter Product Quantity" required>
					</div>
					<div class="form-group">
						<label> Price </label>
						<input type="number" name="price" value="<?php echo $price; ?>" class="form-control" placeholder="Enter Product Price" required>
					</div>
				</div>
				<div class="card-footer">
					<input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
					<input type="submit" name="update" value="Update" class="btn btn-success">
				</div>
			</form>

		</div>
	</div>
</div>