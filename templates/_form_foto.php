<div class="form-group">
    <label for="foto">Foto</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="fotoFile" lang="es">
        <label class="custom-file-label" for="customFile"><?php echo empty($clase->getFoto()) ? 'Seleccione una foto' : $clase->getFoto() ?></label>
    </div>
    <small id="fotoHelp" class="form-text text-muted">Foto.</small>
    <div class="invalid-feedback">Debe subir una foto</div>
</div>
