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

<main id="historique">
	<div>
		<h2>HISTORIQUE</h2>
		
	<?php
		$mesinterventions = array(); 

		if ($_SESSION['role'] == 'client')
			$mesInterventions = $interventionControleur->getInterventionTermineeClient($_SESSION['idutilisateur']);
		else if ($_SESSION['role'] == 'technicien')
			$mesInterventions = $interventionControleur->getInterventionTermineeTechnicien($_SESSION['idutilisateur']);

		$nbInter = $interventionControleur->getNbInterventionUtilisateur($_SESSION['idutilisateur'], "terminee");
		$prixTotal = $interventionControleur->getPrixInterventionUtilisateur($_SESSION['idutilisateur'], "terminee");

		?>
		<div id="histo_stats">
			<span>Nombre total d'nterventions : <?= $nbInter[0] ?></span>
			<span>Prix total des interventions : <?= $prixTotal[0] ?></span>
		</div>

		<div class="intervention-card-container">

		<?php
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
			if ($uneIntervention['idtechnicien'] != null) {
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
			</div>
	<?php
		}
	?>
		</div>
	</div>
</main>