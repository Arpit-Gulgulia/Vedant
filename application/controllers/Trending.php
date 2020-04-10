<?php

class Trending extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['videos_trending_model']);
    }

    public function index() {
        $this->load->view('Templates/header',$_SESSION);

        $trendingVideos = $this->createTrendingVideos();
        $videos = array(
            'trendingVideos' => $trendingVideos
        );
        $this->load->view('videos_trending_view',$videos);
        $this->load->view('Templates/footer');
    }

    public function createTrendingVideos() {

        $videoTrendingData = array();

            $videos = $this->videos_trending_model->getTrendingVideos();


            foreach($videos as $video) {
//                 echo "<pre>";
//                 print_r($video);
//                 echo "<br><br>";
                $thumbnail = $this->videos_trending_model->getThumbnails($video->id)[0]->filePath;
                $duration = $video->duration;

                $videoTrendingData['video'.$video->id] = array(
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


        return $videoTrendingData;
    }


}














