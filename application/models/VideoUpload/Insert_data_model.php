<?php

class Insert_data_model extends CI_Model {


    public function insert_data($data) {

        return $this->db->insert('videos',$data);


    }


}


?>