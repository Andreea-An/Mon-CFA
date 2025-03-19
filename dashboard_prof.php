<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et est un professeur
if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'professeur') {
    header('Location: connexion_prof.php');
    exit();
}

require_once('../controller/coursController.php');

// Initialiser le contrôleur de cours
$coursController = new CoursController();
// Récupérer les cours du professeur
$prochainsCours = $coursController->getCoursParProfesseur($_SESSION['id']);

include('header.php');
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-4 mb-3">
                <i class="fas fa-chalkboard-teacher text-primary me-3"></i>
                Tableau de bord
            </h1>
            <p class="lead text-muted">
                Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="nouveau_cours.php" class="btn btn-success me-2">
                <i class="fas fa-plus-circle me-2"></i>Nouveau cours
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-primary mb-3">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="card-title h5 mb-3">Mes Cours</h3>
                    <p class="card-text text-muted mb-4">Gérez vos cours et créez de nouvelles sessions</p>
                    <a href="gestion_cours.php" class="btn btn-primary w-100">
                        <i class="fas fa-plus-circle me-2"></i>Gérer les cours
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-primary mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="card-title h5 mb-3">Mes Élèves</h3>
                    <p class="card-text text-muted mb-4">Consultez la liste des élèves inscrits à vos cours</p>
                    <a href="liste_eleves.php" class="btn btn-primary w-100">
                        <i class="fas fa-list me-2"></i>Voir les élèves
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="display-4 text-primary mb-3">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="card-title h5 mb-3">Planning</h3>
                    <p class="card-text text-muted mb-4">Consultez votre emploi du temps</p>
                    <a href="planning.php" class="btn btn-primary w-100">
                        <i class="fas fa-calendar-check me-2"></i>Voir le planning
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Mes prochains cours</h5>
                    <a href="gestion_cours.php" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list me-2"></i>Voir tous les cours
                    </a>
                </div>
                <div class="card-body">
                    <?php if (empty($prochainsCours)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="lead text-muted">Vous n'avez pas de cours programmés prochainement.</p>
                            <a href="nouveau_cours.php" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Créer un nouveau cours
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Matière</th>
                                        <th>Date</th>
                                        <th>Durée</th>
                                        <th class="text-center">Inscrits</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($prochainsCours as $cours): ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo htmlspecialchars($cours['Matiere']); ?></strong>
                                                <?php if (!empty($cours['Description'])): ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?php echo htmlspecialchars($cours['Description']); ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $date = new DateTime($cours['Date_Cours']);
                                                    echo $date->format('d/m/Y H:i');
                                                ?>
                                            </td>
                                            <td><?php echo $cours['Duree']; ?> min</td>
                                            <td class="text-center">
                                                <span class="badge bg-info">
                                                    <?php echo $cours['Nombre_Inscrits']; ?> élève(s)
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="modifier_cours.php?id=<?php echo $cours['ID_Cours']; ?>" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="liste_eleves.php?cours=<?php echo $cours['ID_Cours']; ?>" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-users"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="confirmerSuppression(<?php echo $cours['ID_Cours']; ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmerSuppression(coursId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
        window.location.href = `../controller/coursController.php?action=supprimer&id=${coursId}`;
    }
}
</script>

<?php include('footer.php'); ?>
