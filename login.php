<?php
    require_once '_inc/functions.php';
    require_once '_inc/header.php';
    require_once '_inc/nav.php';

    //session_start();

    //processLoginForm();

    $notice = getSessionFlashMessage('notice');

?>

<main>
    <h1>login</h1><br /><br />

    <?php if ($notice): ?>
        <p><?= $notice ?></p>
    <?php endif; ?>

    <div class="container">
  <h1>Connexion à l'interface d'administration</h1>

  <?php
  // Appeler la fonction processLoginForm
  processLoginForm();

  // Affiche un formulaire HTML avec deux champs de saisie pour l'email et le mot de passe
  ?>
  <form method="POST" action="">
    <div class="form-group">
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
  </form>
</div>

</main>

<?php
    require_once '_inc/footer.php';

?>