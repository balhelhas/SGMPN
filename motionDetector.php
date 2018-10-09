<?php

	$auth_password = 'grupo3';
	$uploads_dir = 'files';
	$uploads_sufix = "_detected.txt";
	$uploads_sufix_history ="_history.txt";

	if (isset($_POST['autenticacao']) && isset($_POST['key']) && isset($_POST['date']))
	{
		$user_pwd = $_POST['autenticacao'];
		$user_key = $_POST['key'];
		$user_date = $_POST['date'];

		$path_file_motion = "$uploads_dir/$user_key$uploads_sufix";
		$path_file_history = "$uploads_dir/$user_key$uploads_sufix_history";
	}
	else
	{
		http_response_code(400);				
		echo("Falta de parâmetros ao chamar o serviço!\r\n");
		exit();		
	}
	
	
	if ($user_pwd != $auth_password)
	{	
		http_response_code(401);		
		echo("Erro na autenticação!\r\n");
		exit();
	}

	file_put_contents($path_file_motion, $user_key);
	
	$new_line = "Motion Detected\t(" . $user_date . ")" . PHP_EOL;
	file_put_contents($path_file_history, $new_line, FILE_APPEND);
?>