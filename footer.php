<?php
require_once 'Utilities.php';
$footerData = \MieClassi\Utilities::loadJSON('data/footer.json');
?>

<footer>
    <p>
        <?php
        if ($footerData && isset($footerData['footer']['text'])) {
            echo htmlspecialchars($footerData['footer']['text']);
        }
        ?>
    </p>
</footer>