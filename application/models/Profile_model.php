<?php
class Profile_model extends CI_Model {

    public function getThumbnails($videoId) {

        $this->db->select('filePath');
        $this->db->where('videoId',$videoId);
        $this->db->where('selected',1);
        $this->db->from('thumbnails');
        $query = $this->db->get();

        return( $query->result());

    }

}