<?php echo validation_errors(); ?>

<?php echo form_open('Blog/update'); ?>

<label for="title">Title</label>
<input type="input" name="title" /><br />

<label for="content">Text</label>
<textarea name="content" class="ckeditor" rows="10" cols="40">Type your article here</textarea><br />
<input type="hidden" value="<?php echo $blog_item['id'];?>"/>
<input type="submit" name="submit" value="Create new article" />
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
</script>
</form>
