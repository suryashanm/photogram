<?php

$signup = false;
if (isset($_POST['username']) and isset($_POST['password']) and !empty($_POST['password']) and isset($_POST['email_address']) and isset($_POST['phone'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email_address'];
	$phone = $_POST['phone'];
	$error = User::signup($username, $password, $email, $phone);
	$signup = true;
}
?>

<?php
if ($signup) {
	if (!$error) {
?>
		<main class="container">
			<div class="bg-light p-5 rounded mt-3">
				<h1>Signup Success!</h1>
				<p class="lead">Now you can login from <a href="<?= get_config('base_path') ?>login.php">here</a></p>
			</div>
		</main>
	<?php
	} else {
	?>
		<main class="container">
			<div class="bg-light p-5 rounded mt-3">
				<h1>Signup fail!</h1>
				<p class="lead">Somethig went wrong! <?= $error ?></a></p>
			</div>
		</main>
	<?php
	}
} else {
	?>
	<main class="form-signup text-center w-100 m-auto py-5">
		<form method="POST" action="signup.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
				<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
				<circle cx="12" cy="13" r="4" />
			</svg>
			<h1 class="h3 mb-3 fw-normal py-3">Sign up</h1>

			<div class="form-floating">
				<input name="username" type="text" class="form-control" id="floatingUserName" placeholder="username">
				<label for="floatingUserName">Username</label>
			</div>

			<div class="form-floating">
				<input name="phone" type="text" class="form-control" id="floatingPhoneNumber" placeholder="phone number">
				<label for="floatingPhoneNumber">Phone</label>
			</div>

			<div class="form-floating">
				<input name="email_address" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
				<label for="floatingInput">Email address</label>
			</div>

			<div class="form-floating">
				<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
			<br><br>
			<p class="text-muted">Already hava an account? <a class="text-decoration-none" href="../login.php">Log in</a></p>
		</form>
	</main>
<? } ?>