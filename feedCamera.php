<?php
	
	$auth_password = 'grupo3';
	$uploads_dir_image = 'images';

	if (isset($_POST['autenticacao']) && isset($_FILES))
	{
		$user_pwd = $_POST['autenticacao'];

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

	$count_files = sizeof($_FILES['file']['name']);	
	echo "nº de ficheiros: " . $count_files . "<br />";
	if ($count_files != 1) {
		header('Apenas pode enviar 1 ficheiro!', true, 406);
        echo "Erro: nº de ficheiros incorreto (" . $count_files . ")<br />";
    } 
	else if ($_FILES["file"]["error"] > 0) {
		header('Erro' . $_FILES["file"]["error"], true, 400);
        echo "Erro: " . $_FILES["file"]["error"] . "<br />";
    } 
	else {
		$tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];
        echo "Uploaded file: " . $name . "<br />";
        echo "Stored in: " . $tmp_name . "<br />";
		
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . (intval($_FILES["file"]["size"] / 1024)) . " Kb<br />";
		
		$path = "$uploads_dir_image/$name";		
		move_uploaded_file($tmp_name, $path);
		echo "ficheiro copiado para: $path";
    }
