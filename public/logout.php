<?php
require __DIR__ . '/../src/autoload.php';

session_start();
unset($_SESSION['u']);
header('Location: login.php');
