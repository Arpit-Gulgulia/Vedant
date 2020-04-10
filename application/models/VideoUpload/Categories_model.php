<?php 


class Categories_model extends CI_Model {

    public function get_categories() {
        $query = $this->db->query('SELECT id,name FROM categories');
        return $query->result();
    }


}






?>  