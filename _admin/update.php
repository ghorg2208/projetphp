<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  $stmt = $db->prepare('UPDATE game SET title = ?, description = ?, price = ? WHERE id = ?');
  $stmt->execute([$title, $description, $price, $id]);

  header('Location: index.php');
  exit;
}

$id = $_GET['id'] ?? '';

if (!$id) {
  header('Location: index.php');
  exit;
}

$stmt = $db->prepare('SELECT title, description, price FROM game WHERE id = ?');
$stmt->execute([$id]);
$game = $stmt->fetch();

if (!$game) {
  header('Location: index.php');
  exit;
}
?>

<h1>Modifier un jeu</h1>

<form method="post">

  <div>
    <label for="title">Titre :</label>
    <input type="text" name="title" id="title" value="<?= $game['title'] ?>" required>
  </div>

  <div>
    <label for="description">Description :</label>
    <textarea name="description" id="description" required><?= $game['description'] ?></textarea>
  </div>

  <div>
    <label for="price">Prix :</label>
    <input type="number" name="price" id="price" value="<?= $game['price'] ?>" required>
  </div>

  <button type="submit">Modifier</button>
</form>
