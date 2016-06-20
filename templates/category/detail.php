<?php $this->layout('base', ['title' => $obj->name]) ?>

<?php $this->start('page') ?>
<h1>
    <?php echo $obj->name; ?>
    <?php if($auth->isAdmin()): ?>
    <small>
        <a href="<?php echo $obj->getAbsoluteEditUrl();?>" class="button">Edit</a>
        <form action="<?php echo $obj->getAbsoluteDeleteUrl();?>" class="form-inline" method="post">
            <button type="submit">Delete</button>
        </form>
    </small>
    <?php endif; ?>
</h1>


<ul class="list-unstyled">
    <?php foreach($obj_list as $obj):?>
        <li>
            <div class="media">
                <div class="media__image">
                    <a href="<?php echo $obj->getAbsoluteUrl();?>">
                        <img src="<?php echo $obj->image_url; ?>" alt="<?php echo $obj->name; ?>">
                    </a>
                </div>
                <div class="media__description">
                    <h2>
                        <a href="<?php echo $obj->getAbsoluteUrl();?>"><?php echo $obj->name; ?></a>
                    </h2>
                    <p><?php echo $this->batch($obj->description, 'strip_tags|truncate');?>[...]</p>
                </div>
            </div>
        </li>
    <?php endforeach;?>
</ul>


<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


