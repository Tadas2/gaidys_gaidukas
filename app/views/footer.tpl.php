<div class="footer">
    <?php foreach ($view as $element): ?>
        <h3><?php print $element['name']; ?></h3>
        <h4>Call us:<?php print $element['contacts']; ?></h4>
    <?php endforeach; ?>
</div>
