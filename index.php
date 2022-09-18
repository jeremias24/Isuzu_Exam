<?php session_start();
include("connection.php");
include("layouts/header.php"); ?>
<html>

<head>
	<title>Homepage</title>
</head>


<div class="container-fluid">

	<div class="card">
		<div class="card-body bg-light">

			<div id="header">
				Welcome to Page!
			</div>

			<?php
			if (isset($_SESSION['valid'])) {

				$result = mysqli_query($mysqli, "SELECT * FROM login");
			?>
				Welcome <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br />
				<br />

				<h2>What do you want to do?</h2>
				<a href='view.php'>View and Add Products</a>
				<br /><br />
			<?php
			} else {
				echo "You must be logged in to view this page.<br/><br/>";
				echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
			}
			?>
		</div>

	</div>
</div>


<?php include("layouts/footer.php"); ?>