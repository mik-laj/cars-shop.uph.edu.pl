<?php $this->layout('base', ['title' => 'Rejestracja']) ?>

<?php $this->start('page') ?>
<h1>Rejestracja</h1>
<div class="row">
    <div class="col-8 col-push-2">
        <form action="/user/create" method="post" class="form">
            <?php echo $this->fetch('user/form') ?>
            <button type="submit">Zapisz</button>
        </form>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar') ?>
<?php $this->stop() ?>


