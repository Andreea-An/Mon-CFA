<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id'])) {
    header('Location: accueil.php');
    exit();
}

include('header.php');
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-5">
            <h2 class="display-4 mb-3">Connexion</h2>
            <p class="lead text-muted">Choisissez votre type de compte pour vous connecter</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-user-graduate fa-4x text-primary"></i>
                    </div>
                    <h3 class="card-title mb-3">Élève</h3>
                    <p class="card-text text-muted mb-4">
                        Accédez à vos cours et gérez vos inscriptions
                    </p>
                    <a href="connexion_eleve.php" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Connexion Élève
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-chalkboard-teacher fa-4x text-primary"></i>
                    </div>
                    <h3 class="card-title mb-3">Professeur</h3>
                    <p class="card-text text-muted mb-4">
                        Gérez vos cours et suivez vos élèves
                    </p>
                    <a href="connexion_prof.php" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Connexion Professeur
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-10 text-center">
            <p class="mb-0">
                Pas encore de compte ? 
                <a href="inscription.php" class="text-primary">Créer un compte élève</a>
            </p>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
