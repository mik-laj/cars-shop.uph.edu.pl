<?php $this->layout('base', ['title' => 'Order list']) ?>

<?php $this->start('page') ?>
    <h1>
        Order list
    </h1>
    <table>
        <thead>
            <tr>
                <th>ID: </th>
                <th>Value:</th>
                <th>Note:</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
    <?php foreach($obj_list as $obj):?>
        <tr>
            <td>
                <?php echo $obj->id;?>
            </td>
            <td>
                <?php echo $obj->price;?>
            </td>
            <td>
                <?php echo $obj->note;?>
            </td>
            <td>
                <a href="<?php echo $obj->getAbsoluteUrl();?>">Szczegóły</a>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


