<?php $this->layout('base', ['title' => 'User list']) ?>

<?php $this->start('page') ?>
    <h1>
        User list
        <small><a href="/category/create" class="button">Create</a></small>
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


