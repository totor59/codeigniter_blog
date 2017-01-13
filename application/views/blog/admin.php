<?php echo "Bonjour ".$this->session->user_name ;?>
<?php foreach ($blog as $blog_item): ?>

  <h3><?php echo $blog_item['title'];// Titre de l'article ?></h3>
  <div class="main">
    <?php echo character_limiter($blog_item['content'], 256);// Extrait de l'article ?>
  </div>
  <p><a href="<?php echo site_url('blog/'.$blog_item['slug']); ?>">Lire la suite</a></p>
  <form method=POST action="<?php echo base_url().'blog/update/'.$blog_item['id']; ?>">
    <input type="submit" value="EDIT">
  </form>
  <form method="POST" action="<?php echo base_url().'blog/delete/'.$blog_item['id']; ?>">
    <input type="submit" value="DELETE">
  </form>
<?php endforeach; ?>
<a href="<?php echo base_url().'Admin/index'; ?>">Connectez vous</a>
