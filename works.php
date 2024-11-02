<?php
// Carico i dati dal JSON
$worksData = file_get_contents('data/works.json');
$worksArray = json_decode($worksData, true);
$works = $worksArray['works'];

// Accedere ai dati tramite l'id
$worksById = [];
foreach ($works as $work) {
    $worksById[$work['id']] = $work;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Works" content="Projects and works by Carol Sassano">
    <title>Carol Sassano - Works</title>
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body id="works-page">

    <div>
    <?php include 'menu.php'; ?>
    </div>

    <div class="scroll-container">
        <div class="grid-container">
            <div class="grid-item logo">
                <a href="index.php" style="display: flex; width: 100%; height: 100%;">
                    <img src="assets/img/logomywebsite.png" alt="Logo Carol Sassano">
                </a>
            </div>

            <?php
            $totalTiles = 18; // numero totale di tiles (incluse quelle vuote)
            $emptyTiles = [3, 8, 15]; // posizioni delle tiles vuote

            // Array di id specifico per l'ordine delle tile visualizzate
            $orderedIds = [1, 2, 3, 4, 5, 6, 7]; 

            // Ciclo per le tile
            foreach (range(1, $totalTiles) as $position):
                if (in_array($position, $emptyTiles)): // Se è una tile vuota, lasciala vuota
                    echo '<div class="grid-item empty-tile"></div>';
                elseif (!empty($orderedIds)): // Se c'è un id
                    $id = array_shift($orderedIds); // Estrae il primo id dall'elenco
                    $work = $worksById[$id]; // Ottiene i dati dal JSON 
            ?>
                    <div class="grid-item">
                        <img src="<?php echo $work['image']; ?>" alt="<?php echo htmlspecialchars($work['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <a href="details.php?id=<?php echo $work['id']; ?>" style="position: absolute; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <h1 class="text-mq"><?php echo htmlspecialchars($work['title']); ?><br>//<?php echo $work['year']; ?></h1>
                        </a>
                    </div>
                    <div class="grid-item">
                        <h1 class="text-mq"><?php echo htmlspecialchars($work['title']); ?><br>//<?php echo htmlspecialchars($work['type']); ?><br>//<?php echo $work['year']; ?></h1> 
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>
