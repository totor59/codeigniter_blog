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
        'id' => $row->id,
        'logged_in' => true,

      );
      $this->session->set_userdata($data);
      return true;
      // Sinon on renvoie vers la page de login
    } else {
      return false;
    }
  }

  public function is_logged_in() {
    // On vérifie si la variable logged_in est présent dans les variables de session
    if($this->session->userdata('logged_in')) {
      return true;
    }
  }

  public function is_admin() {
    // On vérifie sur le usertype de l'utilisateur = 'admin'
    if ($this->session->usertype = 'admin') {
    return TRUE;
    }
  }

  public function is_owner($user_id) {
    // On vérifie si l'ID de l'utilisateur est égal au user_id du post
    if($this->session->id == $user_id ) {
    return TRUE;
    }
  }

}
