<?php
class Blog extends CI_Controller {
  public function __construct()  {
    parent::__construct();
    $this->load->model('Blog_model');
    $this->load->model('User_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  public function index() {
    $this->load->library('pagination');
    $this->output->enable_profiler(true);
    $data['blog'] = $this->Blog_model->get_article();
    $data['title'] = 'Blog index';
    $this->load->view('templates/header', $data);
    $this->load->view('blog/index', $data);
    $this->load->view('templates/footer');
  }

  public function view($slug) {
    $this->output->enable_profiler(true);
    $data['blog_item'] = $this->Blog_model->get_article($slug);
    $data['title'] = $data['blog_item']['title'];
    if (empty($data['blog_item'])) {
      show_404();
    }
    $this->load->view('templates/header', $data);
    $this->load->view('blog/view', $data);
    var_dump($data);
    $this->load->view('templates/footer');
  }

}
