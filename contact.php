<?php

    require_once '_inc/functions.php';
    require_once '_inc/header.php';
    require_once '_inc/nav.php';

    $message = processContactForm();

?>

<?php
if (isset($message)) {
  echo "<p>$message</p>";
}
?>

<?php
if (isset($_POST['submit'])) { // Vérifie si la clé "submit" existe dans la superglobale POST
    // Associe chaque clé de la superglobale POST à une variable PHP
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    //submissionDate prend la clé REQUEST_TIME de la superglobale SERVER
    $submissionDate = new DateTime();
    $submissionDate->setTimestamp($_SERVER['REQUEST_TIME']);

    $formattedDate = $submissionDate->format('d/m/Y H:i:s');
?>
    <!-- Affiche la saisie et la date de soumission -->
    <p> formulaire :</p>
    <form>
        <li>Prénom : <?php echo $firstname; ?></li>
        <li>Nom : <?php echo $lastname; ?></li>
        <li>Email : <?php echo $email; ?></li>
        <li>Sujet : <?php echo $subject; ?></li>
        <li>Message : <?php echo $message; ?></li>
        <li>Date de soumission : <?php echo $formattedDate; ?></li>
    </form>
<?php
}
?>

<!-- formulaire -->
<form method="POST">
    <label for="firstname">Prénom :</label>
    <input type="text" id="firstname" name="firstname" required>

    <label for="lastname">Nom :</label>
    <input type="text" id="lastname" name="lastname" required>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="subject">Sujet :</label>
    <input type="text" id="subject" name="subject" required>

    <label for="message">Message :</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit" name="submit">Envoyer</button>
</form>



<?php
    require_once '_inc/footer.php';
?>