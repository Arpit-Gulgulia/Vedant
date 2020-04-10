<?php

class Subscription extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['video_suggestion_model','Users/user_model']);
    }

    public function index() {
        $this->load->view('Templates/header',$_SESSION);

        $subscriptionVideos = $this->createSubscription($this->session->userdata('username'));
        $videos = array(
            'subscriptionVideos' => $subscriptionVideos
        );
        $this->load->view('subscription_view',$videos);
        $this->load->view('Templates/footer');
    }

    public function createSubscription($username) {

        $subscribers = $this->user_model->getSubscription($username);

        // print_r($subscribers);
        // die();
        $videoSubscriptionData = array();

        foreach($subscribers as $subs) {

            $videos = $this->user_model->getUploadedVideos($subs->userTo);



            foreach($videos as $video) {

                $thumbnail = $this->video_suggestion_model->getThumbnails($video->id)[0]->filePath;
                $duration = $video->duration;

                $videoSubscriptionData['video'.$video->id] = array(
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

        }
        return $videoSubscriptionData;
    }

}














