<?php
    require_once '_inc/functions.php';
    require_once '_inc/header.php';
    require_once '_inc/nav.php';
?>


<main>
    <div class="container">
        <?php
            $id = $_GET['id'];

            // Récupération du jeu vidéo depuis la base de données
            $game = getGameById($id);

            if(!$game) {
                echo '<p>Ce jeu vidéo n\'existe pas.</p>';
            } else {
                
                echo '<h1>' . $game['title'] . '</h1>';
                echo '<img src="' . $game['poster'] . '" alt="' . $game['title'] . '">';
                echo '<p>' . $game['description'] . '</p>';
                echo '<p>Date de sortie : ' . (new DateTime($game['release_date']))->format('d/m/Y') . '</p>';
                echo '<p>Prix : ' . $game['price'] . ' €</p>';
            }
        ?>
    </div>
</main>



<?php
    require_once '_inc/footer.php';
?>