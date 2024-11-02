<?php
require_once 'Utilities.php';

use MieClassi\Utilities;

// Carica i dati dal JSON
$data = Utilities::loadJSON('data/servizi.json');
$services = $data['services'];
$image = $data['image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Services of Branding, Illustration and Web Design">
    <title>Carol Sassano - Servizi offerti</title>
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body>

    <?php include 'menu.php'; ?> 

    <div class="container-gallery">
        <div class="image-text-pair">
            <div class="image-item">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Front end and graphic design services">
            </div>
            <div id="D4BASE" class="text-item">
                <?php foreach ($services as $service): ?>
                    <h1>//<?php echo htmlspecialchars($service['title']); ?></h1>
                    <p><?php echo htmlspecialchars($service['description']); ?></p>
                <?php endforeach; ?>
            </div>
        </div> 
    </div> 

    <?php include 'footer.php'; ?>

</body>
</html>
