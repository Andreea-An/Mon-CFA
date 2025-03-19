<?php

$idEleve = $_SESSION['ID_Utilisateur'];

include ('../model/inscModel.php');
include('../bdd/bdd.php');

$insc = new Insc($bdd);
$allInsc = $insc->getInscByEleve($idEleve);

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Matière</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($allInsc)) {
        foreach ($allInsc as $inscription) {
            echo "<tr>";
            echo "<th scope='row'>" . htmlspecialchars($inscription['ID_Insc']) . "</th>";
            echo "<td>" . htmlspecialchars($inscription['Matiere']) . "</td>";
            echo "<td>" . htmlspecialchars($inscription['Date_Cours']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Aucune inscription trouvée.</td></tr>";
    }
    ?>
  </tbody>
</table>
