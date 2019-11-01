
<script src="./lib/jquery/dist/jquery.min.js"></script>
<script src="./lib/jquery-ui/ui/widget.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.11.2/js/fontawesome.min.js" integrity="sha256-MoYcVrOTRHZb/bvF8DwaNkTJkqu9aCR21zOsGkkBo78=" crossorigin="anonymous"></script> -->
<script defer src="./lib/fontawesome-free-5.11.2-web/js/all.min.js"></script> <!--load all styles -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="./lib/popper.js/dist/umd/popper.min.js"></script>

<!-- production version, optimized for size and speed -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->
<!-- <script src="./lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="./lib/bootstrap/dist/js/bootstrap.min.js"></script>

 
<!-- <script type="text/javascript" src="./lib/jszip/dist/jszip.min.js"></script> -->
<!-- <script type="text/javascript" src="./lib/pdfmake/build/pdfmake.min.js"></script> -->
<!-- <script type="text/javascript" src="./lib/pdfmake/build/vfs_fonts.js"></script> -->
<!-- <script type="text/javascript" src="./lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script type="text/javascript" src="./lib/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script> -->

 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#paquete').hover(
        function()
		{
        	$(this).addClass('show');
        	$(this).find('div.dropdown-menu').addClass('show');
        },
        function()
		{
        	$(this).removeClass('show');
        	$(this).find('div.dropdown-menu').removeClass('show');
        }
	);

	$('#table').DataTable();
	document.onscroll = stickyScroll;
});

function stickyScroll(e) {
	if(e.pageY > 1) {
		$("header").addClass('sticky-top');
	} else {
		$("header").removeClass('sticky-top');
	}
}
</script>

