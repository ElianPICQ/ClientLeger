<div id= "connexion">

	<div class="connexion_form_container">
		<div class="connexion_form">
			<h2 class="page-title"> Se Connecter </h2>

			<form method="post" action="controleur/traitement.php">

				<input class="login-input" type="text" name="email" placeholder="Email :" />

				<input class="login-input" type="password" name="mdp" placeholder="Mot de passe :" />

			<div class="login-btns">
				<button type="reset" class="reset-btn">Annuler</button>
				<button type="submit" class="confirm-btn" name="action" value="connecter">Confirmer</button>
			</div>

			</form>
		</div>
	</div>
	
	<div class="connexion_bg">
		<div class="logo-connexion"></div>
		<img src="public/img/bg_connexion.svg" />
		<div class="goto-inscription-connexion">
			<p>Pas de compte?</p>
			<span>
				<a href="index.php?page=inscription">S'inscrire</a>
			</span>
		</div>
	</div>
</div>