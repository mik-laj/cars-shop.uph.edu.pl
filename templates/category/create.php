<?php $this->layout('base', ['title' => 'Create category']) ?>

<?php $this->start('page') ?>
<h1>Create category</h1>
<form action="/category/create" method="post" class="form">
    <?php echo $this->fetch('category/form') ?>
    <button type="submit">Save</button>
</form>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar') ?>
<?php $this->stop() ?>


