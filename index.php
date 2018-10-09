<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>IPL - ESS</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="/css/style.css" rel="stylesheet">
			
</head>

<body>
	
	<div class="jumbotron">
		<div class="container">
			<h1>Sistema de Gestão e Monitorização de Parques Naturais</h1>
		</div>	
	</div>

	<div class="container">
		<ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#motionDetector" role="tab">Motion Detector</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" data-toggle="tab" href="#fireDetector" role="tab">Fire Detector</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" data-toggle="tab" href="#luminosityDetector" role="tab">Luminosity Detector</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" data-toggle="tab" href="#dataHistory" role="tab">Data History</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" data-toggle="tab" href="#contact" role="tab">Contact</a>
            </li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane" id="motionDetector" role="tabpanel">
            	<br>
   				<div class="row">
   					<div class="col-md-8 col-md-offset-2">
            			<?php
						$file = "files/motion_detected.txt";
						if (file_exists($file)){
							$result = file_get_contents($file);
							if($result == "motion"){ ?>
								<span class="btn btn-danger btn-block">Motion Detected</span>
								<br>
								<img class="img-responsive" src="images/capture.jpg" alt="captura de imagem">
								<br>
							<?php
							}else {
							?>
								<span class="btn btn-success btn-block">No Motion Detected</span>
							<?php
							}
						}
						?>
					</div>
   				</div>
            </div>

            <div class="tab-pane" id="fireDetector" role="tabpanel">
               	<br>
           		<div class="row">
           			<div class="col-md-6 col-md-offset-3">
           				<?php
							$file = "files/ta_valor.txt";
							if (file_exists($file)) {
								$temp = file_get_contents($file); ?>
									<h2><?php $temp ?></h2>
								<?php
								if($temp >= 34){ ?>
									<h1 class="text-center"><?php echo($temp) ?> ºC</h1>
									<br>
									<div class="well well-lg" style="background:red;">
										<h2 class="text-center">High Risk of Fire</h2>
									</div>
									<br>
									
								<?php
								}elseif($temp >= 30){
								?>
									<h1 class="text-center"><?php echo($temp) ?> ºC</h1>
									<br>
									<div class="well well-lg" style="background:yellow;">
										<h2 class="text-center">Medium Risk of Fire</h2>
									</div>
									<br>
								<?php
								}else{
								?>
									<h1 class="text-center"><?php echo($temp) ?> ºC</h1>
									<br>
									<div class="well well-lg" style="background:blue;">
										<h2 class="text-center">Low Risk of Fire</h2>
									</div>
									<br>
								<?php
								}
							}
						?>	
           			</div>
           		</div>	
            </div>

	        <div class="tab-pane" id="luminosityDetector" role="tabpanel">
            	<br>
   				<div class="row">
   					<div class="col-md-8 col-md-offset-2">
            			<?php
						$file = "files/lum_valor.txt";
						if(file_exists($file)){
							$result = file_get_contents($file);
							if($result == "day"){ ?>
								<img class="img-responsive" src="http://www.tribunahoje.com/vgmidia/imagens/222416_ext_arquivo.jpg"/>
							<?php
							}else{
							?>
								<img class="img-responsive" src="http://www.maiscuriosidade.com.br/wp-content/uploads/2015/05/a-noite-e-a-escurid%C3%A3o.jpg"/>
							<?php
							}
						}
						?>
					</div>
				</div>
			</div>
            

            <div class="tab-pane" id="dataHistory" role="tabpanel">
            	<br>
            	<div class="row">
            		<div class="col-md-6">
            			<div class="panel panel-default">
					        <div class="panel-heading">
					            <h2 class="panel-title">Motion Detector History</h2>
					        </div>
					        <div class="panel-body">
	                			<?php 
									echo(nl2br(file_get_contents("files/motion_history.txt"))); 
								?>
							</div>
						</div>
					</div>          	
            		<div class="col-md-6">
            			<div class="panel panel-default">
					        <div class="panel-heading">
					            <h2 class="panel-title">Fire Detector History</h2>
					        </div>
					        <div class="panel-body">
	                			<?php 
									echo(nl2br(file_get_contents("files/ta_history.txt"))); 
								?>
							</div>
	                	</div>
            		</div>
            	</div>
            </div>

            <div class="tab-pane" id="contact" role="tabpanel">
            	<br>
               	<div class="panel panel-default">
			        <div class="panel-heading">
			            <h2 class="panel-title">Trabalho Realizado Por</h2>
			        </div>
			        <div class="panel-body">
            			<h4>Guilherme Ramalho Nº 2141254</h4>
						<h4>Ricardo Ribeiro Nº 2110129</h4>
						<h4>Gonçalo Marques Nº 2152229</h4>
					</div>
            	</div>
            </div>

        </div>
	</div>

	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
</body>	

</html>