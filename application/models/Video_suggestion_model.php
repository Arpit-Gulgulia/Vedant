<?php


class Video_suggestion_model extends CI_Model {

    public function create_suggestions() {

        $this->db->order_by('title', 'RANDOM');
        $this->db->limit(15);
        $query = $this->db->get('videos');

        $result = $query->result();

        return $result;

    }

    public function getThumbnails($videoId) {

        $this->db->select('filePath');
        $this->db->where('videoId',$videoId);
        $this->db->where('selected',1);
        $this->db->from('thumbnails');
        $query = $this->db->get();

        return( $query->result());
       
    }


}



?>