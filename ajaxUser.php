<?php
include 'User.php';
include 'UserManager.php';
$user_manager = new UserManager();

if(isset($_GET) && isset($_GET['pk'])) {
    $user = $user_manager->fetch($_GET['pk']);
    $display = 'one';
}

?>
<h2><?= $user->__get('username'); ?></h2>