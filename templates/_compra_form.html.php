
<div class="container">
<h1 class="t1">Compra</h1>

<form enctype="multipart/form-data" name="forms" method="post" class="">

<?php 
    echo '<input type="hidden" name="method" value="PUT">';
    echo sprintf('<input type="hidden" name="id_%s" value="%d">', $seccion, $_GET['d']);
    echo sprintf('<input type="hidden" name="s" value="%s">', $_GET['s']);
    echo '<input type="hidden" name="precio_final" id="precio_final" value="">';
    
    if(isset($asistenciaMedica) && !empty($asistenciaMedica))
    {
        echo sprintf('<input type="hidden" name="id_asistencia_medica" value="%d">', $asistenciaMedica->getId());
    }
?>
    
    <div class="form-group">
        <label for="cantidad_afiliados">Cantidad de afiliados</label>
        <input name="cantidad_afiliados" type="number" class="form-control" id="cantidad_afiliados" value="1" aria-describedby="cantidad_afiliadosHelp" placeholder="Cantidad de afiliados" min="1">
        <small id="cantidad_afiliadosHelp" class="form-text text-muted">Ingrese cuantos afiliados viajan (incluído usted).</small>
        <div class="invalid-feedback">Ingrese una cantidad válida de afiliados</div>
    </div>
    
    <div class="form-group">
        <label for="cantidad_invitados">Cantidad de invitados</label>
        <input name="cantidad_invitados" type="number" class="form-control" id="cantidad_invitados" value="0" aria-describedby="cantidad_invitadosHelp" placeholder="Cantidad de invitados" min="0">
        <small id="cantidad_invitadosHelp" class="form-text text-muted">Ingrese cuantos invitados viajan.</small>
        <div class="invalid-feedback">Ingrese una cantidad válida de invitados.</div>
    </div>
    
    <div class="form-check">
        <input name="id_adicional" type="checkbox" class="form-check-input" id="id_adicional" aria-describedby="termHelp" value="1" disabled><label for="term" class="form-check-label" >Cobertura médica para invitado?</label>
        <small id="termHelp" class="form-text text-muted">Cobertura médica en caso de emergencia.</small>
    </div>
    
    <div class="form-check">
        <input name="term" type="checkbox" class="form-check-input" id="term" aria-describedby="termHelp"><label for="term" class="form-check-label">Terminos y condiciones</label>
        <small id="termHelp" class="form-text text-muted">Terminos y condiciones.</small>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-success float-left" disabled="disabled">Comprar</button>
    </div>
</form>
    
</div>
