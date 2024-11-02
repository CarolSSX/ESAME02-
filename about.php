<?php
require_once 'Utilities.php';

use MieClassi\Utilities;

// Carica i dati del JSON
$data = Utilities::loadJSON('data/about.json');

$aboutData = $data['about'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($aboutData['description']); ?>">
    <title>Carol Sassano - About Me</title>
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body>

        <?php include 'menu.php'; ?>


    <main class="container-gallery">
        <div class="image-text-pair">
            <div class="image-item">
                <img src="<?php echo htmlspecialchars($aboutData['image']); ?>" alt="About Carol Sassano">
            </div>
            <div class="text-item">
                <h1><?php echo htmlspecialchars($aboutData['name']); ?></h1>
                <p><?php echo nl2br(htmlspecialchars($aboutData['description'])); ?></p>
            </div>
        </div>
    </main>


        <?php include 'footer.php'; ?>


</body>
</html>
