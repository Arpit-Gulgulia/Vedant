<?php

class Insert_thumbnails extends CI_Model {


    public function index($data) {

        return $this->db->insert('thumbnails',$data);
    }

}



?>