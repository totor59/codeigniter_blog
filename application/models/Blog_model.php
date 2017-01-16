<?php
class Blog_model extends CI_Model {
  private $article= 'article';
  public function __construct()	{
    $this->load->database();
  }

  public function get_article($slug = FALSE) {
    if ($slug === FALSE) {
      $query = $this->db->select('*')
                          ->from('article')
                          ->order_by('date', 'DESC');
      return $query->get()->result_array();
    } else {
      $query = $this->db->select('*')
                          ->from('article')
                          ->where('slug', $slug);
      return $query->get()->row_array();
    }
  }


  public function get_article_by_id($id)  {
    $query = $this->db->get_where('article', array('id' => $id));
    return $query->row_array();
  }

  public function set_article( $id = 0 )  {
    $id = $this->input->post('id');
    // On crée un slug clean et on utilise convert_accented_characters pour supprimer les accents
    $slug = url_title(convert_accented_characters($this->input->post('title'), 'dash', TRUE));
    $data = array(
      'title' => $this->input->post('title'),
      'slug' => $slug,
      'content' => $this->input->post('content'),
      'user_id' => $this->session->id
    );
    if ( $id == 0 ) {
      // Si l'ID est égal a 0 on insère un nouvel article
      $this->db->insert('article', $data);
    } else {
      // Sinon on update l'article qui correspond a l'ID
      $this->db->where('id', $id);
      $this->db->update('article', $data);
    }
  }

  public function delete_article($id)  {
    $this->db->where('id',$id);
    $this->db->delete('article');
  }
}
