<?php

class User_model extends CI_Model {

    private $username,$sqlData;

    public function create_user($data) {

          $userData = array(
              
            'firstName' => $data['firstName'],
            'lastName'  => $data['lastName'],
            'username'  => $data['username'],
            'email' => $data['email'],
            'password' => hash("sha512", $data['password']),
            'profilePic' => base_url().'assets/images/profilePictures/default.png'
          );
          


        //   $query = "INSERT INTO `users`(`firstName`, `lastName`, `username`, `email`, `passsword`,`profilePic`) VALUES ('{$fn}','{$ln}','{$un}','{$em}','{$pw}','{$profilePic}')";
        //   $result = mysqli_query($this->con, $query);
    //    print_r($data);
    //    die();
        // $result = $this->db->insert($data);Don't insert data into table data contains all post input variables including submit button!
        // print_r($userData);
        // die();
        $result = $this->db->insert('users',$userData);
        return $result;

    }

    public function validate_user($data) {
       
        $data['password'] = hash("sha512", $data['password']);
        $query = $this->db->get_where('users',$data);

        if( $query->num_rows() == 1) {

            return true;

        }
        else{

            return false;

        }

    }

    public function get_user_information($username) {
        
        $data = array(
            'username' => $username
        );

        $query = $this->db->get_where('users',$data);
        return $query->result();

        // THERE IS DIFFERENCE BETWEEN RETURN QUERY AND RETURN RESULT


    }

    public function setUserData($username){
        $this->username = $username;
        $this->sqlData = $this->get_user_information($this->username);
    }

    public function getName(){
        return $this->sqlData[0]->firstName.' '.$this->sqlData[0]->lastName;
    }

    public function getProfilePic(){
        return $this->sqlData[0]->profilePic;
    }

    public function getUploadedVideos($username) {

        $this->db->where('uploadedBy',$username);
        $query = $this->db->get('videos');
        return $query->result();
    }

    public function getSubscription($username) {

        $this->db->select('userTo');
        $this->db->from('subscribers');
        $this->db->where('userFrom',$username);
        $query = $this->db->get();

        return $query->result();

    }

    public function isSubscribedTo($userFrom,$userTo) {

        $this->db->where('userFrom',$userFrom);
        $this->db->where('userTo',$userTo);
        $this->db->from('subscribers');
        $query = $this->db->get();
        return $query->num_rows() > 0;

    }

    public function getSubscriberCount($userTo) {

        $this->db->where('userTo',$userTo);
        $this->db->from('subscribers');
        $query = $this->db->get();

        return $query->num_rows();

    }

    public function getTotalViews() {
        $this->db->select_sum('views');
        $this->db->where('uploadedBy',$this->username);
        $this->db->from('videos');
        $query = $this->db->get();

        return $query->result();
    }

    public function getSignUpDate() {
        return $this->sqlData[0]->signUpDate;
    }

    public function getLikedVideos($username) {

        $videos = array();

        $this->db->select('videoId');
        $this->db->where('username',$username);
        $this->db->where('commentId',0);
        $this->db->from('likes');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $videosId = $query->result();

        foreach ($videosId as $id){
           array_push($videos,$this->getVideoById($id->videoId));
        }

        return $videos;
    }
    public function getVideoById($id) {
        $this->db->where('id',$id);
        $this->db->from('videos');
        $query = $this->db->get();
        $result = $query->result();

       return $result[0];
    }

    public function updateUserDetails($userData,$username) {

        $data = array(
            'firstName' => $userData['firstName'],
            'lastName' => $userData['lastName'],
            'email' => $userData['email']
        );

        $this->db->where('username', $username);
        $query = $this->db->update('users', $data);

        return $query;

    }

    public function updateUserPasswordDetails($userData,$username) {

        $userData['oldPassword'] = hash("sha512", $userData['oldPassword']);
        $this->db->where('username',$username);
        $this->db->where('password',$userData['oldPassword']);
        $query = $this->db->get('users');

        if( $query->num_rows() == 1) {

            $data = array(
                'password' => hash("sha512", $userData['newPassword'])
            );

            $this->db->where('username', $username);
            $query = $this->db->update('users', $data);

            return $query;

        }
        else{

            return false;

        }


    }



}


?>