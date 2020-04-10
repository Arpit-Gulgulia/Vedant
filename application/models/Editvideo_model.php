<?php
class Editvideo_model extends CI_Model {

    public function updateVideoDetails($videoId,$videoData) {
        $data = array(
            'title' => $videoData['titleInput'],
            'description'=>$videoData['descriptionInput'],
            'privacy'=>$videoData['privacyInput'],
            'category'=>$videoData['categoryInput'],

        );
        $this->db->where('id', $videoId);
        $query = $this->db->update('videos', $data);
        return $query;
    }

}