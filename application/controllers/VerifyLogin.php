<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerifyLogin extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
     $this->load->library('form_validation');
  }

  function index(){
    // On contrôle les entrées du formulaire de login
    $this->form_validation->set_rules('username','Login','required');
    $this->form_validation->set_rules('password','Mot de passe','required');
    if(!$this->form_validation->run()){
      $this->load->view('admin/login');
    } else {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $authentification = $this->user_model->login($username,$password);
      ;
      if($authentification){
        redirect('dashboard','refresh');
      } else {
        $data['error_credentials'] = 'Wrong Username/Password';
        $this->load->view('admin/login',$data);
      }
    }
  }
}
