<?php

include('bdd/bdd.php');

// Include Utilisateur Controleur & Modele
include('controleur/utilisateur/utilisateurControleur.php');
include('modele/utilisateur/utilisateurModele.php');

// Include Produit Controleur & Modele
include('controleur/produit/produitControleur.php');
include('modele/produit/produitModele.php');

// Include Intervention Controleur & Modele
include('controleur/intervention/interventionControleur.php');
include('modele/intervention/interventionModele.php');

$interventionControleur = new InterventionControleur($bdd);
$produitControleur = new ProduitControleur($bdd);
$utilisateurControleur = new UtilisateurControleur($bdd);

?>

<main id="tableau-de-bord">
	<div>
		<h2>BIENVENUE <?= $_SESSION['prenom'] . " " . $_SESSION['nom'] ?></h2>

		<div class="intervention-card-container">
	<?php
		$mesinterventions = array(); 

		if ($_SESSION['role'] == 'client')
			$mesInterventions = $interventionControleur->getInterventionClient($_SESSION['idutilisateur']);
		else if ($_SESSION['role'] == 'technicien')
			$mesInterventions = $interventionControleur->getInterventionTechnicien($_SESSION['idutilisateur']);

		foreach ($mesInterventions as $uneIntervention)
		{
			$monProduit = $produitControleur->getProduitById($uneIntervention["idproduit"]);
			$letech = $utilisateurControleur->getTechnicienById($uneIntervention["idtechnicien"]);
			$leclient = $utilisateurControleur->getClientById($uneIntervention["idclient"]);
		?>
			<div class="intervention-card">
				<h4><?= strtoupper($monProduit["nom_produit"]) ?></h4>
				<span><span class="carteinter_label">Marque:</span> <?= $monProduit["marque"] ?></span>
				<span><span class="carteinter_label">Catégorie:</span> <?= $monProduit["categorie"] ?></span>
				<span><span class="carteinter_label">Etat:</span> <?= $monProduit["etat"] ?></span>
				<span><span class="carteinter_label">Déposé le:</span> <?= substr($uneIntervention["date_creation_intervention"], 0, strpos($uneIntervention["date_creation_intervention"], " ")) ?></span>

		<?php
			if ($uneIntervention['idtechnicien'] != null && $uneIntervention['idtechnicien'] != 0) {
		?>

				<span><span class="carteinter_label">Accepté pour le:</span> <?= substr($uneIntervention["date_intervention"], 0, strpos($uneIntervention["date_intervention"], " ")) ?></span>

				<!-- On affiche le nom du technicien ou du client en fonction du role de la personne connectée -->
		<?php
			if ($_SESSION['role'] == 'client') {
				$fullname = $letech == null ? "" : $letech['nom'];
				$fullname .= " ";
				$fullname .= $letech == null ? "" : $letech['prenom'];
		?>
				<span><span class="carteinter_label">Par:</span> <?= $fullname ?></span>

		<?php	}
				else if ($_SESSION['role'] == 'technicien') {
		?>
				<span><span class="carteinter_label">De:</span> <?= $leclient['nom'] ?> <?= $leclient['prenom'] ?></span>
		<?php	}
		?>
				
				<span><span class="carteinter_label">Prix:</span> <?= $uneIntervention["prix_intervention"] ?></span>
				<span><span class="carteinter_label">Durée:</span> <?= $uneIntervention["duree"] ?></span>
		<?php
			} 
		?>
				<span class="carteinter_statut"><span class="carteinter_label">Statut</span> <?= $uneIntervention["statut"] ?></span>

		<!-- Boutons pour le Technicien -->
		<?php
			if ($_SESSION['role'] == 'technicien') { ?>
				<form class="tech-btns-card" method="post" action="controleur/traitement.php">
					<input type="hidden" name="idintervention" value="<?= $uneIntervention["idintervention"] ?>" />

				<?php
					if ($uneIntervention['statut'] == "acceptee") {
				?>
					<button type="submit" name="action" value="annulerInter" class="tech-btns-card-btn">Annuler</button>
				<?php
					}
					if ($uneIntervention['statut'] == "en cours") {
				?>
					<button type="submit" name="action" value="terminerInter" class="tech-btns-card-btn">Terminer</button>
				<?php
					}
					else if ($uneIntervention['statut'] == "refusee") {
				?>
					<button type="submit" name="action" value="supprimerInter" class="tech-btns-card-btn">Supprimer</button>
				<?php
					}
				?>
				</form>
	<?php	}
		?>

		<!-- Boutons pour le Client -->
		<?php
		if ($_SESSION['role'] == "client") {
		?>
				<form class="tech-btns-card" method="post" action="controleur/traitement.php">
					<input type="hidden" name="idintervention" value="<?= $uneIntervention["idintervention"] ?>" />

					<?php if ($uneIntervention['statut'] == "en attente") { ?>
						<button type="submit" name="action" value="supprimerInter" class="client-btns-card-btn">Annuler</button>
					<?php } ?>

					<?php if ($uneIntervention['statut'] == "acceptee") { ?>
						<button type="submit" name="action" value="rejeterInter" class="client-btns-card-btn">Refuser</button>
						<button type="submit" name="action" value="accepterInter" class="client-btns-card-btn">Accepter</button>
					<?php } ?>
				</form>
		<?php
		}
		?>
			</div>
	<?php
		}
	?>
		</div>
	</div>
</main>