<?php
session_start();
if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
	header("location:account.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TransPay - Login</title>
    <!-- /Required meta tags -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.svg" id="favicon" type="image/x-icon">
    <!-- /Favicon -->

    <!-- Theme color for navbars -->
    <meta name="theme-color" content="#307ed6">
    <meta name="msapplication-navbutton-color" content="#307ed6">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- All CSS -->

    <!-- Vendor Css -->
    <link rel="stylesheet" href="css/vendors.css">
    <!-- /Vendor Css -->

    <!-- Plugin Css -->
    <link rel="stylesheet" href="css/plugins.css">
    <!-- Plugin Css -->

    <!-- Icons Css -->
    <link rel="stylesheet" href="css/icons.css">
    <!-- /Icons Css -->

    <!-- Style Css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- /Style Css -->

    <!-- /All CSS -->

</head>

<body>

<!-- Login -->
	<div class="login-page d-flex align-items-center vh-100">
		<div class="overlay"></div>
		<div class="login-form">
			<!-- Container -->
			<div class="container">
				<form method="post" class="needs-validation" novalidate>
					<div class="login-social-icon">
						<h2>Login</h2>
					</div>
					
					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-envelope"></i></span>
						<input type="email" class="form-control" id="inputEmail" name="email" tabindex="1" placeholder="Email" pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" spellcheck="false" required>
						<div class="invalid-feedback">Please provide a valid Email address.</div>
					</div>
					
					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-lock"></i></span>
						<input type="password" class="form-control" id="inputPassword" name="password" tabindex="2" placeholder="Password" spellcheck="false" maxlength="40" required>
						<div class="invalid-feedback">The Password must be between 8 and 40 characters</div>
					</div>

					<div class="row justify-content-center mb-md-3 pt-md-3 pt-16">
						<div class="col-sm-6 mb-md-3 mb-sm-0">
							<button type="submit" class="btn theme-btn-1">Log In</button>
						</div>
						
						<div class="col-sm-6 text-sm-end">
							<a class="" href="recover.html">Forgot Password?</a>
						</div>
					</div>

					<div class="login-footer">Don't have an account? <a href="signup.php">Signup</a>
					</div>
				</form>
			</div>
			<!-- Container -->
		</div>
	</div>
	<!-- /login -->

    <!-- JS -->

    <!-- Vendor Js -->
    <script src="js/vendors.js"></script>
    <!-- /Vendor js -->

    <!-- Plugins Js -->
    <script src="js/plugins.js"></script>
    <!-- /Plugins Js -->

    <!-- Main JS -->
    <script src="js/main.js"></script>
    <!-- /Main JS -->

    <!-- Form Validation -->
    <script src="js/form_validation.js"></script>
    <!-- /Form Validation -->

	<script src="js/sweet_alert.js"></script>

	<script>
		$('form').submit(function(event) {
			if (this.checkValidity() === false) {
				return;
			}
			event.preventDefault();

			var email = $('#inputEmail').val();
			var password = $('#inputPassword').val();

			$.ajax({
			type: 'POST',
			url: 'assets/login.php',
			data: { email: email, password: password },
			success: function(response) {
				if (response !== '') {
					window.location.href="./";
				} else {
					Swal.fire({
						title: 'Account Not Found!',
						text: 'It seems that there is no account associated with your information. Would you like to create a new one?',
						icon: 'error',
						showCancelButton: true,
						reverseButtons: true,
						showCloseButton: true,
						confirmButtonText: 'SignUp',
						allowOutsideClick: false
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href="signup.php";
						}
					});
				}
			}
			});
		});
	</script>

    <!-- /JS -->

</body>

</html>