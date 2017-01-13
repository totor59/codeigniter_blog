<?php
class User_model extends CI_Model {
  public function __construct() {
  }

  public function verify_login($username,$password) {
    //$password = $this->encrypt->sha1($password);
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    // On sélectionne les users qui correspondent a $usernmae et $password
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $query = $this->db->get('users');
    // Si la requéte retourne un résultat et on crée les variables de session
    if($query->num_rows() == 1) {
      $row = $query->row();
      $username = ucfirst($row->username);
      $data = array(
        'username' => $username,
        'usertype' => $row->usertype,
        'logged_in' => true
      );
      $this->session->set_userdata($data);
      return true;
      // Sinon on renvoie vers la page de login
    } else {
      return false;
    }
  }

  public function is_logged_in(){
    // On vérifie si la variable logged_in est présent dans les variables de session
    if($this->session->userdata('logged_in')) {
      return true;
    } else {
      return false;
    }
  }

}
