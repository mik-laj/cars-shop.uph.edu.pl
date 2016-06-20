<?php $this->layout('base', ['title' => 'Edycja wariantu']) ?>

<?php $this->start('page') ?>
<h1>Edit a variant</h1>
<form action="<?php echo $obj->getAbsoluteEditUrl(); ?>" method="post" class="form">
    <?php echo $this->fetch('product_variant/form', ['obj' => $obj]) ?>
    <button type="submit">Zapisz</button>
</form>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


