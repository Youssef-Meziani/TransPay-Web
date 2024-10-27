<?php
session_start();
if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    header("Location:login.php");
}

require_once("DataBase/db.php");
$stmt=$con->prepare("select * from clnt_info_tbl where idClt=:id");
$stmt->execute(array(":id"=>$_SESSION["user"]));
$data=$stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location:login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TransPay</title>
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

    <!-- PreLoader -->
    <?php require_once("assets/preloader.html");?>
    <!--Preloader-->
    
    <!-- Header -->
    <?php require_once("assets/header.php");?>
    <!-- /Header -->

    <!-- Account -->
    <div class="account-area bg-gray-200 pt-100">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="information-tab" data-bs-toggle="pill" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Information</button>
                    <button class="nav-link" id="subscription-tab" data-bs-toggle="pill" data-bs-target="#subscription" type="button" role="tab" aria-controls="subscription" aria-selected="false">Subscription</button>
                    <button class="nav-link" id="groupe-tab" data-bs-toggle="pill" data-bs-target="#groupe" type="button" role="tab" aria-controls="groupe" aria-selected="false">Groupe</button>
                    <button class="nav-link" id="assistance-tab" data-bs-toggle="pill" data-bs-target="#assistance" type="button" role="tab" aria-controls="assistance" aria-selected="false">Assistance</button>
                    <button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Password</button>
                    <button class="nav-link text-danger" id="logout-tab" type="button">Log out</button>
                </div>
                <div class="tab-content w-100" id="tabContent">
                    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                        <div class="open-account-area">
                            <div class="open-account-form">
                                <form class="needs-validation" id="info-form" novalidate>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="prenom">First name <span class="text-danger">*</span></label>
                                                <input spellcheck="false" required type="text" class="form-control toggle" placeholder="Enter your first name" id="prenom" maxlength="20" pattern="[a-zA-Z ]{3,20}" value="<?=$data["prenom"]?>" disabled>
                                                <div class="invalid-feedback">Please provide your First Name using letters only.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="nom">Last name <span class="text-danger">*</span></label>
                                                <input spellcheck="false" required type="text" class="form-control toggle" placeholder="Enter your last name" id="nom" maxlength="20" pattern="[a-zA-Z ]{3,20}" value="<?=$data["nom"]?>" disabled>
                                                <div class="invalid-feedback">Please provide your Last Name using letters only.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="date_naiss">Date of birth <span class="text-danger">*</span></label>
                                                <input spellcheck="false" required type="text" class="form-control toggle" placeholder="dd/mm/yyyy" id="date_naiss" maxlength="10" pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?=DateTime::createFromFormat('Y-m-d', $data["date_naissance"])->format('d/m/Y')?>" disabled>
                                                <div class="invalid-feedback">Please provide your Birth Date in the format day/month/year.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="sexe">Gender</label>
                                                <select id="sexe" disabled>
                                                    <option value="M" <?=(strtolower($data["sexe"])=="m")? "selected":""?>>Male</option>
                                                    <option value="F" <?=(strtolower($data["sexe"])=="f")? "selected":""?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="tel">Mobile number</label>
                                                <input spellcheck="false" type="tel" class="form-control toggle" placeholder="0600-000000" id="tel" maxlength="13" pattern="(\+212|0(6|7|5))\d{8}" value="<?=$data["telephone"]?>" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" value="Oujda" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="adresse">Address <span class="text-danger">*</span></label>
                                            <input spellcheck="false" required type="text" class="form-control toggle" placeholder="Enter your street address" id="adresse" minlength="6" maxlength="60" value="<?=$data["adresse"]?>" disabled>
                                            <div class="invalid-feedback">Please provide a valid Address.</div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="banner-form-btn col-12 col-lg-6 m-auto">
                                                <button type="button" class="default-btn" id="edit-btn"><i class="las la-edit"></i> Edit</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <div class="points-container">
                                                <h3>Points Balance</h3>
                                                <p>
                                                    <span class="points-value"><?=$data["point"]?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="subscription-tab">
                        <div class="open-account-area">
                            <div class="open-account-form">
                                <div class="col-10 m-auto text-center">
                                    <?php
                                    $has_subscription=($data["idAbo"]!=NULL)? true : false;
                                    if ($has_subscription) { 
                                        $stmt=$con->prepare("select * from abnmnt_info_tbl where idAbo=:id");
                                        $stmt->execute(array(":id"=>$data["idAbo"]));
                                        $abonement=$stmt->fetch(PDO::FETCH_ASSOC);
                                        if ($abonement) {
                                            ?>
                                        //abonnement
                                    <?php }
                                    } else { ?>
                                        <h5>You do not have a subscription yet.</h5>
                                        <br>
                                        <a href="subscriptions.php" class="btn theme-btn-1 m-auto">View Offers</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="groupe" role="tabpanel" aria-labelledby="groupe-tab">
                        <div class="open-account-area">
                            <div class="open-account-form">
                                <?php
                                $has_groupe=($data["idGroupe"]!=NULL)? true : false;
                                if ($has_groupe) { 
                                    $stmt=$con->prepare("select * from grp_info_tbl where idGroupe=:id");
                                    $stmt->execute(array(":id"=>$data["idGroupe"]));
                                    $groupe=$stmt->fetch(PDO::FETCH_ASSOC);
                                    if ($groupe) {
                                        ?>
                                        //groupe
                                    <?php }
                                } else { ?>
                                            <form class="col-lg-6 m-auto needs-validation" id="groupe-form" novalidate>
                                                <div class="form-group">
                                                    <label for="code">Groupe Code <span class="text-danger">*</span></label>
                                                    <input spellcheck="false" required type="number" class="form-control" placeholder="Enter groupe code" id="code" max="99999" pattern="[0-9]{5}">
                                                    <div class="invalid-feedback">The Groupe code should be 5 digits.</div>
                                                </div>
                                                <div class="banner-form-btn col-md-6 m-auto">
                                                    <button type="submit" class="default-btn">Join</button>
                                                </div>
                                                <hr>
                                                <div class="banner-form-btn col-md-6 m-auto">
                                                    <button type="button" class="default-btn" id="create-groupe">Create</button>
                                                </div>
                                            </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="assistance" role="tabpanel" aria-labelledby="assistance-tab">
                        <div class="open-account-area">
                            <div class="open-account-form">
                                <form class="col-lg-8 m-auto needs-validation" id="assistance-form" novalidate>
                                    <div class="form-group">
                                        <label for="subject">Subject <span class="text-danger">*</span></label>
                                        <input spellcheck="false" required type="text" class="form-control" placeholder="Assistance subject" id="subject" maxlength="30">
                                        <div class="invalid-feedback">The subject cannot be empty.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea spellcheck="false" required class="form-control" placeholder="Describe your problem" id="description" maxlength="400"></textarea>
                                        <div class="invalid-feedback">The description cannot be empty.</div>
                                    </div>
                                    <div class="banner-form-btn col-md-6 m-auto">
                                        <button type="submit" class="default-btn">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <div class="open-account-area">
                            <div class="open-account-form">
                                <form class="col-lg-8 m-auto needs-validation" id="password-form" novalidate>
                                    <div class="form-group">
                                        <label for="current_password">Current Password <span class="text-danger">*</span></label>
                                        <input spellcheck="false" required type="password" class="form-control" placeholder="Your current password" id="current_password" minlength="8" maxlength="40">
                                        <div class="invalid-feedback">Invalid current Password.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="n_password">New Password <span class="text-danger">*</span></label>
                                        <input spellcheck="false" required type="password" class="form-control" placeholder="Your new password" id="n_password" minlength="8" maxlength="40">
                                        <div class="invalid-feedback">The Password must be between 8 and 40 characters.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_password">Password Confirmation <span class="text-danger">*</span></label>
                                        <input spellcheck="false" required type="password" class="form-control" placeholder="Confirm your password" id="c_password" minlength="8" maxlength="40">
                                        <div class="invalid-feedback">Passwords do not match</div>
                                    </div>
                                    <div class="banner-form-btn col-md-6 m-auto">
                                        <button type="submit" class="default-btn">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Account -->

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
        $('#groupe-form').submit(function(event) {
            event.preventDefault();
        });

        $('#assistance-form').submit(function(event) {
            event.preventDefault();
        });

        $("#logout-tab").on("click", function() {
            $.ajax({
                url: 'assets/logout.php',
                success: function(response) {
                    window.location.href="./";
                }
            });
        })

        $("#create-groupe").on("click", function () {
            if ("<?=$has_subscription?>") {
                
            }else{
                Swal.fire({
                    title: 'Subscription required',
                    text: 'You have to buy a subscription before you can create a Groupe.',
                    icon: 'info',
                    showCancelButton: true,
                    reverseButtons: true,
                    showCloseButton: true,
                    confirmButtonText: 'View Offers',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href="subscriptions.php";
                    }
                })
            }
        });

        const fields = $(".toggle");
        const select = $(".nice-select");
        var editable = false;

        const infoForm = $('#info-form');
        const dateNaiss = $('#date_naiss');
        const nom = $('#nom');
        const prenom = $('#prenom');
        const sexe = $('#sexe');
        const tel = $('#tel');
        const adresse = $('#adresse');


        $("#edit-btn").on("click", function () {
            if (editable) {
                if (infoForm[0].checkValidity()) {
                    infoForm.submit();
                } else {
                    infoForm.addClass('was-validated');
                }
            } else {
                fields.removeAttr("disabled");
                select.removeClass("disabled");
                $(this).html('<i class="las la-save"></i> Save');
                editable = true;
            }
        });

        infoForm.submit(function (event) {
            event.preventDefault();

            // Perform additional custom validations if needed
            var date_naiss = dateNaiss.val();
            if (!isValidDate(date_naiss)) {
                dateNaiss.addClass('is-invalid');
                return;
            } else {
                dateNaiss.removeClass('is-invalid');
            }

            $.ajax({
                type: 'POST',
                url: 'assets/update_account.php',
                data: {
                    nom: nom.val(),
                    prenom: prenom.val(),
                    date_naiss: date_naiss,
                    sexe: sexe.val(),
                    tel: tel.val(),
                    adresse: adresse.val()
                },
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Done',
                            text: 'Your profile information has been updated successfully.',
                            icon: 'success',
                            showCloseButton: true,
                            allowOutsideClick: false
                        });
                        fields.prop("disabled", true);
                        select.addClass("disabled");
                        $(this).html('<i class="las la-edit"></i> Edit');
                        editable = false;
                    } else if (result === 'denied') {
                        window.location.href = "login.php";
                    } else {
                        Swal.fire({
                            title: 'Invalid Data!',
                            text: 'Please do not inspect the page and change the page source code, because you could get banned.',
                            icon: 'error',
                            showCloseButton: true,
                            allowOutsideClick: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while updating your profile information.',
                        icon: 'error',
                        showCloseButton: true,
                        allowOutsideClick: false
                    });
                }
            });
        });


        $("#password-form").submit(function(event){
            event.preventDefault();
            
			if (this.checkValidity() === false) {
				return;
			}

			const c_pass=$('#c_password');
			var current_password = $('#current_password').val();
			var password = $('#n_password').val();
			if (current_password.length===0 || password.length===0) {
				Swal.fire({
					title: 'Empty field!',
					text: 'Make sure you input all the required fields.',
					icon: 'info',
					showCloseButton: true,
					allowOutsideClick: false
				});
				return;
            }else if (password != c_pass.val()) {
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

            $.ajax({
                type: 'POST',
                url: 'assets/update_password.php',
                data: { current_password: current_password, password: password },
                success: function(response) {
                    if (response == "done") {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your password has been updated successfully.',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    } else if (response == "wrong") {
                        Swal.fire({
                            title: 'Wrong Password!',
                            text: 'Make sure to correctly type the current password.',
                            icon: 'info',
                            allowOutsideClick: false
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something when wrong while updating your Password, try again later.',
                            icon: 'error',
                            allowOutsideClick: false
                        });
                    }
                }, error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while updating your password.',
                        icon: 'error',
                        showCloseButton: true,
                        allowOutsideClick: false
                    });
                }
            });
        })
    </script>

    <!-- /JS -->

</body>

</php>