<?php 

class Video_model extends CI_Model {


    public function index($id) {

        // INCREMENT THE VIEWS OF THIS VIDEO
        if($this->incrementView($id)) {

            $conditions = array(
                'id' => $id
            );
            return $this->db->get_where('videos',$conditions)->result_array();

        }
    }

    public function incrementView($id) {

        $conditions = array(
            'id' => $id
        );

        $this->db->select('views');
        $result = $this->db->get_where('videos',$conditions)->result_array();
        
        $views = $result[0]['views'];
        $data = array(
            'views' => $views+1
        );

        $this->db->where('id',$id);
        return $this->db->update('videos',$data);
        //THIS WILL RETRUN BOOLEAN TRUE OR FALSE

    }

}



?>