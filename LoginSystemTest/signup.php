<?php
	include_once 'header.php';
?>
<section class="main-container">
	<div class="main-wrapper">
		<h2>Signup</h2>
		<form class="signup-form" action="includes/signup.inc.php" method="post">
			<input type="text" name="first" placeholder="First name">
			<input type="text" name="last" placeholder="Last name">
			<input type="text" name="phone" placeholder="Phone Number">
			<input type="text" name="email" placeholder="Email Address">
			<input type="text" name="password" placeholder="Password">
			<input type="text" name="street" placeholder="Street Address">
			<input type="text" name="city" placeholder="City">
			<input type="text" name="state" placeholder="State(Ex. MN)">
			<input type="text" name="zip" placeholder="Zip Code">
			<input type="text" name="cc" placeholder="Credit Card Number">
			<button type="submit" name="submit">Sign up</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php';
?>