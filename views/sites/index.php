<h1>Hello world</h1>

<?php if (!empty($_SESSION['user'])): ?>
    <?php dump($_SESSION['user']); ?>
<?php endif; ?>

