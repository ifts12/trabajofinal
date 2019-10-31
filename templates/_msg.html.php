<?php 
if(isset($msg))
{
?>
<div class="my-3 alert alert-<?php echo $msg['tipo'] ?> alert-dismissible fade show" role="alert">
    <strong><?php echo $msg['msg'] ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php } ?>
