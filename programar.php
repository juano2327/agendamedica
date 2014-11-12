<?php 
	@session_start();
	if (!isset($_SESSION['usu']) && !isset($_SESSION['Pas'])) 
	{
		header('location:index.php');
	}
	require_once('inc/adodb5/adodb.inc.php');
	require_once('inc/conex.php');

	$txtCodigo	=isset($_SESSION['cod'])	?$_SESSION['cod']:'';
	$txtId		=isset($_SESSION['id'])		?$_SESSION['id']:'';
	$txtFecha	=isset($_POST['txtFecha'])	?$_POST['txtFecha']:'';
	$txtHora	=isset($_POST['txtHora'])	?$_POST['txtHora']:'';
	$txtMed		=isset($_POST['txtMed'])	?$_POST['txtMed']:'';
	$txtLugar	=isset($_POST['txtLugar'])	?$_POST['txtLugar']:'';
	$txtError	='';

	$conn=ADONewConnection('mysql');
	$conn->debug=false;
	$conn->Connect($server, $user, $clave, $base);
	$conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if (empty($txtError) && !empty($txtFecha) or !empty($txtHora)) 
	{
		$Query	="INSERT INTO agenda.citas (Cod_Usu,Id_Usu,Fecha_Cita,Hora_Cita,Medico_Cita,Lugar_Cita) VALUES ('$txtCodigo','$txtId','$txtFecha','$txtHora','$txtMed','$txtLugar')";
		$rs		=$conn->Execute($Query);
		if (!$rs) $txtError ='No Se Puedo Programar Su Cita Puede Ser Que Usted u Otra Persona Tenga Una Cita Programada Para Esta La Misma Fecha, Hora y Lugar. ';
		else $txtError ='Su Cita Ha Sido Programada Para El Dia '.$txtFecha.' a Las ' .$txtHora;
	}
	$conn->Close();
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
					<h2>Programar Una Cita</h2>
					<label for='txtId' class='lbl'>Cedula</label>
					<input type='text' class='ipt' name='txtId' value='<?php echo $txtId; ?>'>
					<br>
					<label for='txtFecha' class='lbl'>Fecha</label>
					<input type='date' class='ipt' name='txtFecha' value='<?php echo $txtFecha; ?>' autofocus>
					<br>
					<label for='txtHora' class='lbl'>Hora</label>
					<input type='time' class='ipt' name='txtHora' value='<?php echo $txtHora; ?>'>
					<br>
					<label for='txtMed' class='lbl'>Medico</label>
					<select name='txtMed' class='ipt'>
						<option>seleccione</option>
						<option value='Med1'>Med1</option>
						<option value='Med2'>Med2</option>
						<option value='Med3'>Med3</option>
						<option value='Med4'>Med4</option>
						<option value='Med5'>Med5</option>
						<option value='Med6'>Med6</option>
					</select>
					<!-- <input type='time' class='ipt' name='txtHora' value='<?php echo $txtHora; ?>'> -->
					<br>
					<label for='txtLugar' class='lbl'>Lugar</label>
					<input type='text' class='ipt' name='txtLugar' value='<?php echo $txtLugar; ?>'>
					<br>
					<input type='submit' class='btn' value='Programar' title='Programar Cita'>
					<input type='reset' class='btn' value='Cancelar' title='Cancelar'>
					<textarea class='txt'><?php echo $txtError; ?></textarea>
				</section>
			</form>
			</section>
		</section>
	</body>
</html>