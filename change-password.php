<?php
if (!isset($_POST["email"]) && empty($_POST["email"])) {
	header("Location:recover.html");
}
$email=$_POST["email"];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TransPay - Change Password</title>
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
				<form class="needs-validation" novalidate>
					<div class="login-social-icon">
						<h2>Change Password</h2>
					</div>
					
					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-lock"></i></span>
						<input type="password" class="form-control" tabindex="2" placeholder="New Password" spellcheck="false" name="password" minlength="8" maxlength="40" required>
						<div class="invalid-feedback">The Password must be between 8 and 40 characters.</div>
					</div>
				

					<div class="input-group">
						<span class="login-form-icon"><i class="uil uil-lock"></i></span>
						<input type="password" class="form-control" tabindex="3" placeholder="Confirm Password" spellcheck="false" id="c_password" minlength="8" maxlength="40" required>
						<div class="invalid-feedback">Passwords do not match.</div>
					</div>

					<div class="row justify-content-center mb-md-3">
						<div class="col-sm-6 mb-md-3 mb-sm-0 text-center">
							<button type="submit" class="btn theme-btn-1">Save</button>
						</div>
					</div>
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

	<script>
		const email = "<?=$_POST["email"]?>";
		$('form').submit(function(event) {
			event.preventDefault(); // Prevent the default form submission

			if (this.checkValidity() === false) {
				return;
			}

			const c_pass=$('#c_password');
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
			}

			c_pass.removeClass('is-invalid');


			// Create a Promise object to wrap the AJAX request
			var ajaxPromise = new Promise(function(resolve, reject) {
				$.ajax({
					type: 'POST',
					url: 'assets/update_password.php',
					data: { email: email, password: password },
					success: function(response) {
						if (response == "done") {
							Swal.fire({
								title: 'Success!',
								text: 'Your password has been updated successfully.',
								icon: 'success',
								allowOutsideClick: false
							}).then((result) => {
								window.location.href = "login.php";
							});
							resolve();
						} else {
							Swal.fire({
								title: 'Error!',
								text: 'Something when wrong while updating your Password, try again later.',
								icon: 'error',
								allowOutsideClick: false
							});
							reject();
						}
					}
				});
			});
		});
	</script>

    <!-- /JS -->

</body>

</html>