<?php

class Videodislikes_model extends CI_Model {

public function countDislikes($videoId) {

    $this->db->where('videoId',$videoId);
    $this->db->from('dislikes');
    $countDislikes = $this->db->count_all_results();//WILL RETURN INTEGERS

    return $countDislikes;
}

public function wasDisliked($videoId,$username) {

    $this->db->where('videoId',$videoId);
    $this->db->where('username',$username);
    $this->db->from('dislikes');
    $countLikes = $this->db->count_all_results();//WILL RETURN INTEGERS

    return $countLikes;
}

}


?>