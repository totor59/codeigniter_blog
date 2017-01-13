<?php
class Admin extends CI_Controller {
  public function __construct()  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  function index(){
    function index(){
      if($this->user_model->is_logged_in()){
        redirect('blog/index','refresh');
      } else {
        redirect('admin/login','refresh');
      }
    }
  }

  function login(){
    if($this->user_model->is_logged_in()){
      redirect('admin/dashboard','refresh');
    } else {
      // On contrôle les entrées du formulaire de login
      $this->form_validation->set_rules('username','Login','required');
      $this->form_validation->set_rules('password','Mot de passe','required');
      if(!$this->form_validation->run()){
        $this->load->view('user/login');
      } else {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $authentification = $this->user_model->verify_login($username,$password);
        ;
        if($authentification){
          redirect('admin/dashboard','refresh');
        } else {
          $data['error_credentials'] = 'Wrong Username/Password';
          $this->load->view('user/login',$data);
        }
      }
    }
  }

  function logout() {
    $this->session->sess_destroy();
    redirect(base_url().'blog/');
  }

  function dashboard(){
    $data['is_admin'] = FALSE;
    if ($this->session->usertype === 'admin'){
    $data['is_admin'] = TRUE;
    }
    $this->load->model('blog_model');
    $data['blog'] = $this->blog_model->get_article();
    $data['title'] = 'Blog index';
    $this->load->view('templates/header', $data);
    $this->load->view('blog/index', $data);
    $this->load->view('templates/footer');
  }
}
