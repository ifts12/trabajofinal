<div class="container">
<?php 
if(isset($_SESSION['msg']))
{
    $msg = json_decode($_SESSION['msg']);
?>
<div class="my-3 alert alert-<?php echo $msg->tipo ?> alert-dismissible fade show" role="alert">
<strong>
<?php 
if(is_array($msg->msg))
{
    echo '<ul>';
    foreach ($msg->msg as $v)
    {
        echo sprintf('<li>%s</li>', $v);
    }
    echo '</ul>';
}
else
{
    echo sprintf('%s', $msg->msg);
}
?>
</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php 

unset($_SESSION['msg']);

} ?>
</div>