<?php $this->layout('base', ['title' => 'List variant']) ?>

<?php $this->start('page') ?>
    <h1>
        List variant
        <?php if($auth->isAdmin()): ?>
        <small>
            <a href="/product/<?php echo $product_id; ?>/create-variant" class="button">Add</a>
        </small>
        <?php endif;?>
    </h1>
    <ul>
    <?php foreach($obj_list as $obj):?>
        <li>
            <a href="<?php echo $obj->getAbsoluteUrl();?>"><?php echo $obj->name; ?></a>
        </li>
    <?php endforeach;?>
    </ul>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


