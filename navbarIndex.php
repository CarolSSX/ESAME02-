<?php
require_once 'Utilities.php';
$menuData = \MieClassi\Utilities::loadJSON('data/menu.json');
?>

<nav class="navbar">
    <div class="grid-container">
        <!-- Tile 1: Logo -->
        <div class="grid-item logo">
            <img src="assets/img/logomywebsite.png" alt="Logo">
        </div>

        <!-- Tiles nav-bar 
         Ho deciso, di avere una navbar particolare per l'index e un menù dropdown per quanto riguarda le pagine.
         Entrambe prendono dati da file json-->

        <?php if ($menuData && isset($menuData['menu'])): ?>
            <?php foreach ($menuData['menu'] as $item): ?>
                <?php if ($item['title'] !== 'Home'): // NESSUN LINK HOME NELL'INDEX 
                ?>
                    <div class="grid-item gallery">
                        <a href="<?php echo htmlspecialchars($item['link']); ?>">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="grid-item gallery">
                <p>No menu items found.</p>
            </div>
        <?php endif; ?>
    </div>
</nav>