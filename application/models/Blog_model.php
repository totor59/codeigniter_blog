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
public function set_article()
{
    $this->load->helper('url');

    $slug = url_title($this->input->post('title'), 'dash', TRUE);

    $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'content' => $this->input->post('content')
    );

    return $this->db->insert('article', $data);
}
public function delete_article($id)
  {
     $this->db->where('id',$id);
     $this->db->delete('article');

  }

}
