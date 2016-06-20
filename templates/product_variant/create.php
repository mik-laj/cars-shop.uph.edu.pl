<?php $this->layout('base', ['title' => 'Creating variant']) ?>

<?php $this->start('page') ?>
<h1>Creating variant</h1>
<form action="/product/<?php echo $product_id; ?>/create-variant" method="post" class="form">
    <?php echo $this->fetch('product_variant/form') ?>
    <button type="submit">Save</button>
</form>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar') ?>
<?php $this->stop() ?>
