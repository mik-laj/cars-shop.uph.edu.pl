<?php $this->layout('base', ['title' => 'Create product']) ?>

<?php $this->start('page') ?>
<h1>Create product</h1>
<form action="/product/create" method="post" class="form">
    <?php echo $this->fetch('product/form') ?>
    <button type="submit">Save</button>
</form>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar') ?>
<?php $this->stop() ?>


