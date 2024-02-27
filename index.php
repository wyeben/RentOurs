<?php

require_once 'backend/User.php';
require_once 'backend/Customer.php';

$user = new User($security, $profile, $accountType);

$customer = new Customer($booking, $review);


?>



