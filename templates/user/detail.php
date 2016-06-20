<?php $this->layout('base', ['title' => $obj->name]) ?>

<?php $this->start('page') ?>
<h1>
    <?php echo $obj->name; ?>
</h1>

<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


