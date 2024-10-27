<?php
session_start();
session_destroy();
setcookie("TransPay", "", -1);