<?php $this->layout('base', ['title' => 'Formularz logowania']) ?>

<?php $this->start('page') ?>
<h1>
    Login form
</h1>

<?php echo $this->fetch('user/login-form')?>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


