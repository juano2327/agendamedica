<?php
	@session_start();
	if (!isset($_SESSION['usu']) && !isset($_SESSION['Pas'])) 
	{
		header('location:index.php');
	}
?>
<!Doctype html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>Programar Cita</title>
		<link rel="stylesheet" type="text/css" href="Style1.css">
	</head>
	<body>
		<section id='secbody'>
			<section id='secmenu'>
			<nav class='nav'>
			<ul>
				<li class='lip'><a href="programar.php">Programar Cita</a></li>
				<li class='lip'><a href="revisar.php">Citas Pendientes</a>
				<li class='lip'><a href="medicamentos.php">Medicamentos</a>
				<li class='lip'><a href="index.php">Cerrar Sesión</a></li>
			</ul>
			</nav>
			</section>
			<section id='secfrm1'>
				<section id='secbanner'><img src="img/titreagenda.gif" width='650' height='200'></section>

				<form name='frminicio' method='POST' action=''>
				<section id='secfrm2'>
					
				</section>
			</form>
			</section>
		</section>
	</body>
</html>