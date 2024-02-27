<?php

$login_page = true;

// TODO: Redirect to a requested URL instead of base path or login.
if (isset($_POST['email_address']) and isset($_POST['password'])) {
	$email_address = $_POST['email_address'];
	$password = $_POST['password'];
	$result = UserSession::authenticate($email_address, $password);
	$login_page = false;
}
if (!$login_page) {
	if ($result) {
		$should_redirect = Session::get('_redirect');
		$redirect_to = get_config('base_path');
		if (isset($should_redirect)) {
			$redirect_to = $should_redirect;
			Session::set('_redirect', false);
		}
?>
		<script>
			window.location.href = "<?= $redirect_to ?>"
		</script>

	<?php
	} else {
	?>
		<script>
			window.location.href = "/login.php?error=1"
		</script>
	<?php
	}
} else {
	?>

	<main class="form-signin text-center w-100 m-auto py-5 mt-5">
		<form method="POST" action="login.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
				<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
				<circle cx="12" cy="13" r="4" />
			</svg>

			<input type="hidden" name="fingerprint" id="fingerprint" value="">

			<h1 class="h3 mb-3 fw-normal py-3">Sign in</h1>

			<?
			if (isset($_GET['error'])) {
			?>
				<div class="alert alert-danger" role="alert">
					Invalid Credentials
				</div>
			<?
			}
			?>

			<div class="form-floating">
				<input name="email_address" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
				<label for="floatingInput">Email address or Username</label>
			</div>
			<div class="form-floating">
				<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>

			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
			<br><br>
			<p class="text-muted">Not registered? <a class="text-decoration-none" href="/signup.php">Sign up</a></p>
		</form>
	</main>

<?php
}
