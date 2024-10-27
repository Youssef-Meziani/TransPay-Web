<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Explore a wide range of transportation subscription options offered by TransPay in Morocco. Choose from various plans and enjoy the ease of managing your subscriptions in one place, making your daily commute simpler than ever.">
    <title>TransPay - Subscriptions</title>
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

    <!-- Breadcrumb -->
    <div class="banner-section position-relative">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col  -->
                <div class="col-md-6">
                    <div class="banner-content banner-padding">
                        <h3 class="title">SUBSCRIPTIONS</h3>
                        <p>Unlock a world of convenience with our flexible subscription plans</p>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-md-6 mt-7 mt-md-0">
                    <div class="banner-content scene banner-img">
                        <div data-depth="0.2">
                            <img src="images/bg/8.svg" alt="subscriptions" />
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Breadcrumb -->

    <!-- Pricing-->
    <div class="pricing-area pt-100">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row pricing-content-wrap mt-30 text-center">
                <h4 class="pt-20 pb-20">Choose The Perfect Subscription For Your Needs</h4>
                <?php
                require_once("DataBase/db.php");
                $subscriptions=$con->query("select * from frfait_info_tbl")->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < count($subscriptions); $i++) { ?>
                    <div class="col-11 col-sm-10 col-md-6 col-lg-4">
                        <div class="pricing-item pricing-item-2 radio-subscription" onclick="selectRadioButton(<?=$i+1?>)">
                            <?php
                            $not_monthly=$subscriptions[$i]["prix"]< 10;
                            if ($not_monthly) { ?>
                                <div class="pricing-tooltip">
                                    <span class="pricing__tooltip">Popular</span>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="pricing-title">
                                <h3 class="pricing-title"><?=$subscriptions[$i]["nom"]?></h3>
                                <h3 class="pricing-price ">
                                <?php
                                if($not_monthly){
                                    echo $subscriptions[$i]["prix"];
                                ?>
                                    <small>DH/r</small></h3>
                                    <p><small>Pay as you go</small></p>
                                <?php }else{
                                    echo $subscriptions[$i]["prix"]-10;
                                    ?>
                                    <small>DH/m</small></h3>
                                    <p><small><?=$subscriptions[$i]["prix"]?> <small>DH/m</small> after renewal</small></p>
                                <?php } ?>
                            </div>
                            <ul class="pricing-list">
                                <?php
                                $description=explode(" #@# ", $subscriptions[$i]["description"]);
                                for ($j = 0; $j < count($description); $j++) { ?>
                                    <li><?=$description[$j]?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Pricing -->
    
    <!-- /Route -->
    <div id="routes" class="route-area pt-50 d-none">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row mt-30 text-center">
                <h4 class="pt-20 pb-20">Choose The Desired Bus Routes</h4>
                <!-- col -->
                <div class="routes-container">
                    <?php
                    $routes=$con->query("select numLigne from trjt_info_tbl order by NumLigne asc")->fetchAll(PDO::FETCH_ASSOC);
                    for ($i = 0; $i < count($routes); $i++) { ?>
                        <h4 class="route-number"><?=$routes[$i]["numLigne"]?></h4>
                    <?php
                    }
                    ?>
                </div>
                <!-- /col -->
                <p class="pt-20 pb-20 ">Need more information about each route?<br>Click <strong><a target="_blank" href="routes-information.php" class="text-primary">here</a></strong>.</p>
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Route -->

    <!-- /balance -->
    <div class="balance-area pt-50 d-none">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row mt-30 text-center">
                <h4 class="pt-20 pb-20">Pass Balance</h4>
                <!-- col -->
                <div class="col-md-6 m-auto">
                    <div class="input-group">
                        <input type="number" id="amount" placeholder="150" class="form-control text-center" min="50" max="500" step="10" maxlength="3" value="50">
                        <div class="input-group-append">
                            <span class="input-group-text">DH</span>
                        </div>
                    </div>
                </div>

                <!-- /col -->
                <p class="pt-20 pb-20">The funds will be credited to your pass subscription, and with each validation, a deduction of 3.5DH will be made from your pass balance.</p>
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /balance -->
    

    <!-- /Payment -->
    <div class="payment-area pt-50 pb-50 d-none">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row mt-30 text-center">
                <h4 class="pt-20 pb-20">Pay Your Way</h4>
                <!-- col -->
                <div class="col-10 col-md-8 col-lg-6 m-auto">
                    <div class="paypal"></div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Payment -->

    <div id="floatingDiv">
        <span id="text">Total Price:</span>
        <span id="total"><b id="Price"></b> <span>DH</span></span>
    </div>

    
    <!-- Cta -->
    <?php require_once("assets/contact-card.html");?>
    <!-- /Cta -->

    <!-- Footer -->
    <?php require_once("assets/footer.php");?>
    <!-- /Footer -->

    <!-- Go top -->
    <?php require_once("assets/gotop.html");?>
    <!-- /Go top -->

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

    <!-- Paypal -->
    <script src="js/paypal.js"></script>
    

    <!-- /Paypal -->
    
    <!-- Sweet alert -->
    <script src="js/sweet_alert.js"></script>
    <!-- /Sweet alert -->

    <script>
        const route_section=$('.route-area');
        const balance_section=$('.balance-area');
        const list_subscriptions = $('.radio-subscription');
        const payment_area=$('.payment-area');
        const routeNumbers = $('.route-number');
        const floatingDiv = $('#floatingDiv');
        const amount=$("#amount");
        var totalPrice = 0;
        var selectedRadioButton = null;
        var selectedRoutes = [];

        function selectRadioButton(subscriptionIndex) {
            const subscription = list_subscriptions[subscriptionIndex - 1];

            if (subscription === selectedRadioButton) {
                // The clicked radio button is already selected, so unselect it
                subscription.classList.remove('selected');
                selectedRadioButton = null;
                hideBalanceArea();
                hideRouteArea();
                hidePaymentArea();
            } else {
                // Remove 'selected' class from previously selected radio button
                if (selectedRadioButton) {
                    selectedRadioButton.classList.remove('selected');
                }
                
                // Add 'selected' class to the clicked radio button
                subscription.classList.add('selected');
                selectedRadioButton = subscription;
                if (subscription.querySelector(".pricing-tooltip")) {
                    hideRouteArea();
                    showBalanceArea();
                }else{
                    hideBalanceArea();
                    showRouteArea();
                }
            }
            
            // Perform any additional actions based on the selected radio button
            switch (subscriptionIndex) {
                case 1:
                    // Code for option 1
                    break;
                case 2:
                    // Code for option 2
                    break;
                case 3:
                    // Code for option 3
                    break;
                    default:
                        break;
                    }
        }
        
        // Add click event listeners to each route number
        Array.from(routeNumbers).forEach((numberElement) => {
            numberElement.addEventListener('click', () => {
                if (!numberElement.classList.contains('selected')) {
                    // Add the route number to the selected array
                    selectedRoutes.push(numberElement.innerText);
                    numberElement.classList.add('selected');
                } else {
                    // Remove the route number from the selected array
                    selectedRoutes = selectedRoutes.filter(
                        (route) => route !== numberElement.innerText
                    );
                    numberElement.classList.remove('selected');
                }

                if (selectedRoutes.length!=0) {
                    showPaymentArea();
                } else {
                    hidePaymentArea();
                }
                updateTotalPrice();
            });
        });

        amount.on("change", function () {
            totalPrice=$(this).val();
            updateTotalPrice();
        });


        function updateTotalPrice() {
            $('#Price').text(totalPrice);
        }

        function hidePaymentArea(){
            payment_area.addClass('d-none');
            hideFloatingDiv();
        }

        function showPaymentArea(){
            payment_area.removeClass('d-none');
            showFloatingDiv();
        }

        function hideFloatingDiv(){
            floatingDiv.css('transform', 'translateX(-50%) translateY(150%)');
        }

        function showFloatingDiv(){
            updateTotalPrice();
            floatingDiv.css('transform', 'translateX(-50%) translateY(0)');
        }

        function showRouteArea(){
            route_section.removeClass('d-none');
            routeNumbers.removeClass('selected');
            selectedRoutes=[];
        }

        function hideRouteArea(){
            route_section.addClass('d-none');
            routeNumbers.removeClass('selected');
            selectedRoutes=[];
        }

        function showBalanceArea(){
            totalPrice=50;
            amount.val(totalPrice);
            showPaymentArea();
            balance_section.removeClass('d-none');
        }
        
        function hideBalanceArea(){
            balance_section.addClass('d-none');
            hidePaymentArea();
        }
    </script>

    <!-- /JS -->

</body>

</html>