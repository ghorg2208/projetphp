<?php
    require_once '_inc/functions.php';
    require_once '_inc/header.php';
    require_once '_inc/nav.php';

?>

<div class="container">
  <div class="row">
    <?php
    $games = getAllGames();
    foreach ($games as $game) {
      echo '<div class="col-md-4">';
      echo '<div class="card mb-4 box-shadow">';
      echo '<img class="card-img-top" src="' . $game['poster'] . '" alt="' . $game['title'] . '">';
      echo '<div class="card-body">';
      echo '<h4 class="card-title">' . $game['title'] . '</h4>';
      echo '<h5 class="card-text">' . $game['price'] . ' €</h5>';
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="btn-group">';
      echo '<a href="game.php?id=' . $game['id'] . '" class="btn btn-sm btn-outline-secondary">Consulter</a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
    ?>
  </div>
</div>



<?php
    require_once '_inc/footer.php';
?>