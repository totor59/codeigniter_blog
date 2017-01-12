<?php foreach ($blog as $blog_item): ?>

  <h3><?php echo $blog_item['title'];// Titre de l'article ?></h3>
  <div class="main">
    <?php echo character_limiter($blog_item['content'], 256);// Extrait de l'article ?>
  </div>
  <p><a href="<?php echo site_url('blog/'.$blog_item['slug']); ?>">Lire la suite</a></p>
<?php endforeach; ?>
<a href="<?php echo base_url().'Admin/index'; ?>">Connectez vous</a>
<?php echo $this->session->user_name ;?>
