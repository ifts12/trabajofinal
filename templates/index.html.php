<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous">
<link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>

<div id="menu">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<a class="navbar-brand" href="#">Hidden brand</a>
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">

    <li >
      
    </li>
			<li v-for="menu in menus" class="nav-item active"><a class="nav-link" v-bind:href="menu.link">{{  menu.txt }} <span class="sr-only">(current)</span></a></li>

		</ul>
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search"
				placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
</nav>
</div>




<div>
	<div style="background-image: url('/images/hero_bg_2.jpg'); background-size: cover; height: 95vh; max-width: 100%">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center" style="min-height: 560px;">
			<h1>UPCN Turismo</h1>
		</div>
	</div>
</div>

<div class="container">
	
	<div style="background-image: url('/images/hero_bg_2.jpg'); background-size: cover; height: 95vh; max-width: 100%">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center" style="min-height: 560px;">
			<h1>UPCN Turismo</h1>
		</div>
	</div>
</div>





<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.11.2/js/fontawesome.min.js" integrity="sha256-MoYcVrOTRHZb/bvF8DwaNkTJkqu9aCR21zOsGkkBo78=" crossorigin="anonymous"></script>

<!-- development version, includes helpful console warnings -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
<script src="/js/vue.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- production version, optimized for size and speed -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->
<script src="/js/bootstrap.min.js"></script>


<script>
var menu = new Vue({
	el: '#menu',
	data: {
    	'menus': [
    		{ txt: 'Inicio', link: 'a' },
    		{ txt: 'Quienes somos', link: 'b' },
    		{ txt: 'Productos', link: 'c' },
    		{ txt: 'Login', link: 'd' },
    	]
	}
});
</script>


<script>
var app = new Vue({
  el: '#app',
  data: {
    message: 'UPCN!'
  }
});

var app3 = new Vue({
  el: '#app-3',
  data: {
    seen: true
  }
});
</script>


<footer>PIE</footer>

</body>
</html>


