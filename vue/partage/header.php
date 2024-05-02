<!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
	<title>Orange</title>

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link type="text/css" rel="stylesheet" href="public/css/styles.css" />
</head>
<body>
<div id="fullpage">
<header>
	<img src="public/img/logo_Orange.png" alt="logo Orange" width="55%" id="header-logo" />

	<nav>
		<ul>
			<li title="Tableau de Bord"><a href="index.php?page=tableaudebord">Tableau de Bord</a></li>
			<li title="Profil"><a href="index.php?page=profil">Profil</a></li>
			<?php
			if ($_SESSION['role'] == 'client')
			{ ?>
			<li title="Signaler une panne" class="nav_btn nav_btn_client"><a href="index.php?page=signalerunepanne">Signaler une Panne</a></li>
			<?php }
			else if ($_SESSION['role'] == 'technicien')
			{ ?>
			<li title="Accepter une Panne" class="nav_btn nav_btn_tech"><a href="index.php?page=accepterunepanne">Accepter une Panne</a></li>
			<?php } ?>

			<li title="Historique"><a href="index.php?page=historique">Historique</a></li>
			<li title="Se deconnecter"><a href="index.php?page=deconnecter">Se déconnecter</a></li>
		</ul>
	</nav>
</header>