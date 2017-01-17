<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('blog_model');
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
  }
