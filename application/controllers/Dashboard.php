<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('blog_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  function index() {
    $this->output->enable_profiler(true);
    if($this->session->userdata('logged_in') === TRUE ) {
      $data['blog'] = $this->blog_model->get_article();
      $data['title'] = 'Dashboard';
      $this->load->view('templates/header', $data);
      $this->load->view('admin/dashboard', $data);
      $this->load->view('templates/footer');
    }
    else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  public function view($slug) {
    if($this->session->userdata('logged_in') === TRUE ) {
        redirect('login', 'refresh');
      }
    $this->output->enable_profiler(true);
    if($this->session->userdata('logged_in') === TRUE ) {
      $data['blog_item'] = $this->blog_model->get_article($slug);
      $data['title'] = $data['blog_item']['title'];
      if (empty($data['blog_item'])) {
        show_404();
      }
      $this->load->view('templates/header', $data);
      $this->load->view('admin/view', $data);
      var_dump($data);
      $this->load->view('templates/footer');
    } else {
      redirect('login', 'refresh');
    }
  }
  public function logout() {
    //$this->session->unset_userdata('logged_in');
    session_destroy();
    redirect(base_url().'blog/');
  }

// CRUD FUNCTIONS

  public function create() {
    if(!$this->session->userdata('logged_in') === TRUE ) {
        redirect('login', 'refresh');
      }
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
      $this->blog_model->set_article();
      $this->load->view('blog/create_success');
    }
  }

  public function delete($id) {
    if(!$this->session->userdata('logged_in') === TRUE ) {
        redirect('login', 'refresh');
      }
    $this->output->enable_profiler(true);
    $this->blog_model->delete_article($id);
    $this->load->view('blog/delete_success');
  }

  public function update($id) {
    if(!$this->session->userdata('logged_in') === TRUE ) {
        redirect('login', 'refresh');
      }
    $this->output->enable_profiler(true);
    $data['blog_item'] = $this->blog_model->get_article_by_id($id);
    $data['title'] = 'Update a blog item';
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('blog/update', $data);
      $this->load->view('templates/footer');
    }
    else {
      $this->blog_model->set_article();
      $this->load->view('blog/update_success');
    }
  }
}
