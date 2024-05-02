<div id= "inscription">

	<div class="connexion_form_container">

		<div class="connexion_form">
			<h2 class="page-title"> Créer un compte </h2>

			<form method="POST" action="controleur/traitement.php">

			<div class="login-container">
				<span class="required-field">*</span>
				<input id="inscription-nom" class="login-input" type="text" name="nom" placeholder="Nom" required />
			</div>
			<div class="login-container">
				<span class="required-field">*</span>
				<input id="inscription-prenom" class="login-input" type="text" name="prenom" placeholder="Prenom" required />
			</div>
			<div class="login-container">
				<span class="required-field">*</span>
				<input id="inscription-email" class="login-input" type="email" name="email" placeholder="Email" required />
			</div>
			<div class="login-container">
				<span class="required-field">*</span>
				<input id="inscription-mdp" class="login-input" type="password" name="mdp" placeholder="Mot de passe" required />
			</div>
			<div class="login-container">
				<span class="required-field">*</span>
				<input id="inscription-mdp2" class="login-input" type="password" name="mdp2" placeholder="Confirmer le Mot de passe" required />
			</div>
			<div class="login-container">
				<input id="inscription-tel" class="login-input" type="text" name="tel" placeholder="N° de téléphone" />
			</div>
			<div class="login-container">
				<input id="inscription-adresse" class="login-input" type="text" name="code_postal" placeholder="Code Postal" />
			</div>
			<div class="login-container">
				<label for="inscription-age" class="login-label">Date de naissance</label>
				<input id="inscription-age" class="login-input" type="date" name="date_naissance" placeholder=" " min="1900-01-01" max="3000-12-31" />
			</div>
			
			<div class="login-btns">
				<button type="reset" class="reset-btn">Annuler</button>
				<button type="submit" class="confirm-btn" name="action" value="inscrire">Confirmer</button>
			</div>

			<p class="required-field-legende">* Ces champs sont obligatoires</p>

			<input type="hidden" name="role" value="client" />

			</form>
		</div>
	</div>


	<div class="connexion_bg">
		<div class="logo-inscription"></div>
		<img src="http://localhost/ClientLeger/public/img/bg_inscription.svg" />
		<div class="goto-inscription-connexion">
			<p>Déjà un compte?</p>
			<span>
				<a href="index.php?page=connexion">Se connecter</a>
			</span>
		</div>
	</div>
</div>