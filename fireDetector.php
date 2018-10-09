<?php
	
	$auth_password = 'grupo3';
	$uploads_dir = 'files';
	$uploads_sufix_value = "_valor.txt";
	$uploads_sufix_date = "_data.txt";
	$uploads_sufix_history = "_history.txt";

	if (isset($_POST['autenticacao']) && isset($_POST['key']) && isset($_POST['value']) && isset($_POST['date']))
	{
		$user_pwd = $_POST['autenticacao'];
		$user_key = $_POST['key'];
		$user_value = $_POST['value'];
		$user_date = $_POST['date'];


		if ($user_key != "ta")
		{
			http_response_code(400);					
			echo("Serviço apenas para 'ta' (temperatura do ar).\r\n");
			exit();					
		}
		$path_file_value = "$uploads_dir/$user_key$uploads_sufix_value";
		$path_file_date = "$uploads_dir/$user_key$uploads_sufix_date";		
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

	file_put_contents($path_file_value, $user_value);
	
	file_put_contents($path_file_date, $user_date);
	
	$new_line = $user_value . "\t(" . $user_date . ")" . PHP_EOL;
	file_put_contents($path_file_history, $new_line, FILE_APPEND);
	
	echo("Informação atualizada com sucesso. [$user_key = $user_value ($user_date)]\r\n");