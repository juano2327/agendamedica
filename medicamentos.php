<?php 
	// @session_start();
	// if (!isset($_SESSION['usu']) && !isset($_SESSION['Pas'])) 
	// {
	// 	header('location:index.php');
	// }
	require_once('inc/adodb5/adodb.inc.php');
	require_once('inc/conex.php');
	$codigo 	=isset($_POST['codigo']) ? $_POST['codigo']:-1;
	$txtCodigo	=isset($_SESSION['cod'])	?$_SESSION['cod']:'';

	$conn=ADONewConnection('mysql');
	$conn->debug=false;
	$conn->Connect($server, $user, $clave, $base);
	$conn->SetFetchMode(ADODB_FETCH_ASSOC);

	// if ($codigo!=-1)
	// {
	// 	$Query	="DELETE FROM agenda.citas WHERE  Fecha_Cita='$codigo'";
	// 	$rs		=$conn->Execute($Query);
	// }
?>

<!Doctype html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>Citas Programadas</title>
		<link rel="stylesheet" type="text/css" href="Style1.css">
	</head>
	<script type="text/javascript">
	function fijarValor(valor)
	{
		var campo=document.getElementById('codigo');
		campo.value=valor;
	}
	</script>
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
			<section id='secfrm'>
			<section id='secfrm1'>
				<section id='secbanner'><img src="img/titreagenda.gif" width='650' height='200'></section>
				<form name='frminicio' method='POST' action=''>
				<section id='secfrm2C'>
					<h2>Medicamentos</h2>
					<input type='hidden' name='codigo' id='codigo' value='<?php echo $codigo; ?>'>
					<?php 
						try
						{	$clase='filaa';
							$Query 	="SELECT Med_nombre, Med_fechav FROM agenda.medicamentos";// este es para llenar la tabla donde te va mostrar los medicamentos
							$rs		=$conn->Execute($Query);

								// $_SESSION['fecha']	=$rs->fields['Fecha_Cita'];
								// $_SESSION['hora']	=$rs->fields['Hora_Cita'];
								// $_SESSION['lugar']	=$rs->fields['Lugar_Cita'];

							echo "<table class='tab'>";
							echo "<tr>";
							echo "<td class='td'>Nombre</td>";
							echo "<td class='td'>Fecha Vencimiento</td>";
							// echo "<td class='td'>Hora</td>";
							// echo "<td class='td'>Lugar</td>";
							// echo "<td class='td'>Reprogramar</td>";
							// echo "<td class='td'>Cancelar</td>";
							echo "</tr>";

							while (!$rs->EOF)
								{
								if($clase=='filaa') $clase='filab';
								else $clase='filaa';
								
								echo "<tr class='$clase'>";
								echo "<td>{$rs->fields['Med_nombre']}</td>";
								echo "<td>{$rs->fields['Med_fechav']}</td>";
								// echo "<td>{$rs->fields['Hora_Cita']}</td>";
								// echo "<td>{$rs->fields['Lugar_Cita']}</td>";
								// echo "<td><input type='button' class='btnt' value='Reprogramar' onClick='JavaScript:location.href=\"reprogramar.php?codcita={$rs->fields['Cod_Cita']}\";'></td>";
								// echo "<td><input type='button' class='btnt' name='Cancelar' text='Cancelar' title='Cancelar Cita' alt='Eliminar' value='Cancelar' onClick='JavaScript:fijarValor(\"{$rs->fields['Fecha_Cita']}\"); submit()'></td>";
								echo "</tr>";
								$rs->MoveNext();
								
								}
								echo "</table>";
								
						}
						catch (Exception $e)
						{
							
						}
						$conn->Close();
                        
					?>
				</section>
			</form>
			</section>
			</section>
		</section>
	</body>
</html>