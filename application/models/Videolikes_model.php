<?php

class Videolikes_model extends CI_Model {

public function countLikes($videoId) {

    $this->db->where('videoId',$videoId);
    $this->db->from('likes');
    $countLikes = $this->db->count_all_results();//WILL RETURN INTEGERS

    return $countLikes;
}

public function wasLiked($videoId,$username) {

    $this->db->where('videoId',$videoId);
    $this->db->where('username',$username);
    $this->db->from('likes');
    $countLikes = $this->db->count_all_results();//WILL RETURN INTEGERS

    return $countLikes;
}


}


?>