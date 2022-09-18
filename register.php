<?php
include("connection.php");
include("layouts/header.php");

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$pass = $_POST['password'];

	if ($user == "" || $pass == "" || $name == "" || $email == "") {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {
		mysqli_query($mysqli, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
			or die("Could not execute the insert query.");

		echo "Registration successfully";
		echo "<br/>";
		echo "<a href='login.php'>Login</a>";
	}
} else {
?>
	<div class="container-fluid">
		<div class="col-lg-12">
			<a href="index.php">Home</a> <br /><br />
		</div>

		<div class="col-lg-6">
			<form name="form1" method="post" action="">
				<div class="card">

					<div class="card-header">
						User Registration
					</div>
					<div class="card-body">

						<div class="form-group">
							<label>Full Name </label>
							<input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
						</div>
						<div class="form-group">
							<label> Email </label>
							<input type="email" name="email" class="form-control" placeholder="Enter Email" required>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" placeholder="Enter Username" required>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
						</div>

					</div>

					<div class="card-footer">
						<input type="submit" name="submit" value="Submit" class="btn btn-success">
					</div>

				</div>

			</form>
		</div>
	</div>

<?php
}
?>