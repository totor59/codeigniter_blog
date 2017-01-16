
<p><?php echo $blog_item['content'];?></p>
<br>
<a href="<?php echo base_url().'blog/'; ?>">BACK TO BLOG INDEX</a>
<br>
<?php
//Si l'utilisateur est administrateur on affiche les boutons EDIT et DELETE
if(($is_admin) OR ($is_owner)):
  echo form_open('blog/update/'.$blog_item['id']);
  echo form_submit('submit','Edit');
  echo form_close();
  echo form_open('blog/delete/'.$blog_item['id']);
  echo form_submit('submit','Delete');
  echo form_close();
endif;
