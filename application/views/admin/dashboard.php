<?php foreach ($blog as $blog_item): ?>

  <h3><?=$blog_item['title']// Titre de l'article ?></h3>
  <div class="main">
    <?=character_limiter($blog_item['content'], 256)// Extrait de l'article ?>
  </div>
  <p><a href="<?=site_url('dashboard/'.$blog_item['slug']) ?>">Lire la suite</a></p>
  <form method=POST action="<?php echo base_url().'dashboard/update/'.$blog_item['id']; ?>">
    <input type="submit" value="EDIT">
  </form>
  <form method="POST" action="<?php echo base_url().'dashboard/delete/'.$blog_item['id']; ?>">
    <input type="submit" value="DELETE">
  </form>
  <?php
endforeach;

// Si l'utilisateur est loggé on affiche le bouton log out
if($_SESSION['logged_in']) {
  echo form_open('logout/');
  echo form_submit('submit','Log out');
  echo form_close();
}
