<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// admin

class Admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
       $this->load->model('User_model');
       $this->output->enable_profiler(true);
  }

  public function index() {
    //if($this->session->userdata('username')) redirect('blog');

    $this->load->library('form_validation');
    $this->form_validation->set_rules('user_name', 'Identifiant', 'required');
    $this->form_validation->set_rules('user_password', 'Mot de passe', 'required|min_length[4]');

    if ( $this->form_validation->run() !== false ) {
        // then validation passed. Get from db
        $this->load->model('User_model');
        $res = $this
                 ->User_model
                 ->verify_user(
                    $this->input->post('user_name'),
                    $this->input->post('user_password')
                 );

        if ( $res !== false ) { // @todo controle isadmin
          $this->session->set_userdata('isadmin', true);
          $this->session->set_userdata('username', 'admin');
          $this->load->view('blog/admin');
        }
    }
    $this->load->view('users/login');
  }

  function register()
   {

       $data['error'] = NULL;
       if($this->input->post())
       {
           $config = array(
               array(
                   'field' => 'user_name',
                   'label' => 'Username',
                   'rules' => 'trim|required|min_length[3]|is_unique[users.user_name]'//is unique username in the user's table of DB
               ),
               array(
                   'field' => 'password',
                   'label' => 'Password',
                   'rules' => 'trim|required|min_length[5]|max_length[20]'
               ),
               array(
                   'field' => 'passconf',
                   'label' => 'Password confirmed',
                   'rules' => 'trim|required|matches[password]',
               ),
           );
           $this->load->library('form_validation');
           $this->form_validation->set_rules($config);
           if($this->form_validation->run() == FALSE)
           {
               $data['error'] = validation_errors();
           }
           else
           {
               $data = array(
                   'user_name' => $this->input->post('user_name'),
                   'user_password' => sha1($this->input->post('password')),
               );
               $user_id = $this->User_model->create_user($data);
               $this->session->set_userdata('id',$id);
               $this->session->set_userdata('user_name',$this->input->post('user_name'));
               $this->session->set_userdata('user_type',$this->input->post('user_type'));
               redirect(base_url().'index.php/blog/');
           }

       }

       $this->load->view('users/register',$data);
       $this->load->view('templates/footer');
   }

  public function logout() {
    $this->session->sess_destroy();
    redirect('admin');
  }
}
