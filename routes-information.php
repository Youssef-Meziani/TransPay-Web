<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TransPay - Bus routes</title>
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


    <!-- Header -->
    <header class="coming-soon-logo-1">
        <div class="logo"><a href="./"><img src="images/logo.svg" id="logo" alt="TransPay logo"></a></div>
    </header>
    <!-- /Header -->

    <div class="route-stops-area pt-100 pb-50">
        <div class="container">
            <div class="row">
                <h4 class="pt-20 pb-20 text-center">Bus Routes & Stops</h4>
                <div class="col-11 col-sm-10 col-md-8 col-lg-6 m-auto">
                <div class="accordion">
                    <?php 
                    require_once("DataBase/db.php");
                    $trajets=$con->query("CALL `infoTrajets`();")->fetchAll(PDO::FETCH_ASSOC);
                    for ($i = 1; $i <= count($trajets); $i++) { ?>
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="panel-<?= $i; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panel-collapse-<?= $i; ?>" aria-expanded="false" aria-controls="panel-collapse-<?= $i; ?>"><i class="las la-bus"></i>&nbsp;<?= $trajets[$i-1]["numLigne"]; ?></button>
                        </h2>
                        <div id="panel-collapse-<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="panel-<?= $i; ?>">
                            <div class="accordion-body d-flex flex-column align-items-center text-center">
                                <i class="las la-map-pin"></i>
                                <bdi><b><?=$trajets[$i-1]["nomArrDepart"]?></b></bdi>
                                <div class="vertical-line"></div>
                                <?php
                                $stmt=$con->prepare("CALL `arretsTrajets`(:numLigne);");
                                $stmt->execute(array(":numLigne"=>$trajets[$i-1]["numLigne"]));
                                $arrets=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                for ($j = 1; $j <= count($arrets); $j++) { ?>
                                    <bdi><?=$arrets[$j-1]["nom"]?></bdi>
                                    <div class="vertical-line"></div>
                                <?php } ?>
                                <bdi><b><?=$trajets[$i-1]["nomArrArrive"]?></b></bdi>
                                <i class="las la-map-pin flipped"></i>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- /JS -->

</body>

</html>