<?php
// Aquí puedes insertar código necesario para enviar las variables iniciales como es el "folderBase" hacia JS o hacia donde requieras.
$imageLoad = '/' . $folderBase . 'images/favicons/apple-icon-180x180.png';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
	<link rel="stylesheet" href="http://www.momstudio.es/img/img-elmaquetadorweb/hamburgers.min.css">
	<?php echo "<link rel='stylesheet' href='/" . $folderBase . "css/" . $theme . "/styles.css'>" ?>
	<link rel="shortcut icon" href='<?php echo $imageLoad?>' type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<script src="https://kit.fontawesome.com/b56eda6614.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<title>Pantalla principal</title>
</head>

<body>
	<main class="row g-0">
		<section class="col-sm-12 col-md-2 menu" id="mySidebar">

			<?php
			require $root . "templates/$theme/menu.php";
			?>

		</section>
		<section class="col-sm-12 col-md-10 contenido" id="main">
			<?php
			echo $mainContent;
			?>
		</section>
	</main>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/helpers.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
	<script>
		var forEach = function(t, o, r) {
			if ("[object Object]" === Object.prototype.toString.call(t))
				for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
			else
				for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t)
		};

		// variables globales
		var hamburgers = document.querySelectorAll(".hamburger");
		const menuMovil = document.querySelector('.mainMenu');
		const mainMenu = document.querySelector('#menu');


		if (hamburgers.length > 0) {
			forEach(hamburgers, function(hamburger) {
				hamburger.addEventListener("click", function() {
					this.classList.toggle("is-active");
					const clasesHamburgesa = hamburger.classList;
				}, false);
			});
		}
	</script>
</body>

</html>