<?php

require __DIR__ . '/../../functions/auth.php';

if (!empty($_GET['logout']) && ($_GET['logout']) == 1){
    $_SESSION['success'] = $massages['auth']['success_logout']['message'];
    logout();
}


