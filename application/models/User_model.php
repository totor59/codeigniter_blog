<?php
// admin
class User_model extends CI_Model {
  function __construct() { }



  public function verify_user($user_name, $password) {
      $q = $this
            ->db
            ->where('user_name', $user_name)
            ->where('user_password', sha1($password))
            ->limit(1)
            ->get('users');

      if ( $q->num_rows > 0 ) {
         // person has account with us
         return $q->row();
      }
      return false;
  }

  public function create_user($data)
{
    $this->db->insert('users', $data);
}
}
