<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
// Aquí puedes insertar código necesario para enviar las variables iniciales como es el "folderBase" hacia JS o hacia donde requieras.
$imageLoad = '/' . $folderBase . 'images/favicons/apple-icon-180x180.png';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href='<?php echo $imageLoad?>' type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
	<link rel="stylesheet" href="https://www.momstudio.es/img/img-elmaquetadorweb/hamburgers.min.css">
	<?php
		if(isset($datatables))
		{
			echo'
			<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
			<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.7/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.3.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
 
			';
		}
	?>
	<?php
		if(isset($menu)){
			echo "<link rel='stylesheet' href='/" . $folderBase . "css/" . $theme . "/styles.css'>";
		}else{
			echo "<link rel='stylesheet' href='/" . $folderBase . "css/" . $theme . "/login.css'>";
		};
	
	 ?>
	<link rel="shortcut icon" href='<?php echo $imageLoad?>' type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<script src="https://kit.fontawesome.com/b56eda6614.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<?php
	if(isset($graphs)){
	echo '
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/helpers.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>';
	}
	?>
	<title><?php echo $pageTitle ?></title>
</head>
<body>
	
		<?php 
		if(isset($menu))
			{
				echo"<main class='row g-0'>";
				echo "<section class='col-sm-12 col-md-2 menu' id='mySidebar'>";
				require $root . "templates/$theme/menu.php";
				echo "
				</section>
				<section class='col-sm-12 col-md-10 contenido' id='main'>";
			}
		else{
				echo "<main class='form-signin'";
				echo "<section class='mainContent' id='main'>";
			}
		?>