<?php
session_name('user');
session_start();
session_destroy();
header('location: index.php');
?>