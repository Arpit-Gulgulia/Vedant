<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Watch extends CI_Controller {
    public $videoId;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users/User_model');
        $this->load->model('Comments_model');
    }


    public function index() {

        //I don't need to pass Session variables in views
        if(!isset($_SESSION['username']))
            $_SESSION['username'] = "";
        $this->load->view('Templates/header',$_SESSION);

        if(!$this->input->get('id')) {

            echo "No Id is passed into URl";
            exit();

        }

/****  Video Player Section
 ***/
        $this->videoId = $this->input->get('id');

        $videoData = $this->getVideoData();
        // $videoData IS AN ARRAY WITH ALWAYS ONE ELEMNET IN IT 

        $this->load->model('videolikes_model');
        $likesCount = $this->videolikes_model->countLikes($this->input->get('id'));
        $wasLiked = ($this->videolikes_model->wasLiked($this->input->get('id'),$this->session->userdata('username'))) > 0 ? TRUE : FALSE;

        $this->load->model('videodislikes_model');
        $disLikesCount = $this->videodislikes_model->countDislikes($this->input->get('id'));
        $wasdisliked = ($this->videodislikes_model->wasDisliked($this->input->get('id'),$this->session->userdata('username'))) > 0 ? TRUE : FALSE;

        $this->load->model('Users/user_model');
        $result = $this->user_model->get_user_information($videoData[0]['uploadedBy']);
        
        $videoUploadedByProfilePic = $result[0]->profilePic;
        $isSubscribedTo = $this->user_model->isSubscribedTo($this->session->userdata('username'),$videoData[0]['uploadedBy']);
        $videoUploadedBySubscribers = $this->user_model->getSubscriberCount( $videoData[0]['uploadedBy']);
        

        $videoAllData = $videoData[0] + array(
                                              'autoPlay' => true,
                                              'likesCount' => $likesCount, 
                                              'dislikesCount' => $disLikesCount,
                                              'wasLiked' => $wasLiked,
                                               'wasDisliked' => $wasdisliked,
                                               'videoUploadedByProfilePic' => $videoUploadedByProfilePic,
                                               'isSubscribedTo' => $isSubscribedTo,
                                               'videoUploadedBySubscribers' => $videoUploadedBySubscribers
                                            );
        
        $suggestedVideos = $this->createSuggestion();
        $videos = array(
            'suggestedVideos' => $suggestedVideos
        );

/*** Comment Section
 ****/
        $commentSection = array(
            'commentSection' => $this->createCommentSection($this->videoId)
        );




        $this->load->view('Watch/videoplayer_view', $videoAllData);
        $this->load->view('Watch/commentSection_view',$commentSection);
        $this->load->view('Watch/videoSuggestion_view',$videos);
        $this->load->view('Templates/footer');

    }

    public function getVideoData() {

        if($this->input->get('id')) {

            $this->load->model('video_model');
            return $this->video_model->index($this->input->get('id'));
            

        }
 
    }

    private function createCommentSection($videoId) {
        $numComments = $this->getNumberOfComments($videoId);
        $postedBy = $this->session->userdata('username');

        $profileButton = $this->createUserProfileButton( $postedBy);
        $userData = json_encode($_SESSION);

        $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\",$userData)";
        $commentButton = $this->createButton("COMMENT", null, $commentAction, "postComment");

        $comments = $this->getComments($videoId);

        $commentItems = "";
        foreach($comments as $comment) {
            $commentItems .= $this->createComments($comment);
        }

        return "<div class='commentSection'>

                    <div class='header'>
                        <span class='commentCount'>$numComments Comments</span>

                        <div class='commentForm'>
                            $profileButton
                            <textarea class='commentBodyClass' placeholder='Add a public comment'></textarea>
                            $commentButton
                        </div>
                    </div>

                    <div class='comments'>
                        $commentItems
                    </div>

                </div>";


    }

    private function getNumberOfComments($videoId) {
        return $this->Comments_model->getNumberOfComments($videoId);
    }

