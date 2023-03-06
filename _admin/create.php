<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Vérification et traitement de l'image uploadée
  if (isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] === UPLOAD_ERR_OK) {
      $filename = $image['name'];
      move_uploaded_file($image['tmp_name'], 'uploads/' . $filename);
    } else {
      die('Erreur lors de l\'upload de l\'image');
    }
  } else {
    die('Aucune image n\'a été uploadée');
  }

  $stmt = $db->prepare('INSERT INTO game (title, description, price, poster) VALUES (?, ?, ?, ?)');
  $stmt->execute([$title, $description, $price, $filename]);

  header('Location: index.php');
  exit;
}

?>

<h1>Créer un nouveau jeu</h1>

<form method="post" enctype="multipart/form-data">
  <label>
    Titre :
    <input type="text" name="title" required>
  </label>
  <br>
  <label>
    Description :
    <textarea name="description" required></textarea>
  </label>
  <br>
  <label>
    Prix :
    <input type="number" name="price" min="0" step="0.01" required>
  </label>
  <br>
  <label>
    Image :
    <input type="file" name="image" required>
  </label>
  <br>
  <button type="submit">Créer</button>
</form>
