<?php

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(['video_suggestion_model','Users/user_model']);
    }

    public function index() {

        //Load Header
        $this->load->view('Templates/header',$_SESSION);

//        echo '<pre>'; print_r($this->session->all_userdata());
//        die();

        //Load Subscription videos
        if(isset($_SESSION['username'])) {
            
            $subscriptionVideos = $this->createSubscription($this->session->userdata('username'));
            $videos = array(
                'subscriptionVideos' => $subscriptionVideos
            );
            $this->load->view('Home/home_subscription_view',$videos);

        }
        // else {
        //     echo "Not Logged In!";
        //     die();
        // }
        


        //Load Recommended Videos
        $suggestedVideos = $this->createSuggestion();
        $videos = array(
            'suggestedVideos' => $suggestedVideos
        );
        $this->load->view('Home/home_recommended_view',$videos);
        $this->load->view('Templates/footer');

    }


    /******Function to create Recommended videos on Home Page
     * ***/
    public function createSuggestion() {

        
        $videos = $this->video_suggestion_model->create_suggestions();
        // return $videos;
        
        $videoSuggestedData = array();
        
        foreach($videos as $video) {

           $thumbnail = $this->video_suggestion_model->getThumbnails($video->id)[0]->filePath;
           $duration = $video->duration;
           
           $videoSuggestedData['video'.$video->id] = array(
               'id' => $video->id,
               'uploadedBy' => $video->uploadedBy,
               'views' => $video->views,
               'description' => $this->trimDescription($video->description),
               'title' => $video->title,
               'uploadDate' => $video->uploadDate,
               'thumbnail' => $thumbnail,
               'duration' => $duration
           );

        }

    

        return $videoSuggestedData;
    
    }  
    
    //To trim long description of videos 
    public function trimDescription($text) {
        
        $text = strlen($text) > 50  ? substr($text, 0 , 47). "..." : $text; 
        
        return $text;

    }


    public function createSubscription($username) {

        $subscribers = $this->user_model->getSubscription($username);

        // print_r($subscribers);
        // die();
        $videoSubscriptionData = array();

        foreach($subscribers as $subs) {

           $videos = $this->user_model->getUploadedVideos($subs->userTo);
           
        
           foreach($videos as $video) {
              
            // print_r($video);
            // echo "<br><br>";
              $thumbnail = $this->video_suggestion_model->getThumbnails($video->id)[0]->filePath;
              $duration = $video->duration;
              
              $videoSubscriptionData['video'.$video->id] = array(
                  'id' => $video->id,
                  'uploadedBy' => $video->uploadedBy,
                  'views' => $video->views,
                  'description' => $this->trimDescription($video->description),
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

  
    



?>