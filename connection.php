<form method="POST" action="../controller/eleveController.php">
    <label>Email</label>
    <input type="email" id="email" name="email" required>
    <label>Mot de passe</label>
    <input type="password" id="mdp" name="mdp" required>
    <input type="hidden" name="action" value="connexion">
    <button type="submit" name="connexion">Se connecter</button>
</form>
