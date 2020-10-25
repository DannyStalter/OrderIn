<?php
include_once 'header.php';
?>

	<section class="signup-form">

	<div class="flexbox-container">


	<div class="flex-menus">

		<form action="includes/login-inc.php" method="post">
			<h2>Welcome back to Order In.</h2> <br />
			<label for="menuItem">Email:</label><br>
			<input type="text" name="email" placeholder="Enter your email."><br><br>
			<label for="itemPrice">Password:</label><br>
			<input type="password" name="pwd" placeholder="Enter your password."><br><br>
			<p>Don't have an account? <a href="signup.php">Sign up here.</a></p>
			<button type="submit" class="btn btn-primary login-button" name="submit">Log In</button>
			<div class="error-text">
			<?php
			if (isset($_GET["error"])) {
				if ($_GET["error"] == "emptyinput"){
					echo "<p>Please enter in all fields.</p>";
				}
				else if ($_GET["error"] == "invalidlogin") {
					echo "<p>Login information incorrect. Please try again.</p>";
				}
			}
			?>
			</div>
		</form>
	</div>

</div>

	</section>
