		<?php
		if(isset($menu))
			{
			echo "</section>
			</main>";
			}else{
				echo "</section>";
				echo "</main>";
			}
		?>
		
	
	<?php
		if(isset($datatables))
		{
			echo '
			<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
			<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.7/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.3.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script>
			';
		}
	?>

	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
	<?php
		if(isset($menu))
			{
				echo "<script>
							var forEach = function(t, o, r) {
								if ('[object Object]' === Object.prototype.toString.call(t))
									for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
								else
									for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t)
							};

							// variables globales
							var hamburgers = document.querySelectorAll('.hamburger');
							const menuMovil = document.querySelector('.mainMenu');
							const mainMenu = document.querySelector('#menu');


							if (hamburgers.length > 0) {
								forEach(hamburgers, function(hamburger) {
									hamburger.addEventListener('click', function() {
										this.classList.toggle('is-active');
										const clasesHamburgesa = hamburger.classList;
									}, false);
								});
							}
						</script>";
			}
	?>

	<?php echo "<script  src='/" . $folderBase . "js/" . $theme . "/onload.js'></script>";?>
	<?php echo "<script  src='/" . $folderBase . "js/" . $theme . "/boostrapFunction.js'></script>";?>
	<?php echo "<script  src='/" . $folderBase . "js/" . $theme . "/generalFunctions.js'></script>";?>
	

</body>

</html>