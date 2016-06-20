<div class="input-group">
    <label for="field_name">Name:</label>
    <input type="text" name="name" id="field_name" value="<?php if(isset($obj) && isset($obj->name)) echo $obj->name; ?>">
</div>
<div class="input-group">
    <label for="field_description">Description:</label>
    <textarea name="description" id="field_description" cols="30" rows="10"><?php if(isset($obj) && isset($obj->description)) echo $obj->description; ?></textarea>
</div>
<div class="input-group">
    <label for="field_price">Price:</label>
    <input type="number" name="name" id="field_price" value="<?php if(isset($obj) && isset($obj->price)) echo $obj->price; ?>">
</div>

