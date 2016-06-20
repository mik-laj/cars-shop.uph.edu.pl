<html>
<head>
    <?php if (!$this->section('head')): ?>
        <meta charset="utf-8">
        <title><?php echo $this->e($title)?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if (!$this->section('css')): ?>
            <link rel="stylesheet" href="/static/css/style.css">
            <?php if (!$this->section('add-css')): ?>
            <?php endif ?>
        <?php endif ?>
    <?php endif ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <header>
                <div class="header-title">Cars shop</div>
                <div class="header-lead">All the cars that you would like to have</div>
            </header>
        </div>
    </div>
    <div class="row">
        <aside class="col-3">
            <?php if ($this->section('sidebar')): ?>
                <?php echo $this->section('sidebar')?>
            <?php else: ?>
                <?php $this->insert('partials/default-sidebar')?>
            <?php endif ?>
        </aside>
        <main class="col-9">
            <?php echo $this->section('page')?>
        </main>
    </div>
    <footer class="row">
        <div class="col-12">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
        </div>
    </footer>
</div>
<?php if ($this->section('modal')): ?>
    <?php echo $this->section('modal')?>
<?php endif ?>
<?php if ($this->section('js')): ?>
    <?php echo $this->section('add-js')?>
<?php else: ?>
    <script src="/static/vendor/js/jquery-3.0.0.min.js"></script>
    <script src="/static/js/modal.js"></script>
    <?php if ($this->section('add-js')): ?>
        <?php echo $this->section('add-js')?>
    <?php endif ?>
<?php endif ?>
</body>
</html>
