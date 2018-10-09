<?php
	
	$auth_password = 'grupo3';
	$uploads_dir = 'files';
	$uploads_sufix_value = "_valor.txt";

	if (isset($_POST['autenticacao']) && isset($_POST['key']) && isset($_POST['value']))
	{
		$user_pwd = $_POST['autenticacao'];
		$user_key = $_POST['key'];
		$user_value = $_POST['value'];



		if ($user_key != "lum")
		{
			http_response_code(400);					
			echo("Serviço apenas para 'ta' (luminosidade).\r\n");
			exit();					
		}
		$path_file_value = "$uploads_dir/$user_key$uploads_sufix_value";			
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
	