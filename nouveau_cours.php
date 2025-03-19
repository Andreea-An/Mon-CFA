<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et est un professeur
if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'professeur') {
    header('Location: connexion_prof.php');
    exit();
}

include('header.php');
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">
                        <i class="fas fa-plus-circle text-primary me-2"></i>Nouveau cours
                    </h2>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($_GET['success']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="../controller/coursController.php" method="post">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="prof_id" value="<?php echo $_SESSION['id']; ?>">

                        <div class="mb-3">
                            <label for="matiere" class="form-label">Matière <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="matiere" name="matiere" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="dateCours" class="form-label">Date et heure <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" id="dateCours" name="dateCours" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duree" class="form-label">Durée (en minutes) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="duree" name="duree" value="60" min="30" max="480" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="capacite" class="form-label">Capacité maximale</label>
                            <input type="number" class="form-control" id="capacite" name="capacite" value="30" min="1" max="100">
                            <div class="form-text">Nombre maximum d'élèves pouvant s'inscrire à ce cours.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="dashboard_prof.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Créer le cours
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Définir la date minimale au jour actuel
document.addEventListener('DOMContentLoaded', function() {
    var now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('dateCours').min = now.toISOString().slice(0,16);
});
</script>

<?php include('footer.php'); ?>
