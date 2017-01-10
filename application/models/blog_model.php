<?php
class Blog_model extends CI_Model {
  public function __construct()	{
    $this->load->database();
  }
  public function get_article($id) {
  if($id != FALSE) {
    $query = $this->db->get_where('article', array('id' => $id));
    return $query->row_array();
  }
  else {
    return FALSE;
  }
}
}
