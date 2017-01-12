<?php
class Blog extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Blog_model');
    $this->load->helper('url_helper');
    if(!$this->session->userdata('username')) redirect('admin');
  }

  public function index()
  {
    $data['blog'] = $this->Blog_model->get_article();
    $data['title'] = 'Blog archive';
    $this->load->view('templates/header', $data);
    if($this->session->userdata('isadmin')) $this->load->view('blog/admin', $data);
    else $this->load->view('blog/index', $data);
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
    $slug = url_title($this->input->post('title'), 'dash', TRUE);
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
      $this->load->view('blog/create_success');
    }
  }
  public function delete($id) {
    $this->Blog_model->delete_article($id);
    redirect(base_url().'blog/');
  }

  public function update() {
    $id = $this->input->post('id');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $data['blog_item'] = $this->Blog_model->get_article_by_id($id);
    $data['title'] = 'Edit a blog item';
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $this->load->view('templates/header', $data);
      $this->load->view('blog/update', $data);
      $this->load->view('templates/footer');

    }
    else
    {
      $this->Blog_model->set_article();
      $this->load->view('blog/update_success');
    }

  }
}
