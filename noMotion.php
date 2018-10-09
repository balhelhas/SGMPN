<?php
	
	$auth_password = 'grupo3';
	$uploads_dir = 'files/motion_detected.txt';

	if (isset($_POST['autenticacao']) && isset($_POST['key']))
	{
		$user_pwd = $_POST['autenticacao'];
		$user_key = $_POST['key'];

		$path_file_motion = "$uploads_dir";
	}
	else
	{
		echo("Falta de parâmetros ao chamar o serviço!");
		exit();		
	}
	
	if ($user_pwd != $auth_password)
	{	
		echo("Erro na autenticação");
		exit();
	}

    file_put_contents($path_file_motion, $user_key);