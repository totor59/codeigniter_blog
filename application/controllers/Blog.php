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

  public function create() {
    $this->output->enable_profiler(true);
    $data['title'] = 'Create a blog item';
    $slug = url_title($this->input->post('title'), 'dash', TRUE);
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      var_dump($data);
      $this->load->view('blog/create');
      $this->load->view('templates/footer');
    }
    else {
      $this->Blog_model->set_article();
      $this->load->view('blog/create_success');
    }
  }

  public function delete($id) {
    $this->output->enable_profiler(true);
    $this->Blog_model->delete_article($id);
    $this->load->view('blog/delete_success');
  }

  public function update($id) {
    $this->output->enable_profiler(true);
    $data['blog_item'] = $this->Blog_model->get_article_by_id($id);
    $data['title'] = 'Update a blog item';
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('blog/update', $data);
      $this->load->view('templates/footer');
    }
    else {
      $this->Blog_model->set_article();
      $this->load->view('blog/update_success');
    }
  }
}
