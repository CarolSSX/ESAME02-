<?php

namespace MieClassi;

session_start();

require_once 'Utilities.php'; 

use MieClassi\Utilities; 

// Inizializza variabili per imessaggi di errore 
$errorMessages = [];
$formData = [
    "name" => "",
    "email" => "",
    "message" => ""
];

// POST METHOD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Raccogliere i dati
    $formData['name'] = htmlspecialchars(trim(Utilities::getFormData('name')));
    $formData['email'] = htmlspecialchars(trim(Utilities::getFormData('email')));
    $formData['message'] = htmlspecialchars(trim(Utilities::getFormData('message')));

    // Validarli
    if (empty($formData['name'])) {
        $errorMessages['name'] = "Il nome è obbligatorio.";
    }
    if (empty($formData['email'])) {
        $errorMessages['email'] = "L'email è obbligatoria.";
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessages['email'] = "L'email non è valida.";
    }
    if (empty($formData['message'])) {
        $errorMessages['message'] = "Il messaggio è obbligatorio.";
    }

    // Se non ci sono errori, salva i dati
    if (empty($errorMessages)) {
        // ORGANIZZA DATI IN ARRAY
        $dataToSave = [
            "name" => $formData['name'],
            "email" => $formData['email'],
            "message" => $formData['message'],
            "submitted_at" => date('Y-m-d H:i:s') // TIMESTAMP
        ];
        
        // Passa i dati alla funzione scritturaDataJson
        if (Utilities::scritturaDataJson('data/form_data.json', $dataToSave, false)) {
            $_SESSION['form_success'] = "Thank you for your message!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $errorMessages['form'] = "There was an error saving your message.";
        }
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
    <style> 
    /* STILI PER ERRORI */
        .error {
            border: 2px solid red;
        }
        .error-message {
            color: red; 
            font-size: 0.9em;
        }
    </style>
</head>
<body>


<?php include 'menu.php'; ?>

<main>
    <div class="scroll-container-form">
        <section class="form-container">
            <h2>Request Information</h2>
            <form action="" method="post" novalidate> <!-- Nel validatore w3s, lo legge come un errore, ma lo aggiunto come da correzione esame -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($formData['name']); ?>" class="<?php echo isset($errorMessages['name']) ? 'error' : ''; ?>">
                <?php if (isset($errorMessages['name'])): ?>
                    <p class="error-message"><?php echo $errorMessages['name']; ?></p>
                <?php endif; ?>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($formData['email']); ?>" class="<?php echo isset($errorMessages['email']) ? 'error' : ''; ?>">
                <?php if (isset($errorMessages['email'])): ?>
                    <p class="error-message"><?php echo $errorMessages['email']; ?></p>
                <?php endif; ?>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required class="<?php echo isset($errorMessages['message']) ? 'error' : ''; ?>"><?php echo htmlspecialchars($formData['message']); ?></textarea>
                <?php if (isset($errorMessages['message'])): ?>
                    <p class="error-message"><?php echo $errorMessages['message']; ?></p>
                <?php endif; ?>

                <button class="submit-btn" type="submit">Submit</button>
            </form>
            <?php if (isset($_SESSION['form_success'])) {
                echo "<p>" . htmlspecialchars($_SESSION['form_success']) . "</p>";
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

<?php include 'footer.php'; ?>

</body>
</html>
