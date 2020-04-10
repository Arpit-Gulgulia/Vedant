<?php


class Comments_model extends CI_Model {

    public function getNumberOfComments($videoId) {
        $this->db->where('videoId',$videoId);
        $this->db->from('comments');
        $query = $this->db->get();

        return $query->num_rows() ;
    }

    public function getComments($videoId) {

        $this->db->where('videoId',$videoId);
        $this->db->where('responseTo',0);
        $this->db->order_by('datePosted','DESC');

        $this->db->from('comments');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getNumberOfReplies($commentId) {
        $this->db->where('responseTo',$commentId);
        $this->db->from('comments');
        $query = $this->db->get();

        return $query->num_rows() ;

    }

    public function getLikes($commentId) {
       $this->db->where('commentId',$commentId);
       $this->db->from('likes');
       $numLikes = $this->db->count_all_results();

        $this->db->where('commentId',$commentId);
        $this->db->from('dislikes');
        $numDislikes = $this->db->count_all_results();

        return $numLikes-$numDislikes;
    }

    public function wasLikedBy($commentId,$username) {
        $this->db->where('commentId',$commentId);
        $this->db->where('username',$username);
        $this->db->from('likes');
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function wasDislikedBy($commentId,$username) {
        $this->db->where('commentId',$commentId);
        $this->db->where('username',$username);
        $this->db->from('dislikes');
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

}