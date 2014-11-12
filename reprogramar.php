<?php
	@session_start();
	if (!isset($_SESSION['usu']) && !isset($_SESSION['Pas'])) 
	{
		header('location:index.php');
	}
	require_once('inc/adodb5/adodb.inc.php');
	require_once('inc/conex.php');
		
		$txtCodigo 	=isset($_SESSION['cod'])	?$_SESSION['cod']:'';
	 	$txtId 		=isset($_SESSION['id'])		?$_SESSION['id']:'';
	 	$txtCodCita	=isset($_GET['codcita'])	?$_GET['codcita']:'';
		$txtFecha	=isset($_POST['txtFecha'])	?$_POST['txtFecha']:'';
		$txtHora 	=isset($_POST['txtHora'])	?$_POST['txtHora']:'';
		$txtLugar 	=isset($_POST['txtLugar'])	?$_POST['txtLugar']:'';
		$txtError 	='';
			
		$conn=ADONewConnection('mysql');
		$conn->debug=false;
		$conn->Connect($server, $user, $clave, $base);
		$conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if  (!empty($txtId) && !empty($txtFecha)  && !empty($txtHora)  && !empty($txtLugar))
	{
		$Query	="UPDATE agenda.citas SET Fecha_Cita='$txtFecha', Hora_Cita='$txtHora', Lugar_Cita='$txtLugar' WHERE Cod_Cita='$txtCodCita'";
		$rs 	=$conn->Execute($Query);
		if (!$rs) $txtError ="no se pudo programar su cita";
	  	else header('location:revisar.php');
	}
	try
	{
		if (!empty($txtCodigo))
		{
			$Query	="SELECT Fecha_Cita, Hora_Cita, Lugar_Cita FROM agenda.citas WHERE Cod_Usu='$txtCodigo' AND Cod_Cita='$txtCodCita'";
			$rs		=$conn->Execute($Query);
			if ($rs or !$rs->EOF)
			{
				$txtFecha   =$rs->fields['Fecha_Cita'];
                $txtHora    =$rs->fields['Hora_Cita'];
                $txtLugar   =$rs->fields['Lugar_Cita'];
			}
		}

	}
	catch (Exception $e)
	{
		
	}
	
	$conn->Close();
?>
<!Doctype html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>Reprogramar Cita</title>
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
				<form name='FrmConsulta' method='POST' action=''>
					<section id='secfrm2'>
						<h2>Reprogramar Cita</h2>
					<label for='txtId' class='lbl'>Cedula</label>
					<input type='text' name='txtId' class='ipt' value='<?php echo $txtId; ?>' readonly>
					<br>
					<label for='txtFecha' class='lbl'>Fecha</label>
					<input type='date' name='txtFecha' class='ipt' value='<?php echo $txtFecha; ?>' placeholder='AAAA-MM-DD' required autofocus>
					<br>
					<label for='txtHora' class='lbl'>Hora</label>
					<input type='time' name='txtHora' class='ipt' value='<?php echo $txtHora; ?>' required>
					<br>
					<label for='txtLugar' class='lbl'>Lugar</label>
					<input type='text' name='txtLugar' class='ipt' value='<?php echo $txtLugar; ?>' required>
					<br>
					<input type='submit' class='btn' name='reprogramar' value='Reprogramar'>
					<input type='button' class='btn' name='cancelar' value='Cancelar'  onClick='JavaScript:location.href="revisar.php";'>
					<br>
					<textarea class='txt'><?php echo $txtError; ?></textarea>
					</section>
				</form>
			</section>
		</section>
	</body>
</html>