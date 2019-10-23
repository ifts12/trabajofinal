<?php
require __DIR__ . '/../src/autoload.php';

use UPCN\Controlador\Login;
use UPCN\Templates;

$t = new Templates();

echo $t->getHead();
?>

<title>Inicio</title>

<?php echo $t->getStyleSheets(); ?>
</head>

<body style="height: 100%">

<?php $datos = new Login(); ?>

<?php echo $t->getLogin(); ?>

<?php echo $t->getJavascript(); ?>
<?php echo $t->getFoot(); ?>
