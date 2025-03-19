<?php 

include('header.php');

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch ($page) {

	case 'inscription':
		include('creerCompte.php');
		break;

	case 'connection':
		include('connection.php');
		break;

	case 'mesCours':
		include('mesCours.php');
		break;

	default:
		include('accueil.php');
		break;
}




?>