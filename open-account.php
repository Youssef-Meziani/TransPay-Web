<?php
if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    header("Location:signup.php");
}
$email=$_POST["email"];
$password=$_POST["password"];
if (empty($email) || empty($password)) {
    header("Location:signup.php");
}
$password=md5($password);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TransPay - Open Account</title>
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
    <!-- Open Account -->
    <div class="open-account-area">
            <div class="open-account-form">
                <form class="needs-validation" novalidate>
                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="prenom">First name <span class="text-danger">*</span></label>
                                <input spellcheck="false" required type="text" class="form-control" placeholder="Enter your first name" id="prenom" maxlength="20" pattern="[a-zA-Z ]{3,20}">
                                <div class="invalid-feedback">Please provide your First Name using letters only.</div>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="nom">Last name <span class="text-danger">*</span></label>
                                <input spellcheck="false" required type="text" class="form-control" placeholder="Enter your last name" id="nom" maxlength="20" pattern="[a-zA-Z ]{3,20}">
                                <div class="invalid-feedback">Please provide your Last Name using letters only.</div>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="date_naiss">Date of birth <span class="text-danger">*</span></label>
                                <input spellcheck="false" required type="text" class="form-control" placeholder="dd/mm/yyyy" id="date_naiss" maxlength="10" pattern="\d{1,2}/\d{1,2}/\d{4}">
                                <div class="invalid-feedback">Please provide your Birth Date in the format day/month/year.</div>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="sexe">Gender</label>
                                <select id="sexe">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="tel">Mobile number</label>
                                <input spellcheck="false" type="tel" class="form-control" placeholder="0600-000000" id="tel" maxlength="13" pattern="(\+212|0(6|7|5))\d{8}">
                                <div class="invalid-feedback">Invalid mobile number.</div>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" value="Oujda" disabled>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="form-group">
                            <label for="adresse">Address <span class="text-danger">*</span></label>
                            <input spellcheck="false" required type="text" class="form-control" placeholder="Enter your street address" id="adresse" minlength="6" maxlength="60">
                            <div class="invalid-feedback">Please provide a valid Address.</div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-12">
                            <div class="banner-form-btn">
                                <button type="submit" class="default-btn">
                                Create Account
                                </button>
                            </div>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->
                </form>
            </div>
        </div>
        <!-- /Container -->
    </div>
    <!-- /Open Account -->

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

    <script src="js/form_validation.js"></script>
    <script src="js/sweet_alert.js"></script>
    <script src="js/date_validator.js"></script>

    <script>
        const email = "<?=$email?>";
        const password = "<?=$password?>";
        
        $('form').submit(function(event) {
            if (this.checkValidity() === false) {
                return;
            }
            event.preventDefault();

            var date_naiss = $('#date_naiss').val();
            if (!isValidDate(date_naiss)) {
                $('#date_naiss').addClass('is-invalid');
                return;
            }else{
                $('#date_naiss').removeClass('is-invalid');
            }

            var nom = $('#nom').val();
            var prenom = $('#prenom').val();
            var sexe = $('#sexe').val();
            var tel = $('#tel').val();
            var adresse = $('#adresse').val();

            var ajaxPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: 'POST',
                    url: 'assets/create_account.php',
                    data: {
                        nom: nom,
                        prenom: prenom,
                        date_naiss: date_naiss,
                        sexe: sexe,
                        tel: tel,
                        adresse: adresse,
                        email: email,
                        password: password
                    },
                    success: function(result) {
                        if (result==='') {
                            resolve();
                        }else {
                            Swal.fire({
                                title: 'Invalid Data!',
                                text: 'Please do not inspect the page and change the page source code, because you could get banned.',
                                icon: 'error',
                                showCloseButton: true,
                                allowOutsideClick: false
                            });
                            reject();
                        }
                    }
                });
            });

			ajaxPromise.then(function() {
                $.ajax({
                    type: 'POST',
                    url: 'assets/login.php',
                    data: {
                        email: email,
                        password: password,
                        remember: "false"
                    },
                    success: function(response) {
                        if (response !== '') {
                            Swal.fire({
                                title: 'Success',
                                text: 'Your account has been created successfully.',
                                icon: 'success',
                                showCloseButton: true,
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.dismiss || result.isConfirmed) {
                                    window.location.href = "./";
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Unexpected error!',
                                text: 'It seems that something went wrong while creating your account.',
                                icon: 'error',
                                showCloseButton: true,
                                allowOutsideClick: false
                            });
                        }
                    }
                });
			})
        });
    </script>

    <!-- /JS -->

</body>

</html>