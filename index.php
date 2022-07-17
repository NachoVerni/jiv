<!DOCTYPE html>

<?php
	require_once("config.php");
	require_once("contenido/includes/db.php");
	include("contenido/includes/sesion.php");
	include("contenido/funciones/fc_log.php");


	$menu = $_GET['menu'] ?? "inicio";
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JIV</title>
	<!-- Bootstrap CSS -->
    <link href="contenido/bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <!-- CSS propios -->
    <link href="contenido/css/estilos_001.css" rel="stylesheet">
</head>
<body class="bg-white">
	<nav id="navbar-principal" class="navbar bg-light p-3 fixed-top shadow-sm-2">
	  <a class="navbar-brand" href="index.php">JIV</a>
	  <ul class="nav nav-pills">
	    <li class="nav-item">
	      <a class="nav-link" href="#scrollspy1Musico">Músico</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#scrollspy2Coach">Coach</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#scrollspy3Programador">Programador</a>
	    </li>
	    <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Herramientas</a>
	      <ul class="dropdown-menu">
	        <li><a class="dropdown-item" href="#scrollspyHeading3">Third</a></li>
	        <li><a class="dropdown-item" href="#scrollspyHeading4">Fourth</a></li>
	        <li><hr class="dropdown-divider"></li>
	        <li><a class="dropdown-item" href="#scrollspyHeading5">Fifth</a></li>
	      </ul>
	    </li>
	  </ul>
	</nav>

	<div class="container">
		<div data-bs-spy="scroll" data-bs-target="#navbar-principal" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
			<div id="scrollspy1Musico" class="pt-6rem">
				<h4>Músico</h4>
		  	<p>...</p>
			</div>
			<div id="scrollspy2Coach" class="pt-6rem">
				<h4 id="">Coach</h4>
			  <p>...</p>
			</div>
			<div id="scrollspy3Programador" class="pt-6rem">
				<h4 id="">Programador</h4>
			  <p>...</p>
			</div>
			<div id="scrollspyHeading3" class="pt-6rem">
				<h4 id="">Third heading</h4>
			  <p>...</p>
			</div>
			<div id="scrollspyHeading4" class="pt-6rem">
				<h4 id="">Fourth heading</h4>
			  <p>...</p>
			</div>
			<div id="scrollspyHeading5" class="pt-6rem">
				<h4 id="">Fifth heading</h4>
			  <p>...</p>
			</div>
		</div>
	</div>




	<div class="row mt-2">
		<?php if($menu != "apr-apy"){ ?>
		<div class="col-12 col-md-6 col-lg-4 mb-2 h-100">
			<div class="card">
			  <div class="card-header">
			    APR-APY converter
			  </div>
			  <div class="card-body">
			  	<?php if($menu == "inicio"){ ?>
			    <h5 class="card-title">Transformá rápidamente interes compuesto en interes simple y viceversa</h5>
			    <?php } ?>
			    <a href="#" class="btn btn-primary">Acceder a la herramienta</a>
			  </div>
			</div>
		</div>
		<?php } ?>

		<?php if($menu != "calculadoras"){ ?>
		<div class="col-12 col-md-6 col-lg-4 mb-2 h-100">
			<div class="card">
			  <div class="card-header">
			    Calculadoras de inversión
			  </div>
			  <div class="card-body">
			  	<?php if($menu == "inicio"){ ?>
			    <h5 class="card-title">Calculá rápidamente que inversión necesitas para la ganancia deseada o que ganancia tenrías con la inversión realizada.</h5>
			    <?php } ?>
			    <a href="#" class="btn btn-primary">Acceder a la herramienta</a>
			  </div>
			</div>
		</div>
		<?php } ?>

		<?php if($menu != "il"){ ?>
		<div class="col-12 col-md-6 col-lg-4 mb-2 h-100">
			<div class="card">
			  <div class="card-header">
			    Calculadora Impermantent Loss
			  </div>
			  <div class="card-body">
			  	<?php if($menu == "inicio"){ ?>
			    <h5 class="card-title">Calculá rápidamente el posible Impermanent Loss de tu inversión.</h5>
			    <?php } ?>
			    <a href="#" class="btn btn-primary">Acceder a la herramienta</a>
			  </div>
			</div>
		</div>
		<?php } ?>

		<?php if($menu != "inversion"){ ?>
		<div class="col-12 col-md-6 col-lg-4 mb-2 h-100">
			<div class="card">
			  <div class="card-header">
			    Calculadoras de inversión
			  </div>
			  <div class="card-body">
			  	<?php if($menu == "inicio"){ ?>
			    <h5 class="card-title">Calculá rápidamente que inversión necesitas para la ganancia deseada o que ganancia tenrías con la inversión realizada.</h5>
			    <?php } ?>
			    <a href="#" class="btn btn-primary">Acceder a la herramienta</a>
			  </div>
			</div>
		</div>
		<?php } ?>

		<?php if($menu != "billeteras"){ ?>
		<div class="col-12 col-md-6 col-lg-4 mb-2 h-100">
			<div class="card">
			  <div class="card-header">
			    Billeteras
			  </div>
			  <div class="card-body">
			  	<?php if($menu == "inicio"){ ?>
			    <h5 class="card-title">Gestioná tus finanzas con múltiples billeteras (cuentas) y monedas.</h5>
			    <?php } ?>
			    <a href="index.php?menu=billeteras" class="btn btn-primary">Acceder a la herramienta</a>
			  </div>
			</div>
		</div>
		<?php } ?>
	</div>

	<hr>

	<div class="container">
		<?php
    if (is_readable("contenido/modulos/".$menu.".php"))
    	{ include("contenido/modulos/".$menu.".php"); }
    else echo "AHHHH";
    ?>
	</div>


	<!-- Bootstrap JS -->
	<script src="contenido/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>