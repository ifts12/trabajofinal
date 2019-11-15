<?php 
if(!$user->hasRol('Administrador'))
{
    return false;
}
?>
<form enctype="multipart/form-data"  method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="id" value="<?php echo $clase->getId() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-rect btn-grad btn-danger ml-3">Borrar</button>
</form>
