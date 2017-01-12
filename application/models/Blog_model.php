<?php
class Blog_model extends CI_Model {
  private $article= 'article';
  public function __construct()	{
    $this->load->database();
  }

  public function get_article($slug = FALSE)
  {
    if ($slug === FALSE)
    {
      $query = $this->db->get('article');
      return $query->result_array();
    }

    $query = $this->db->get_where('article', array('slug' => $slug));
    return $query->row_array();
  }
  public function get_article_by_id($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('article');
      return $query->result_array();
    }

    $query = $this->db->get_where('article', array('id' => $id));
    return $query->row_array();
  }

  public function set_article( $id = 0 )
  {
    $id = $this->input->post('id');
    $slug = url_title(convert_accented_characters($this->input->post('title'), 'dash', TRUE));
    $data = array(
      'title' => $this->input->post('title'),
      'slug' => $slug,
      'content' => $this->input->post('content')
    );
    if ( $id == 0 ) {
      $this->db->insert('article', $data);
    } else {
      $this->db->where('id', $id);
      $this->db->update('article', $data);

    }
  }
  public function delete_article($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('article');
  }

}
