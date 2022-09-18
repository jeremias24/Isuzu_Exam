<?php session_start(); ?>

<?php
include("connection.php");
include("layouts/header.php");



if (isset($_POST['submit'])) {
	$user = mysqli_real_escape_string($mysqli, $_POST['username']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if ($user == "" || $pass == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
			or die("Could not execute the select query.");

		$row = mysqli_fetch_assoc($result);

		if (is_array($row) && !empty($row)) {
			$validuser = $row['username'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {
			echo "Invalid username or password.";
			echo "<br/>";
			echo "<a href='login.php'>Go back</a>";
		}

		if (isset($_SESSION['valid'])) {
			header('Location: index.php');
		}
	}
} else {
?>
	<div class="card-container">

		<div class="col-lg-12">
			<a href="index.php">Home</a> <br /><br />
		</div>

		<div class="col-lg-6">
			<form name="form1" method="post" action="">
				<div class="card">

					<div class="card-header">
						Login
					</div>

					<div class="card-body">

						<div class="form-group">
							<label>Username </label>
							<input type="text" name="username" class="form-control" placeholder="Enter Username" required>
						</div>
						<div class="form-group">
							<label>Password </label>
							<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
						</div>

					</div>
					<div class="card-footer">
						<input type="submit" name="submit" value="Submit" class="btn btn-success" />
					</div>
				</div>
			</form>
		</div>

	</div>
<?php
}
?>

<?php include("layouts/footer.php"); ?>