//    public $signInFunction = "notSignedIn()";

    public function createLink($link) {
        if ($this->session->userdata('username'))
            return $link;

        return "notSignedIn()";
//        return isset($this->session->userdata('username')) ? $link : "notSignedIn()";
    }

    public function createButton($text, $imageSrc, $action, $class) {

        $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

        $action  = $this->createLink($action);

        return "<button class='$class' onclick='$action'>
                    $image
                    <span class='text'>$text</span>
                </button>";
    }

    public function createUserProfileButton($username) {
        if (!$username) {
            $profilePic = 'assets/images/profilePictures/default.png';
            $link = "notSignedIn()";
        }
        else{
            $userData = $this->User_model->get_user_information($username);
            $profilePic = $userData[0]->profilePic;
            $link = base_url()."profile?username=$username";
        }

        return "<a href='$link'>
                    <img src='$profilePic' class='profilePicture'>
                </a>";
    }

    public function getComments($videoId) {

        $comments = array();
        $comments = $this->Comments_model->getComments($videoId);

        return $comments;
    }

    public function createComments($comment) {
        $id = $comment["id"];
        $videoId = $this->videoId;
        $body = $comment["body"];
        $postedBy = $comment["postedBy"];
        $profileButton = $this->createUserProfileButton($postedBy);
        $timespan = $this->time_elapsed_string($comment["datePosted"]);

        $commentControls = $this->createCommentControl($id);

        $numResponses = $this->getNumberOfReplies($id);

        if($numResponses > 0) {
            $viewRepliesText = "<span class='repliesSection viewReplies' onclick='getReplies($id, this, $videoId)'>
                                    View all $numResponses replies</span>";
        }
        else {
            $viewRepliesText = "<div class='repliesSection'></div>";
        }

        return "<div class='itemContainer'>
                    <div class='comment'>
                        $profileButton

                        <div class='mainContainer'>

                            <div class='commentHeader'>
                                <a href='profile?username=$postedBy'>
                                    <span class='username'>$postedBy</span>
                                </a>
                                <span class='timestamp'>$timespan</span>
                            </div>

                            <div class='body'>
                                $body
                            </div>
                        </div>

                    </div>

                    $commentControls
                    $viewRepliesText
                </div>";
    }

    public function getNumberOfReplies($commentId) {
        return $this->Comments_model->getNumberOfReplies($commentId);
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }



    //Comment Control Section Start for a comment
    public function createCommentControl($commentId) {
        $replyButton = $this->createReplyButton();
        $likesCount = $this->createLikesCount($commentId);
        $likeButton = $this->createLikeButton($commentId,$this->session->userdata('username'));
        $dislikeButton = $this->createDislikeButton($commentId,$this->session->userdata('username'));
        $replySection = $this->createReplySection($commentId);

        return "<div class='controls'>
                    $replyButton
                    $likesCount
                    $likeButton
                    $dislikeButton
                </div>
                $replySection";
    }

    private function createReplyButton() {
        $text = "REPLY";
        $action = "toggleReply(this)";

        return $this->createButton($text, null, $action, null);
    }

    private function createLikesCount($commentId) {
        $text = $this->Comments_model->getLikes($commentId);

        if($text == 0) $text = "";

        return "<span class='likesCount'>$text</span>";
    }

    private function createLikeButton($commentId,$username) {
        $videoId = $this->videoId;
        $action = "likeComment($commentId, this, $videoId)";
        $class = "likeButton";

        $imageSrc = "assets/images/icons/thumb-up.png";

        if($this->wasLikedBy($commentId,$username)) {
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }

        return $this->createButton("", $imageSrc, $action, $class);
    }

    public function wasLikedBy($commentId,$username) {
        return $this->Comments_model->wasLikedBy($commentId,$username) ;
    }

    private function createDislikeButton($commentId,$username) {
        $videoId = $this->videoId;
        $action = "dislikeComment($commentId, this, $videoId)";
        $class = "dislikeButton";

        $imageSrc = "assets/images/icons/thumb-down.png";

        if($this->wasDislikedBy($commentId,$username)) {
            $imageSrc = "assets/images/icons/thumb-down-active.png";
        }

        return $this->createButton("", $imageSrc, $action, $class);
    }

    public function wasDislikedBy($commentId,$username) {
        return $this->Comments_model->wasDislikedBy($commentId,$username) ;
    }

    private function createReplySection($commentId) {
        $postedBy = $this->session->userdata('username');
        $videoId = $this->videoId;

        $profileButton = $this->createUserProfileButton($postedBy);

        $cancelButtonAction = "toggleReply(this)";
        $cancelButton = $this->createButton("Cancel", null, $cancelButtonAction, "cancelComment");

        $userData = json_encode($_SESSION);
        $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\",$userData)";
        $postButton = $this->createButton("Reply", null, $postButtonAction, "postComment");

        return "<div class='commentForm hidden'>
                    $profileButton
                    <textarea class='commentBodyClass' placeholder='Add a public comment'></textarea>
                    $cancelButton
                    $postButton
                </div>";
    }



    public function createSuggestion() {

        $this->load->model('video_suggestion_model');
        $videos = $this->video_suggestion_model->create_suggestions();
        // return $videos;
        
        $videoSuggestedData = array();
        $this->load->model('video_suggestion_model');
        foreach($videos as $video) {

           $thumbnail = $this->video_suggestion_model->getThumbnails($video->id)[0]->filePath;
           $duration = $video->duration;
           
           $videoSuggestedData['video'.$video->id] = array(
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
    // print_r($videoSuggestedData);
    // echo "</pre>";
    // die();
        return $videoSuggestedData;
    
    }

    public function trimDescription($text) {
        
           $text = strlen($text) > 50  ? substr($text, 0 , 47). "..." : $text; 
           
           return $text;

    }
    



}




?>