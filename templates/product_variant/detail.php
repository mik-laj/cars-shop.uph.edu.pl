<?php $this->layout('base', ['title' => $obj->name]) ?>

<?php $this->start('page') ?>
<h1>
    <?php echo $obj->name; ?>
    <small>
        <?php echo $obj->price; ?>
        <sub>
            BB
        </sub>
    </small>
    <?php if($auth->isAdmin()): ?>
    <small>
        <a href="<?php echo $obj->getAbsoluteEditUrl();?>" class="button">Edit</a>
        <form action="<?php echo $obj->getAbsoluteDeleteUrl();?>" class="form-inline" method="post">
            <button type="submit">Delete</button>
        </form>
    </small>
    <?php endif;?>
</h1>
<?php echo $obj->description; ?>

<?php if($auth->isLogged()):?>
    <form action="/order/create" method="get" id="variant-buy-form">
        <input type="hidden" name="product_id" value="<?php echo $obj->product_id;?>">
        <input type="hidden" name="variant_id" value="<?php echo $obj->id;?>">
        <button type="submit">Buy!</button>
    </form>
<?php else: ?>
    <p>Before placing an order you need to login.</p>
<?php endif; ?>

<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


