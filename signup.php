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
	<title>TransPay - Sign Up</title>
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
				<form method="post" class="needs-validation" action="open-account.php" novalidate>
					<div class="login-social-icon">
						<h2>Signup</h2>
					</div>

					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-envelope"></i></span>
						<input type="email" class="form-control" tabindex="1" placeholder="Email" pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" maxlength="40" spellcheck="false" name="email" required>
						<div class="invalid-feedback">Please provide a valid Email.</div>
					</div>

					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-lock"></i></span>
						<input type="password" class="form-control" tabindex="2" placeholder="Create Password" spellcheck="false" name="password" minlength="8" maxlength="40" required>
						<div class="invalid-feedback">The Password must be between 8 and 40 characters</div>
					</div>


					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-lock"></i></span>
						<input type="password" class="form-control" tabindex="3" placeholder="Confirm Password" spellcheck="false" id="c_password" minlength="8" maxlength="40" required>
						<div class="invalid-feedback">Passwords do not match</div>
					</div>

					<div class="input-group">
						<div class="form-check d-block">
							<input type="checkbox" id="agree" required>
							<label class="form-check-label form-check-box" for="agree">I agree to the <a href="terms-&-conditions.php">Terms & Conditions</a></label>
							<div class="invalid-feedback">Please agree to the Terms and Conditions.</div>
						</div>
					</div>

					<div class="row justify-content-center mb-md-3">
						<div class="col-sm-6 mb-md-3 mb-sm-0 text-center">
							<button type="submit" class="btn theme-btn-1">Sign Up</button>
						</div>
					</div>

					<div class="login-footer">Already have an account? <a href="login.php">Login</a></div>
				</form>
			</div>
			<!-- /Container -->
		</div>
	</div>
	<!-- /Login -->


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
	<script src="js/verify-email.js"></script>

	<script>
		$('form').submit(function(event) {
			event.preventDefault(); // Prevent the default form submission

			if (this.checkValidity() === false) {
				return;
			}

			const c_pass = $('#c_password');
			var password = $('[name=password]').val();
			if (password != c_pass.val()) {
				c_pass.addClass('is-invalid');
				Swal.fire({
					title: 'Incorrect Password Confirmation!',
					text: 'The password confirmation does not match. Please make sure you enter the same password in both fields.',
					icon: 'info',
					showCloseButton: true,
					allowOutsideClick: false
				});
				return;
			} else {
				c_pass.removeClass('is-invalid');
			}

			// Create a Promise object to wrap the AJAX request
			var account_exist = new Promise(function(resolve, reject) {
				$.ajax({
					type: 'POST',
					url: 'assets/check_acc_existance.php',
					data: {
						email: $('[name=email]').val()
					},
					success: function(response) {
						if (response != '') {
							Swal.fire({
								title: 'Account Already Exist!',
								text: 'It seems that this account already created. Would you like to log in?',
								icon: 'info',
								showCancelButton: true,
								reverseButtons: true,
								showCloseButton: true,
								confirmButtonText: 'Log In',
								allowOutsideClick: false
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = "login.php";
								}
							});
							reject();
						} else {
							resolve();
						}
					}
				});
			});

			account_exist.then(verify_email);
		});
	</script>

	<!-- /JS -->

</body>

</html>