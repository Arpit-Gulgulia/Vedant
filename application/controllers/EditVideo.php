<?php

class EditVideo extends CI_Controller {

    private $videoId,$detailsMessage="";

    public function __construct() {
        parent::__construct();
        $this->load->model('editvideo_model');
        $this->load->model('Users/user_model');
        $this->load->model('VideoUpload/Categories_model');
    }

    public function index() {

        if (isset($_GET['videoId'])) {
            $this->videoId = $_GET["videoId"];

            if (isset($_POST['saveDetailsButton'])){
                $this->editVideoDetailsProcessing();
//                echo "detailsMessage = ".$this->detailsMessage;
//                die();
            }

            $editVideoData = array(
                'categories' => $this->category(),
                'video' => $this->getVideoDetails(),
                'detailsMessage' =>$this->detailsMessage
            );

            $this->load->view('Templates/header',$_SESSION);
            $this->load->view('editVideo_view',$editVideoData);
            $this->load->view('Templates/footer');
        }
        else {
            $this->load->view('Templates/header',$_SESSION);
            echo "Channel not Found";
            $this->load->view('Templates/footer');
        }
    }

    public function category() {
        $data['categories'] = $this->Categories_model->get_categories();
        return $this->Categories_model->get_categories();
    }

    public function getVideoDetails(){
        return $this->user_model->getVideoById($this->videoId);
    }

    public function editVideoDetailsProcessing(){

        $this->load->helper(array('form','url'));

        $this->load->library('form_validation');

        if ($this->input->post()){
            $userInputs = $this->input->post();
            if ($this->editvideo_model->updateVideoDetails($this->videoId,$userInputs)) {
                $this->detailsMessage= 'SUCCESS! video details updated';
            }
            else{
                $this->detailsMessage = 'Failed! Wrong old password';
            }

        }

    }



}