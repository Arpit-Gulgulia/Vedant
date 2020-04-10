<?php

class Search_model extends CI_Model {

    public function getSearchVideos($terms,$orderBy) {

        $this->db->like('title',$terms);
        $this->db->or_like('uploadedBy',$terms);
        $this->db->order_by($orderBy,'DESC');

        $query = $this->db->get('videos');

        $result = $query->result();

        return $result;

    }
}

?>