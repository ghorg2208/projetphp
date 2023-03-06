<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $id = $_POST['id'];

  $stmt = $db->prepare('DELETE FROM game WHERE id = ?');
  $stmt->execute([$id]);

  header('Location: index.php');
  exit;
}

if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = $_GET['id'];

$stmt = $db->prepare('SELECT * FROM game WHERE id = ?');
$stmt->execute([$id]);

$game = $stmt->fetch();

if (!$game) {
  header('Location: index.php');
  exit;
}
?>

<h1>Supprimer le jeu "<?php echo htmlspecialchars($game['title']) ?>" ?</h1>

<form method="post">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($game['id']) ?>">
  <button type="submit">Confirmer la suppression</button>
</form>
