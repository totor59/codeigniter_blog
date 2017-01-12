
<p><?php echo $blog_item['content'];?></p>
<br>
<a href="<?php echo base_url().'blog/'; ?>">BACK TO BLOG INDEX</a>
<br>
<form method=POST action="<?php echo base_url().'blog/update/'.$blog_item['slug']; ?>">
  <input type="hidden" name ='id' value="<?php echo $blog_item['id'];?>">
  <input type="submit" value="EDIT">
</form>
<form method="POST" action="<?php echo base_url().'blog/delete/'.$blog_item['slug']; ?>">
  <input type="hidden" name ='id' value="<?php echo $blog_item['id'];?>">
  <input type="submit" value="DELETE">
</form>
