<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $current_page = basename($_SERVER['PHP_SELF']);
    $icon=" la-sign-in-alt";
    $link="login.php";
    $indication="Login";
    if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
        $icon=" la-user";
        $link="account.php";
        $indication="Account";
    }
?>

<div class="navbar-area">
        <div class="acavo-responsive-nav">
            <!-- Container -->
            <div class="container">
                <div class="acavo-responsive-menu d-flex">
                    <div class="logo">
                        <a href="./">
                            <img src="images/logo.svg" id="logo" alt="logo">
                        </a>
                    </div>
                    <div class="account">
                        <a href="<?=$link?>" class="btn theme-btn-1"><i class="las<?=$icon?> icon-size"></i></a>
                    </div>
                </div>
            </div>
            <!-- /Container -->
        </div>
        <div class="acavo-nav">
            <!-- Container -->
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="./">
                        <img src="images/logo.svg" id="logo" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a href="./" class="nav-link text-center <?= $current_page == 'index.php' ? 'active' : ''?>">Home</a>
                            </li>
    
                            <li class="nav-item">
                                <a href="about.php" class="nav-link text-center <?= $current_page == 'about.php' ? 'active' : ''?>">About Us</a>
                            </li>
    
                            <li class="nav-item">
                                <a href="subscriptions.php" class="nav-link text-center <?= $current_page == 'subscriptions.php' ? 'active' : ''?>"><strong>Subscriptions</strong></a>
                            </li>
    
                            <li class="nav-item">
                                <a href="coming-soon.html" class="nav-link text-center">Live Tracking</a>
                            </li>

                            <li class="nav-item">
                                <a href="faq.php" class="nav-link text-center <?= $current_page == 'faq.php' ? 'active' : ''?>">FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="others-option d-flex align-items-center">
                        <div class="option-item">
                            <a href="<?=$link?>" class="btn theme-btn-1 d-flex align-items-center"><?=$indication?>&nbsp;<i class="las<?=$icon?> icon-size"></i></a>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- /Container -->
        </div>
    </div>