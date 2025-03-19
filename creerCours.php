<div class="center">
    <h1>Inscription</h1>
    <form action="../controller/coursController.php" method="POST">

        <div class="text_field">
            Matière : <input type="text" name="matiere" required>
        </div>

        <div class="text_field">
            Date : <input type="date" name="dateCours" required>
        </div>

        <input type="hidden" name="cours" value="ajouter">
        <input type="submit" value="valider">
    </form>
</div>
