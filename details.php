<?php
// Carico i dati dal JSON
$worksData = file_get_contents('data/works.json');
$worksArray = json_decode($worksData, true);
$works = $worksArray['works'];

// Recupero l'ID dal query string
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    die("ID non fornito."); 
}

// Accedere ai dati tramite l'id
$worksById = [];
foreach ($works as $work) {
    $worksById[$work['id']] = $work;
}

// Controlla se l'ID è valido
if (!array_key_exists($id, $worksById)) {
    die("Lavoro non trovato."); 
}

$work = $worksById[$id]; // Prende l'id specifico
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($work['description']); ?>">
    <title><?php echo htmlspecialchars($work['title']); ?> - Carol Sassano</title>
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body>

<div>
    <?php include 'menu.php'; ?>
</div>
<!--IMMAGINI A SX-->
<div class="container-gallery">
    <div class="image-text-pair">
        <div class="image-item">
            <img src="<?php echo htmlspecialchars($work['image']); ?>" alt="<?php echo htmlspecialchars($work['title']); ?>">
        </div>
<!-- TESTI A DX -->        
        <div class="text-item">
            <h1><?php echo htmlspecialchars($work['title']); ?><br>PROJ<br>//<?php echo htmlspecialchars($work['year']); ?></h1>
            <p>//<?php echo htmlspecialchars($work['type']); ?></p>
            <p><?php echo htmlspecialchars($work['description']); ?></p> <!-- Viene mostrata ANCHE la descrizione-->
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
