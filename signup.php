<?php
include_once 'header.php';
?>

	<section class="signup-form">


		<div class="flexbox-container">

			<div class="flex-welcomeHeading">
				<div class="flexbox-item flexbox-welcome-1">
					<h1 class="welcome-1-heading">Sign up with Order In.</h1>
				</div>
			</div>

			<div class="flex-menus">
				<form action="includes/signup-inc.php" method="post">
					<label for="name">Enter your full name:</label><br>
					<input type="text" name="name" placeholder="Enter your full here."><br><br>
					<label for="email">Enter your email:</label><br>
					<input type="text" name="email" placeholder="Enter email here."><br><br>
					<label for="pwd">Select a password:</label><br>
					<input type="password" name="pwd" placeholder="Select a password here."><br><br>
					<label for="pwdconfirm">Re-enter your password:</label><br>
					<input type="password" name="pwdconfirm" placeholder="Re-enter here."><br><br>
					<button type="submit" class="btn btn-primary signup-button" name="submit">Sign Up</button>

					<div class="error-text">
					<?php
					if (isset($_GET["error"])) {
						if ($_GET["error"] == "emptyinput"){
							echo "<p>Please enter in all fields.</p>";
						}
						else if ($_GET["error"] == "invalidemail") {
							echo "<p>Please use a correct email format.</p>";
						}
						else if ($_GET["error"] == "inconsistentpasswords") {
							echo "<p>Passwords do not match.</p>";
						}
						else if ($_GET["error"] == "stmtfailed") {
							echo "<p>Something went wrong. Please try again.</p>";
						}
						else if ($_GET["error"] == "emailused") {
							echo "<p>Email is already in use. Please select a different email.</p>";
						}
						else if ($_GET["error"] == "none") {
							echo "<p style='color:black'>Thank you for signing up!</p>";
						}
					}
					?>
				</div>
				</form>
			</div>

		</div>


	</section>
