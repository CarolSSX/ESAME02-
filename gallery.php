<?php
// Carico i dati dal JSON
$worksData = file_get_contents('data/works.json');
$worksArray = json_decode($worksData, true);
$works = $worksArray['works'];
?>
<!-- ESAME 02 - <title>, <meta content= "" e <strong> sono usati per l'ottimizzazione del SEO-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Carol Sassano Projects Gallery">
    <title>Carol Sassano Projects Gallery</title>
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body>

    <div></div>
    <?php include 'menu.php'; ?>

<!--Visualizzazione su due colonne, + la descrizione da works.php-->
<div class="container-gallery">
    <?php foreach ($works as $work): ?>
        <div class="image-text-pair" id="work-<?php echo htmlspecialchars($work['id']); ?>"> <!-- Aggiunto ID qui -->
            <div class="image-item">
                <a href="<?php echo htmlspecialchars($work['link']); ?>">
                    <img src="<?php echo htmlspecialchars($work['image']); ?>" alt="<?php echo htmlspecialchars($work['title']); ?>">
                </a>
            </div>
            <div class="text-item"> 
                <h1><?php echo htmlspecialchars($work['title']); ?><br>PROJ<br>//<?php echo htmlspecialchars($work['year']); ?></h1>
                <p>//<?php echo htmlspecialchars($work['type']); ?></p>
                <p><?php echo htmlspecialchars($work['description']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    <?php include 'footer.php'; ?>

</body>
</html>
