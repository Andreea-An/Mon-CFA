<?php
session_start();
require_once '../controller/coursController.php';
$coursController = new CoursController();
$cours = $coursController->getAllCours();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours Disponibles - CFA Insta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="accueil.php">CFA Insta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="accueil.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cours.php">Cours</a>
                    </li>
                    <?php if(isset($_SESSION['utilisateur_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="mes_reservations.php">Mes Réservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../controller/utilisateurController.php?action=deconnexion">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-custom ms-2" href="inscription.php">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-3">Nos Cours Disponibles</h1>
                    <p class="lead text-muted">Découvrez notre sélection de cours et réservez votre place dès maintenant.</p>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchCours" placeholder="Rechercher un cours...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="py-4">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-3">
                    <select class="form-select" id="filterMatiere">
                        <option value="">Toutes les matières</option>
                        <option value="Mathématiques">Mathématiques</option>
                        <option value="Physique">Physique</option>
                        <option value="Informatique">Informatique</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterNiveau">
                        <option value="">Tous les niveaux</option>
                        <option value="Débutant">Débutant</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Avancé">Avancé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterDate">
                        <option value="">Toutes les dates</option>
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary w-100" id="resetFilters">
                        <i class="fas fa-undo me-2"></i>Réinitialiser
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="py-5">
        <div class="container">
            <div class="row" id="coursesList">
                <?php foreach($cours as $c): ?>
                <div class="col-md-4 mb-4">
                    <div class="card course-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($c['Matiere']); ?></h5>
                                <span class="badge bg-primary"><?php echo htmlspecialchars($c['Niveau_Requis']); ?></span>
                            </div>
                            <div class="course-info mb-3">
                                <div>
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <?php echo date('d/m/Y', strtotime($c['Date_Cours'])); ?>
                                </div>
                                <div>
                                    <i class="far fa-clock me-2"></i>
                                    <?php echo htmlspecialchars($c['Duree']); ?> min
                                </div>
                            </div>
                            <p class="card-text"><?php echo htmlspecialchars($c['Description']); ?></p>
                            <div class="mt-3">
                                <div class="progress mb-2">
                                    <?php 
                                    $places_prises = $coursController->getPlacesPrises($c['ID_Cours']);
                                    $pourcentage = ($places_prises / $c['Capacite_Max']) * 100;
                                    ?>
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $pourcentage; ?>%">
                                        <?php echo $places_prises; ?>/<?php echo $c['Capacite_Max']; ?> places
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="detail_cours.php?id=<?php echo $c['ID_Cours']; ?>" class="btn btn-primary btn-custom w-100">
                                <i class="fas fa-info-circle me-2"></i>Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>CFA Insta</h4>
                    <p>La plateforme de réservation de cours du CFA Insta.</p>
                </div>
                <div class="col-md-4">
                    <h4>Liens Utiles</h4>
                    <ul class="footer-links">
                        <li><a href="cours.php">Tous les cours</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="mentions_legales.php">Mentions légales</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Contact</h4>
                    <p>Email: contact@cfainsta.fr</p>
                    <p>Téléphone: 01 23 45 67 89</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction de recherche
        document.getElementById('searchCours').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const courses = document.querySelectorAll('.course-card');
            
            courses.forEach(course => {
                const title = course.querySelector('.card-title').textContent.toLowerCase();
                const description = course.querySelector('.card-text').textContent.toLowerCase();
                
                if (title.includes(searchValue) || description.includes(searchValue)) {
                    course.parentElement.style.display = '';
                } else {
                    course.parentElement.style.display = 'none';
                }
            });
        });

        // Réinitialisation des filtres
        document.getElementById('resetFilters').addEventListener('click', function() {
            document.getElementById('filterMatiere').value = '';
            document.getElementById('filterNiveau').value = '';
            document.getElementById('filterDate').value = '';
            document.querySelectorAll('.course-card').forEach(course => {
                course.parentElement.style.display = '';
            });
        });

        // Application des filtres
        function applyFilters() {
            const matiere = document.getElementById('filterMatiere').value.toLowerCase();
            const niveau = document.getElementById('filterNiveau').value.toLowerCase();
            const date = document.getElementById('filterDate').value;
            
            const courses = document.querySelectorAll('.course-card');
            
            courses.forEach(course => {
                let show = true;
                
                if (matiere && !course.querySelector('.card-title').textContent.toLowerCase().includes(matiere)) {
                    show = false;
                }
                
                if (niveau && !course.querySelector('.badge').textContent.toLowerCase().includes(niveau)) {
                    show = false;
                }
                
                // Logique de filtrage par date à implémenter selon vos besoins
                
                course.parentElement.style.display = show ? '' : 'none';
            });
        }

        document.getElementById('filterMatiere').addEventListener('change', applyFilters);
        document.getElementById('filterNiveau').addEventListener('change', applyFilters);
        document.getElementById('filterDate').addEventListener('change', applyFilters);
    </script>
</body>
</html>
