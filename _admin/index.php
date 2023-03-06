<?php

require_once 'config.php';

$stmt = $db->query('SELECT * FROM game');
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Liste des jeux</h1>

<table>
  <tr>
    <th>ID</th>
    <th>titre</th>
    <th>description</th>
    <th>prix</th>
    <th>image</th>
  </tr>
  <?php foreach ($games as $game): ?>
  <tr>
    <td><?= $game['id'] ?></td>
    <td><?= $game['title'] ?></td>
    <td><?= $game['description'] ?></td>
    <td><?= $game['price'] ?></td>
    <td><img src="/img/<?= $game['poster'] ?>" width="50"></td>

    <td>
      <a href="update.php?id=<?= $game['id'] ?>">Modifier</a>
      <a href="delete.php?id=<?= $game['id'] ?>">Supprimer</a>
    </td>
  </tr>
  <?php endforeach ?>
</table>

<a href="create.php">Créer un nouveau jeu</a>






</html>

