<?php
class Blog extends CI_Controller {
  public function show($id) {
      $this->load->model('blog_model');
      $article = $this->blog_model->get_article($id);
      $data['title'] = $article['title'];
      $data['content'] = $article['content'];
      $data['date'] = $article['date'];
      $data['category'] = $article['category'];
      $this->load->view('single_article', $data);
  }
}
