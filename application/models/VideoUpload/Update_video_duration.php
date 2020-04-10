<?php

class Update_video_duration extends CI_Model {

    public function update_duration($data) {
    //    print_r($data);
    //    die();
       $this->db->where('id', $data['id']);
       $this->db->update('videos', $data);
    }

}


?>