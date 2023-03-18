<?php $titre = 'Salles'; ?>

<?php ob_start(); ?>
<?php foreach ($salles as $salle): ?>
    <h2><?= $salle['nom'] ?></h2>
    <hr />
<?php endforeach; ?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'template.php'; ?>