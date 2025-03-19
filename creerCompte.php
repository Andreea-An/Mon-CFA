<div class="center">
    <h1>Inscription</h1>
    <form action="../controller/eleveController.php" method="POST">

        <div class="text_field">
            Nom : <input type="text" name="nom" required>
        </div>

        <div class="text_field">
            Prénom : <input type="text" name="prenom" required>
        </div>

        <div class="text_field">
            Email : <input type="email" name="email" required>
        </div>

        <div class="text_field">
            Mot de Passe : <input type="text" name="mdp" required>
        </div>
        
        <input type="hidden" name="action" value="ajouter">
        <input type="submit" value="valider">
    </form>
</div>
