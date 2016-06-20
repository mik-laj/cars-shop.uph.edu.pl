<?php $this->layout('base', ['title' => 'Edit product']) ?>

<?php $this->start('page') ?>
<h1>Edit product</h1>
<form action="<?php echo $obj->getAbsoluteEditUrl(); ?>" method="post" class="form">
    <div class="input-group">
        <label for="field_note">Note:</label>
        <textarea name="note" id="field_note"><?php echo $obj->note; ?></textarea>
    </div>
    <button type="submit">Zapisz</button>
</form>
<?php $this->stop() ?>
