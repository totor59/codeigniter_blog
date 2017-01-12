<?php
class Blog extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Blog_model');
    $this->load->helper('url_helper');
  }

  public function index()
  {
    $data['blog'] = $this->Blog_model->get_article();
    $data['title'] = 'Blog archive';
    $this->load->view('templates/header', $data);
    $this->load->view('blog/index', $data);
    $this->load->view('templates/footer');
  }

  public function view($slug = NULL)
  {
    $data['blog_item'] = $this->Blog_model->get_article($slug);

    if (empty($data['blog_item']))
    {
      show_404();
    }

    $data['title'] = $data['blog_item']['title'];

    $this->load->view('templates/header', $data);
    $this->load->view('blog/view', $data);
    $this->load->view('templates/footer');
  }

  public function create() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $data['title'] = 'Create a blog item';
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $this->load->view('templates/header', $data);
      $this->load->view('blog/create');
      $this->load->view('templates/footer');

    }
    else
    {
      $this->Blog_model->set_article();
      $this->load->view('blog/success');
    }
  }
  public function delete($id) {
  $this->Blog_model->delete_article($id);
  redirect(base_url().'/blog/');

  }
}
