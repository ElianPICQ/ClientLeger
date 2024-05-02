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

<main id="accepter-une-panne">
	<div>
		<h2>Corrigez les pannes !</h2>

		<div class="intervention-card-container">
		<?php
		$lesInterventions = $interventionControleur->getInterventionStatut("en attente");

		foreach ($lesInterventions as $uneIntervention)
		{
			$monProduit = $produitControleur->getProduitById($uneIntervention["idproduit"]);
			$leClient = $utilisateurControleur->getUtilisateurById($uneIntervention["idclient"])
		?>
			<a href="index.php?page=detailinter&idinter=<?= $uneIntervention['idintervention'] ?>">
			<div class="intervention-card">
				<h4><?= strtoupper($monProduit["nom_produit"]) ?></h4>
				<div>
					<span><span class="carteinter_label">Marque:</span> <?= $monProduit["marque"] ?></span>
					<span><span class="carteinter_label">Catégorie:</span> <?= $monProduit["categorie"] ?></span>
					<span><span class="carteinter_label">Etat:</span> <?= $monProduit["etat"] ?></span>
					<span><span class="carteinter_label">De:</span> <?= $leClient["nom"] ?> <?= $leClient["prenom"] ?></span>
					<span><span class="carteinter_label">Statut</span> <?= $uneIntervention["statut"] ?></span>
				</div>
			</div>
			</a>
		<?php
		}
		?>
		</div>
	</div>
</main>