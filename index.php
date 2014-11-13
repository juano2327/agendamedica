<?php 
	$conn_string = "postgres://ggxbbygxmwmdov:8psoXO_20KSMvoFQYN7DzbpVBi@ec2-54-83-5-151.compute-1.amazonaws.com:5432/d8f7vpdkg3cgu8";

        $dbconn =pg_connect($conn_string)
                 or die('no puedo conectarme:' . pg_last_error());
        echo "Conectado a la Base de Datos!";

        @session_start();
	require_once('inc/adodb5/adodb.inc.php');
	require_once('inc/conex.php');

	$txtUser	=isset($_POST['txtUser'])?$_POST['txtUser']:'';
	$txtPass	=isset($_POST['txtPass'])?$_POST['txtPass']:'';
	$txtError	='';

	$conn=ADONewConnection('mysql');
	$conn->debug=false;
	$conn->Connect($server, $user, $clave, $base);
	$conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if (empty($txtError) && !empty($txtUser) && !empty($txtPass))
	{	
		$Query	="SELECT Cod_Usu, Id_Usu, Nombre_Usu FROM usuarios WHERE Nick_Usu='$txtUser' AND Clave_Usu=md5('$txtPass')";
		$rs		=$conn->Execute($Query);
		if (!$rs or $rs->EOF) $txtError ='Usuario ó Contraseña Invalidos Verifique e Intente De Nuevo';
			else
			{
				
				$conn->Close();
				$_SESSION['usu']=$txtUser;
				$_SESSION['pas']=$txtPass;
				$_SESSION['cod']	=$rs->fields['Cod_Usu'];
				$_SESSION['id']		=$rs->fields['Id_Usu'];
				$_SESSION['nombre']	=$rs->fields['Nombre_Usu'];
				header('location:menu2.php');
			}
	}
?>

<!Doctype html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>Inicio De Sesión</title>
		<link rel="stylesheet" type="text/css" href="Style1.css">
	</head>
	<body>

		<section id='secbody'>
			<div class="wrap">
          <div class="wall wall-right"></div>
          <div class="wall wall-left"></div>   
          <div class="wall wall-top"></div>
          <div class="wall wall-bottom"></div> 
          <div class="wall wall-back"></div>    
      </div>
      <div class="wrap">
          <div class="wall wall-right"></div>
          <div class="wall wall-left"></div>   
          <div class="wall wall-top"></div>
          <div class="wall wall-bottom"></div>   
          <div class="wall wall-back"></div>    
      </div>
    </div>
			<section id='secfrm01'>
				<section id='secbanner'><img src="img/titreagenda.gif" width='650' height='200'></section>
				<form name='frminicio' method='POST' action=''>
				<section id='secfrm2'>
					<h2>Iniciar Sesión</h2>
					<label for='txtUser' class='lbl'>Usuario</label>
					<input type='text' class='ipt' name='txtUser' value='<?php echo $txtUser; ?>' required autofocus>
					<br>
					<label for='txtPass' class='lbl'>Contraseña</label>
					<input type='password' class='ipt' name='txtPass' value='<?php echo $txtPass; ?>' required>
					<br>
					<input type='submit' class='btn' value='Entrar' title='Iniciar Sesión'>
					<input type='reset' class='btn' value='Cancelar' title='Cancelar'>
					<textarea class='txt'><?php echo $txtError; ?></textarea>
				</section>
			</form>
			</section>
		</section>
	</body>
</html>
