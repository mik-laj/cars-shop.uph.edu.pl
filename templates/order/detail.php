<?php $this->layout('base', ['title' => "Order no: " . $obj->id]) ?>

<?php $this->start('page') ?>
<h1>
    Order No: <?php echo $obj->id;?>
    <?php if($auth->isAdmin()): ?>
    <small>
        <a href="<?php echo $obj->getAbsoluteEditUrl();?>">Edytuj</a>
    </small>
    <?php endif; ?>
</h1>
<table>
    <tr>
        <th>Value</th>
        <td><?php echo $obj->price;?></td>
    </tr>
    <tr>
        <th>Note</th>
        <td><?php echo $obj->note;?></td>
    </tr>
    <tr>
        <th>Comment: </td>
        <td><?php echo $obj->comment;?></td>
    </tr>
    <tr>
        <th>Adress</td>
        <td><?php echo $obj->line_1;?></td>
    </tr>
    <tr>
        <th></td>
        <td><?php echo $obj->line_2;?></td>
    </tr>
    <tr>
        <th></td>
        <td><?php echo $obj->line_3;?></td>
    </tr>
    <tr>
        <th>City</td>
        <td><?php echo $obj->city;?></td>
    </tr>
    <tr>
        <th>Zip/Province</td>
        <td><?php echo $obj->zip_or_province;?></td>
    </tr>
    <tr>
        <th>Country</td>
        <td><?php echo $obj->country;?></td>
    </tr>
<table>
<table>
    <thead>
        <th>Product:</th>
        <th>Variant:</th>
        <th>Value:</th>
    </thead>
</table>
<?php foreach($obj_list as $order_item):?>
    <tr>
        <td>
            <a href="/product/<?php echo $order_item['product_id'];?>">
                <?php echo $order_item['product_name'];?>
            </a>
        </td>
        <td>
            <a href="/product/<?php echo $order_item['product_id'];?>/<?php echo $order_item['variant_id'];?>">
                <?php echo $order_item['variant_name'];?>
            </a>
        </td>
        <td><?php echo $order_item['order_item_price'];?></td>
    </tr>
<?php endforeach;?>
</ul>


<?php $this->stop() ?>
