<?php foreach ($blog as $blog_item): ?>

  <h3><?php echo $blog_item['title'];// Titre de l'article ?></h3>
  <div class="main">
    <?php echo character_limiter($blog_item['content'], 256);// Extrait de l'article ?>
  </div>
  <p><a href="<?php echo site_url('blog/'.$blog_item['slug']); ?>">Lire la suite</a></p>

<?php
// Si l'utilisateur est loggé on affiche les boutons EDIT et DELETE
  if($this->user_model->is_logged_in()) {
    echo form_open('blog/update/'.$blog_item['id']);
         echo form_submit('submit','Edit');
    echo form_close();
    echo form_open('blog/delete/'.$blog_item['id']);
         echo form_submit('submit','Delete');
    echo form_close();
}
endforeach; ?>
