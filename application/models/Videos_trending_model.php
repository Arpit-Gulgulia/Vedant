<?php


class Videos_trending_model extends CI_Model {

    public function getTrendingVideos() {

        $where = "uploadDate >= now() - INTERVAL 7 DAY";
        $this->db->where($where);
        $this->db->order_by('views', 'DESC');
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