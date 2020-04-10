<?php

class LikedVideos extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['video_suggestion_model','Users/user_model']);
    }

    public function index() {
        $this->load->view('Templates/header',$_SESSION);

        $likedVideos = $this->createLikedVideos($this->session->userdata('username'));

        $videos = array(
            'likedVideos' => $likedVideos
        );
        $this->load->view('likedVideos_view',$videos);
        $this->load->view('Templates/footer');
    }

    public function createLikedVideos($username) {

        $likedVideosData = array();

            $videos = $this->user_model->getLikedVideos($username);


            foreach($videos as $video) {

//                print_r($video);
//                continue;

                $thumbnail = $this->video_suggestion_model->getThumbnails($video->id)[0]->filePath;

                $duration = $video->duration;

                $likedVideosData['video'.$video->id] = array(
                    'id' => $video->id,
                    'uploadedBy' => $video->uploadedBy,
                    'views' => $video->views,
                    'description' => $video->description,
                    'title' => $video->title,
                    'uploadDate' => $video->uploadDate,
                    'thumbnail' => $thumbnail,
                    'duration' => $duration
                );

            }


        return $likedVideosData;
    }


}