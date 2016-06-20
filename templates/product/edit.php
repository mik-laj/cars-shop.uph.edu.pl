<?php $this->layout('base', ['title' => 'Edit product']) ?>

<?php $this->start('page') ?>
<h1>Edit product</h1>
<form action="<?php echo $obj->getAbsoluteEditUrl(); ?>" method="post" class="form">
    <?php echo $this->fetch('product/form', ['obj' => $obj]) ?>
    <button type="submit">Save</button>
</form>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


