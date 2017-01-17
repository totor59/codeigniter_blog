<?php foreach ($blog as $blog_item): ?>

  <h3><?=$blog_item['title']// Titre de l'article ?></h3>
  <div class="main">
    <?=character_limiter($blog_item['content'], 256)// Extrait de l'article ?>
  </div>
  <p><a href="<?=site_url('blog/'.$blog_item['slug']) ?>">Lire la suite</a></p>

  <?php
endforeach;
