<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('map.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>

<?= $this->Flash->render() ?>

<?= $this->fetch('content') ?>



<?php echo $this->element('scripts'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= \Cake\Core\Configure::read('apiKeyGoogleMaps'); ?>&callback=initMap" async defer></script>
</body>
</html>





