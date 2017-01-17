
<p><?php echo $blog_item['content'];?></p>
<br>
<a href="<?php echo base_url().'dashboard/'; ?>">BACK TO DASHBOARD</a>
<br>
<form method=POST action="<?php echo base_url().'dashboard/update/'.$blog_item['id']; ?>">
  <input type="submit" value="EDIT">
</form>
<form method="POST" action="<?php echo base_url().'dashboard/delete/'.$blog_item['id']; ?>">
  <input type="submit" value="DELETE">
</form>
