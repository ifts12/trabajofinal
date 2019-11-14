<!DOCTYPE html>
<html>
<head>
<!-- <meta charset="UTF-8"> -->
<meta charset="ISO-8859-1">
<title>UPCN Digital :: Turismo</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700"> 
<!-- <link rel="stylesheet" type="text/css" href="./lib/fontawesome-free-5.11.2-web/css/all.min.css" /> -->
<link rel="stylesheet" type="text/css" href="./lib/jquery-ui/themes/base/all.css" />
<link rel="stylesheet" type="text/css" href="./lib/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="./lib/onokumus-twbuttons-412e935/dist/twbuttons.min.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"/>

<!-- <link rel="stylesheet" type="text/css" href="./lib/datatables.net-bs4/css/dataTables.bootstrap4.min.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="./lib/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" /> -->

<!-- <link rel="stylesheet" type="text/css" href="lib/" /> -->

<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>
<body>

<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><?php include DIR_TEMPLATE . '/_terminos_condiciones.html.php'; ?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>