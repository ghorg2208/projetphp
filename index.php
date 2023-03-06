<?php
    
    require_once '_inc/functions.php';
    require_once '_inc/header.php';
    require_once '_inc/nav.php';

?>

<main>
    <h1>Acceuil</h1><br /><br />

    <?php
        $message = getSessionFlashMessage('notice');
        if ($message !== null) {
        echo '<p>' . $message . '</p>';
        }
    ?>

    <?php    
        $games = getRandomGames(3);

        // afficher les résultats dans un bloc HTML
        echo '<div class="game-list">';
        foreach ($games as $game) {
            echo '<div class="game-item">';
            echo '<h2>' . $game['title'] . '</h2>';
            echo '<img src="' . $game['poster'] . '" alt="' . $game['title'] . '">';
            echo '<p>Prix : ' . $game['price'] . ' €</p>';
            echo '<a href="game.php?id=' . $game['id'] . '">Consulter</a>';
            echo '</div>';
        }
        echo '</div>';
    ?>
</main>

<?php
    require_once '_inc/footer.php';

?>