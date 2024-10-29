<?php
require_once 'Utilities.php';
$menuData = \MieClassi\Utilities::loadJSON('data/menu.json');
?>
<!-- Menu Dropdown che permette la navigazione dinamica in tutte le pagine, sia per desktop che per altri dispositivi -->
<header>
    <div class="dropdown">
        <div class="button">Menu</div>
        <div class="dropdown-content">
            <?php if ($menuData && isset($menuData['menu'])): ?>
                <?php foreach ($menuData['menu'] as $item): ?>
                    <a href="<?php echo htmlspecialchars($item['link']); ?>">
                        <?php echo htmlspecialchars($item['title']); ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No menu items found.</p>
            <?php endif; ?>
        </div>
    </div>
</header>
