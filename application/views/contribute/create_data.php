<p><strong>Instructions:</strong>
You may add things and tags using this form. Adding a thing along with tags will generate a relationship b/w the thing and the tag along with a single vote applied to each tag. If you input one or more tags without specifying a thing, the tag(s) will be inserted without a relationship.</p>
<form action="contribute/create_data_ajax" method="post" />
<div>Thing: <input type="text" name="thing" id="thing-field" class="data-input" value="<?php echo set_value('thing'); ?>" /></div>
<div>Tags: <input type="text" name="tag[]" id="tag-field" class="data-input" value="<?php echo set_value('tag[]'); ?>" /><br /><input type="text" name="tag[]" id="tag-field" class="data-input" value="<?php echo set_value('tag[]'); ?>" /></div>
<div><a href="#">Add another tag</a></div>
<input type="submit" name="submit" value="Submit" />
</form>