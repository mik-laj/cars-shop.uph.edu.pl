<?php $this->layout('base', ['title' => 'Placing an order']) ?>

<?php $this->start('page') ?>
<h1>Placing an order</h1>
<form action="/order/create" method="post" class="form">
    <div class="input-group">
        <label for="field_comment">Comment:</label>
        <textarea name="comment" id="field_comment"></textarea>
    </div>
    <p>
        <b>Address:</b>
    </p>
    <div class="input-group">
        <label for="field_comment">Street:</label>
        <input type="text" name="line_1" id="field_line1"/>
    </div>
    <div class="input-group">
        <input type="text" name="line_2" id="field_line2"/>
    </div>
    <div class="input-group">
        <input type="text" name="line_3" id="field_line3"/>
    </div>
    <div class="input-group">
        <label for="field_city">City:</label>
        <input type="text" name="city" id="field_city"/>
    </div>
    <div class="input-group">
        <label for="field_zip_or_province">Zip/Province:</label>
        <input type="text" name="zip_or_province" id="field_zip_or_province"/>
    </div>
    <div class="input-group">
        <label for="field_country">Country:</label>
        <select type="text" name="country" id="field_country">
            <option value="Poland" selected="">Poland</option>
            <option value="United Kingdom">United Kingdom</option>
        </select>
    </div>

    <input type="hidden" name="variant_id" value="<?php echo $variant_id; ?>">
    <button type="submit">Submit</button>
</form>
<?php $this->stop() ?>
