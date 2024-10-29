<?php

/**
 * 
 * Questa è stata la pagina più difficile da fare, perchè il layout grafico è molto particolare. 
 * Ho dovuto usare la geometria usando le tiles e specificando tutte le tiles vuote, in modo che sugli schermi grandi,
 * che mostrano 6 tiles alla volta, ci fossero comunque sempre le giuste coppie "immagine-testo".
 * Ho dovuto aggiungere degli stili inline per evitare di complicare ulteriormente il sass, in particolare per la parte 
 * che gestisce le background images.
 */

// Carico i dati dal JSON
$worksData = file_get_contents('data/works.json');
$worksArray = json_decode($worksData, true);
$works = $worksArray['works'];

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

<header>
    <div>
    <?php include 'menu.php'; ?>
    </div>
</header>

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

            for ($i = 0; $i < $totalTiles; $i++):
                if (in_array($i + 1, $emptyTiles)): // E' oppure no una empty-tile?
                    echo '<div class="grid-item empty-tile"></div>';
                elseif ($i < count($works)):
                    $work = $works[$i];
            ?>
                    <div class="grid-item">
                        <img src="<?php echo $work['image']; ?>" alt="<?php echo htmlspecialchars($work['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;"> <!-- stili inline -->
                        <a href="<?php echo $work['link']; ?>" style="position: absolute; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <h1><?php echo htmlspecialchars($work['title']); ?><br>//<?php echo $work['year']; ?></h1>
                        </a>
                    </div>
                    <div class="grid-item">
                        <h1><?php echo htmlspecialchars($work['title']); ?><br>//<?php echo htmlspecialchars($work['type']); ?><br>//<?php echo $work['year']; ?></h1>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>