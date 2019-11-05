<div class="form-group">
    <label for="foto">Foto</label>
    <div class="custom-file">
        <input name="foto" type="file" class="custom-file-input" id="fotoFile" lang="es">
        <label class="custom-file-label" for="foto"><?php echo empty($clase->getFoto()) ? 'Seleccione una foto' : $clase->getFoto() ?></label>
    </div>
    <small id="fotoHelp" class="form-text text-muted">Foto.</small>
    <div class="invalid-feedback">Debe subir una foto</div>
</div>
