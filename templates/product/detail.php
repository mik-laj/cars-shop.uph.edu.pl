<?php $this->layout('base', ['title' => $obj->name]) ?>

<?php $this->start('page') ?>
<h1>
    <?php echo $obj->name; ?>
    <?php if($auth->isAdmin()): ?>
    <small>
        <a href="<?php echo $obj->getAbsoluteEditUrl();?>" class="button">Edit</a>
        <a href="<?php echo $obj->getAbsoluteVaraintCreateUrl();?>" class="button" >Add varaint</a>
        <form action="<?php echo $obj->getAbsoluteDeleteUrl();?>" class="form-inline" method="post">
            <button type="submit">Delete</button>
        </form>
    </small>
    <?php endif; ?>
</h1>
<div>
    <img src="<?php echo $obj->image_url; ?>" alt="<?php echo $obj->name; ?>">
</div>
Warianty:
<ul id="js-variant-list">
<?php foreach($obj_list as $variant):?>
    <li>
        <a href="<?php echo $variant->getAbsoluteUrl();?>" data-api-url="<?php echo $variant->getAbsoluteApiUrl();?>"><?php echo $variant->name; ?></a>
    </li>
<?php endforeach;?>
</ul>
<?php echo $obj->description; ?>

<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>

<?php $this->start('modal') ?>
    <div class="modal__backdrop" id="modal-product-varaint">
        <div class="modal">
            <div class="modal__header">
                <div class="pull-right"><a href="#" class="modal__close">X</a></div>
                <div class="modal__title">Product's variant description</div>
            </div>
            <div class="modal__content">
                <h2>
                    <span id="variant-name"></span>
                    <small>
                        <span id="variant-price"></span><sub>BB</sub>
                    </small>
                </h2>
                <div id="variant-description">

                </div>
                <?php if($auth->isLogged()):?>
                    <form action="/order/create" method="get" id="variant-buy-form">
                        <input type="hidden" name="product_id" value="">
                        <input type="hidden" name="variant_id" value="">
                        <button type="submit">Kup!</button>
                    </form>
                <?php else: ?>
                    <p>Before placing an order you need to login.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $this->stop() ?>

<?php $this->start('add-js') ?>
<script type="text/javascript">
    (function ($){
        var list = $('#js-variant-list');
        var $modal = $('#modal-product-varaint');
        list.on('click', 'a', function (ev){
            ev.preventDefault();
            var $link = $(this);
            $.ajax({
                url: $link.data('api-url'),
                type: 'GET',
                dataType: 'json'
            })
            .done(function(response) {
                var data = response.data;
                $modal.modal();
                $modal.find('#variant-description').html(data.description);
                $modal.find('#variant-name').text(data.name);
                // $modal.find('#variant-price').text((data.price/100).toFixed());
                $modal.find('#variant-price').text(data.price);
                $modal.find('#variant-buy-form [name="variant_id"]').val(data.id);
                $modal.find('#variant-buy-form [name="product_id"]').val(data.product_id);
            })
            .fail(function() {
                document.location = $link.prop('target');
            })
            .always(function() {
                console.log("complete");
            });

        })
    }) (jQuery);
</script>
<?php $this->stop() ?>
