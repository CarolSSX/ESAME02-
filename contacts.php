<?php

// CONTROLLO SESSIONE, il messaggio di successo viene salvato in sessione e poi cancellato
session_start();

require_once 'Utilities.php'; 

use MieClassi\Utilities; 

// POST METHOD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // ORGANIZZA DATI IN ARRAY
    $dataToSave = [
        "name" => $name,
        "email" => $email,
        "message" => $message,
        "submitted_at" => date('Y-m-d H:i:s') // TIMESTAMP
    ];
    
    //  Passa $dataToSave alla funzione
    if (Utilities::scritturaDataJson('data/form_data.json', $dataToSave, false)) {
        $_SESSION['form_success'] = "Thank you for your message!";

    // RICARICO LA PAGINA PER RINVIARLA
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $_SESSION['form_success'] = "There was an error saving your message.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Contacts form" content="Contact page for Carol Sassano">
    <title>Carol Sassano</title>
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body>

    <header>
        <div></div>
        <?php include 'menu.php'; ?>
    </header>

    <main>
        <div class="scroll-container-form">
            <section class="form-container">
                <h2>Request Information</h2>
                <form action="" method="post"> 
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button class="submit-btn" type="submit">Submit</button>
                </form>
                <?php if (isset($_SESSION['form_success'])) {
                    echo "<p>" . htmlspecialchars($_SESSION['form_success']) . "</p>";

                    // RIMUOVE IL MESSAGGIO DALLA SESSIONE
                    unset($_SESSION['form_success']);
                } ?>
            </section>

            <section class="contact-info">
              <h3>Contact Information</h3>
              <p>Email me! <a href="mailto:carolsaxxx@gmail.com">carolsaxxx@gmail.com</a></p>
              <p>Or see me here:</p>
              <ul>
                  <li><a href="https://www.linkedin.com/in/carol-sassano-4731152b0/" target="_blank">Linkedin</a></li>
                  <li><a href="https://www.behance.net/carolsassano" target="_blank">Behance</a></li>
              </ul>
          </section>
        </div>
    </main>

<footer>
 <?php include 'footer.php'; ?>
</footer>

</body>
</html>
