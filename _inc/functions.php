<?php

session_start();

function connect($servername = "localhost", $username = "root", $password = "")
{

    try {
        $conn = new PDO("mysql:host=$servername;dbname=videogames", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

    return $conn;
}

?>

<?php

/*function prossessContactForm2():void
{
    if (isSubmitted()){
        echo 'formulaire soumis';
    }
}

function isSubmitted():bool
{
    return isset($_POST['submit']);
}*/


function processContactForm() {
  if (isset($_POST['submit'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

     // Store a notice message in session
     $_SESSION['notice'] = "Vous serez contacté dans les plus brefs délais";

     // Redirect to index.php
     header('Location: index.php');
     exit();


    return "formulaire soumie";
  }
}

function getSessionFlashMessage($key) {
    if (array_key_exists($key, $_SESSION)) {
      $message = $_SESSION[$key];
      unset($_SESSION[$key]);
      return $message;
    } else {
      return null;
    }
}


/*function isLong($string, $minLength = 10) {
    return strlen(trim($string)) >= $minLength;
}*/




function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}




function getRandomGames($limit = 3) {
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT * FROM game ORDER BY RAND() LIMIT :limit');
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllGames() {
    $pdo = connect();
    $stmt = $pdo->query('SELECT * FROM game');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGameById($id) {
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT * FROM game WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}




/*function processLoginForm() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['login'])) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = validateLoginForm(['email' => $email, 'password' => $password]);

        if (empty($errors)) {
            if (authenticateAdmin($email, $password)) {
                $_SESSION['admin'] = true;
                header('Location: admin.php');
                exit;
            } else {
                $errors[] = 'L\'email ou le mot de passe est incorrect';
            }
        }
    }
}*/

function processLoginForm() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['login'])) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = validateLoginForm(['email' => $email, 'password' => $password]);

        if (empty($errors)) {
            $admin = getAdminByEmail($email);
            if ($admin && authenticateAdmin($password, $admin['password'])) {
                $_SESSION['user'] = $admin['id'];
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['notice'] = 'Identifiants incorrects';
            }
        } else {
            $_SESSION['notice'] = implode('<br>', $errors);
        }
    }
}

function validateLoginForm($data) {
    $errors = [];

    if (empty($data['email'])) {
        $errors[] = 'L\'adresse email est requise';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'L\'adresse email est invalide';
    }

    if (empty($data['password'])) {
        $errors[] = 'Le mot de passe est requis';
    }

    return $errors;
}

function getAdminByEmail($email) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM admin WHERE email = ?');
    $stmt->execute([$email]);

    return $stmt->fetch();
}

function authenticateAdmin($email, $password) {
    $admin = getAdminByEmail($email);

    if (!$admin) {
        return false;
    }

    return password_verify($password, $admin['password']);
}



function getSessionData($key) {
    if (array_key_exists($key, $_SESSION)) {
        return $_SESSION[$key];
    } else {
        return null;
    }
}





