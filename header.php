<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFA Insta - Formation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            padding: 1rem 0;
        }
        .navbar-brand img {
            max-height: 40px;
        }
        .card {
            border: none;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="accueil.php">
                <img src="../assets/images/logo.png" alt="CFA Insta" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="accueil.php">Accueil</a>
                    </li>
                    <?php if (isset($_SESSION['ID_Utilisateur'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="mes_reservations.php">Mes réservations</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="navbar-nav">
                    <?php if (!isset($_SESSION['ID_Utilisateur'])): ?>
                        <a class="nav-link" href="inscription.php">Inscription</a>
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    <?php else: ?>
                        <span class="nav-link text-muted">
                            <i class="fas fa-user me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['prenom'] ?? ''); ?>
                        </span>
                        <a class="nav-link text-danger" href="deconnexion.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
