<?php $this->layout('base', ['title' => 'Edit cateogry']) ?>

<?php $this->start('page') ?>
<h1>Edit cateogry</h1>
<form action="<?php echo $obj->getAbsoluteEditUrl(); ?>" method="post" class="form">
    <?php echo $this->fetch('category/form', ['obj' => $obj]) ?>
    <button type="submit">Update</button>
</form>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


