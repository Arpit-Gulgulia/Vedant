<?php


class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('search_model');
        $this->load->view('Templates/header',$_SESSION);
    }
    

    public function index() {
        if(!$this->input->get('term') || $this->input->get('term')==NULL) {
            echo "You must enter a search term";
            die();
        }
        else {
            $term = $this->input->get('term');
            if(!$this->input->get('orderBy') || $this->input->get('orderBy')=='views') {
                $orderBy = "views";
            }
            else{
                $orderBy = "uploadDate";
            }
            $videoData = $this->searchResult($term,$orderBy);
            $newUrl = $this->filter();
            $videos = array(
                'searchResult' => $videoData,
                'searchPageTitle' => sizeof($videoData). " Results found",
                'newUrl' => $newUrl
            );
            $this->load->view('search_result_view',$videos);
        }
    }

    public function searchResult($term,$orderBy) {

        $videos = $this->search_model->getSearchVideos($term,$orderBy);
        // return $videos;
        
        $searchVideosData = array();
        $this->load->model('video_suggestion_model');
        foreach($videos as $video) {

           $thumbnail = $this->video_suggestion_model->getThumbnails($video->id)[0]->filePath;
           $duration = $video->duration;
           
           $searchVideosData['video'.$video->id] = array(
               'id' => $video->id,
               'uploadedBy' => $this->trimDescription($video->uploadedBy),
               'views' => $video->views,
               'description' => $this->trimDescription($video->description),
               'title' => $video->title,
               'uploadDate' => $video->uploadDate,
               'thumbnail' => $thumbnail,
               'duration' => $duration
           );

        }

    //     echo "<pre>";
    // print_r($searchVideosData);
    // echo "</pre>";
    // die();
        return $searchVideosData;
    
    }

    public function trimDescription($text) {
        
           $text = strlen($text) > 50  ? substr($text, 0 , 47). "..." : $text; 
           
           return $text;

    }

    public function filter() {
        $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
        $urlArray = parse_url($link);
        $query = $urlArray["query"];

        parse_str($query, $params);

        unset($params["orderBy"]);
        
        $newQuery = http_build_query($params);

        $newUrl = basename($_SERVER["PHP_SELF"]) . "?" . $newQuery;

        return $newUrl;
    } 
    

}



?>