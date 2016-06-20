<div class="sidebar-section">
    <div class="sidebar-section__title">Categories:</div>
    <div class="sidebar-section__content">
        <ul class="list-unstyled">
        <?php foreach ($repos['category']->getAll() as $category):?>
            <li>
                <a href="<?php echo $category->getAbsoluteUrl();?>"><?php echo $category->name ;?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="sidebar-section">
    <div class="sidebar-section__title">Users:</div>
    <div class="sidebar-section__content">
        <?php if($auth->isLogged()): ?>
            <p><a href="/order/">Orders</a></p>
            <p><b>Nazwa: </b> <?php echo $auth->getUser()->name; ?></p>
            <p><b>Rola: </b> <?php echo $auth->getUser()->role; ?></p>
            <p><b>isAdmin:</b> <?php var_dump($auth->isAdmin()); ?></p>
            <p><b>isUser:</b> <?php var_dump($auth->isUser()); ?></p>
            <?php echo $this->fetch('user/logout-form')?>
        <?php else: ?>
            <?php echo $this->fetch('user/login-form')?>
            <a href="/user/create">Register form</a>
        <?php endif;?>
    </div>
</div>
