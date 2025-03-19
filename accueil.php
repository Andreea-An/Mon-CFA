<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}

include('header.php');
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title mb-4">Bienvenue sur CFA Insta</h1>
                    
                    <div class="alert alert-success">
                        <i class="fas fa-user-check me-2"></i>
                        Vous êtes connecté en tant que : 
                        <strong><?php echo htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?></strong>
                        (<?php echo htmlspecialchars($_SESSION['email']); ?>)
                    </div>

                    <div class="mt-4">
                        <h2 class="h4 mb-3">Menu principal</h2>
                        <div class="list-group">
                            <?php if ($_SESSION['type'] === 'professeur'): ?>
                                <a href="dashboard_prof.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    Tableau de bord Professeur
                                </a>
                            <?php else: ?>
                                <a href="mes_cours.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-book me-2"></i>
                                    Mes cours
                                </a>
                                <a href="planning.php" class="list-group-item list-group-item-action">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Mon planning
                                </a>
                            <?php endif; ?>
                            <a href="deconnexion.php" class="list-group-item list-group-item-action text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Déconnexion
                            </a>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['debug'])): ?>
                    <div class="mt-4">
                        <h3 class="h5">Session Debug</h3>
                        <pre class="bg-light p-3 rounded"><?php print_r($_SESSION); ?></pre>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
