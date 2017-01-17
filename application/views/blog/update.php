<?php echo validation_errors(); ?>
<?php echo form_open('Dashboard/update/'.$blog_item['id']); ?>
<input type="input" name="title" value="<?php echo $blog_item['title'];?>" /><br />
<textarea name="content" class="ckeditor" rows="10" cols="40"><?php echo $blog_item['content'];?></textarea><br />
<input type="hidden" name="id" value="<?php echo $blog_item['id'];?>"/>
<input type="submit" name="submit" value="Edit the article" />
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
</script>
</form>
