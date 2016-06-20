<div class="input-group">
    <label for="field_name">Name:</label>
    <input type="text" name="name" id="field_name" value="<?php if(isset($obj) && isset($obj->name)) echo $obj->name; ?>">
</div>
<div class="input-group">
    <label for="field_description">Description:</label>
    <textarea name="description" id="field_description" cols="30" rows="10"><?php if(isset($obj) && isset($obj->description)) echo $obj->description; ?></textarea>
</div>
<div class="input-group">
    <label for="field_image_url">Image url:</label>
    <input type="text" name="name" id="field_name" value="<?php if(isset($obj) && isset($obj->image_url)) echo $obj->image_url; ?>">
</div>
<div class="input-group">
    <label for="field_category">Category:</label>
    <select name="category_id" id="field_category">
        <?php
        $categories = $repos['category']->getCategoryKeyPair();
        foreach ($categories as $id => $name):?>
            <option
                <?php if(isset($obj) && isset($obj->category_id) && $obj->category_id == $id) echo "selected "; ?>
                value="<?php echo $id;?>"><?php echo $name;?></option>
        <?php endforeach; ?>
    </select>
</div>

