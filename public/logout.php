<?php
@session_start();
unset($_SESSION['u']);
header('Location: login.php');
