<?php
require __DIR__ . '/../src/autoload.php';

use UPCN\Login;
use UPCN\Templates;

$t = new Templates();

echo $t->getHead();

// password_hash('somepassword', PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);

// if(password_verify($user_password, $stored_hash)) {
//     // password validated
// }

?>

<title>Inicio</title>

<?php echo $t->getStyleSheets(); ?>
</head>

<body style="height: 100%">

<?php $datos = new Login(); ?>

<?php echo $t->getLogin(); ?>

<?php echo $t->getJavascript(); ?>
<?php echo $t->getFoot(); ?>
