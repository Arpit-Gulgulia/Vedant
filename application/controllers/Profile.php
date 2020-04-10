<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {

  private $profileUsername;

  public function __construct() {
      parent::__construct();
      $this->load->model('Users/user_model');
      $this->load->model('profile_model');
  }


    public function index() {
      if (isset($_GET['username'])) {
          $this->profileUsername = $_GET["username"];
          $this->user_model->setUserData($this->profileUsername);

          $profileData = array(
              'name' => $this->getProfileUserFullName(),
              'profileImage' => $this->getProfilePic(),
              'subCount' => $this->getSubscriberCount(),
              'button' => $this->createHeaderButton(),
              'videos' => $this->getUsersVideos(),
              'details' => $this->getAllUserDetails()
          );
          $this->load->view('Templates/header',$_SESSION);
          $this->load->view('profile_view',$profileData);
          $this->load->view('Templates/footer');
      }
      else {
          $this->load->view('Templates/header',$_SESSION);
          echo "Channel not Found";
          $this->load->view('Templates/footer');
      }
  }

    public function getProfileUserFullName() {
        return $this->user_model->getName();
    }

    public function getProfilePic() {
        return $this->user_model->getProfilePic();
    }

    public function getSubscriberCount() {
      return $this->user_model->getSubscriberCount($this->profileUsername);
    }

    private function createHeaderButton() {
        if($this->session->userdata('username') == $this->profileUsername) {
            return "";
        }
        else {
            $userLoggedIn = $this->session->userdata('username');
            $userTo = $this->profileUsername;
            $isSubscribedTo = $this->user_model->isSubscribedTo($userLoggedIn,$userTo);

            $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
            $buttonText .= " " . $this->getSubscriberCount();

            $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";

            if ($userLoggedIn!=="") $action = "subscribe(this,\"$userTo\", \"$userLoggedIn\")";
            else $action = "notSignedIn()";



            return "<div class='subscribeButtonContainer'>
                       <button class='$buttonClass' onclick='$action'>
                          <span class='text'>$buttonText</span>
                       </button>
                   </div>";
        }
    }

    public function getAllUserDetails(){
        return array(
            "Name" => $this->user_model->getName(),
            "Username" => $this->profileUsername,
            "Subscribers" => $this->user_model->getSubscriberCount($this->profileUsername),
            "Total views" => $this->user_model->getTotalViews()[0]->views,
            "Sign up date" => $this->user_model->getSignUpDate()
        );
    }

    public function getUsersVideos() {

        $videosData = array();

        $videos = $this->user_model->getUploadedVideos($this->profileUsername);


        foreach($videos as $video) {
//                 echo "<pre>";
//                 print_r($video);
//                 echo "<br><br>";
            $thumbnail = $this->profile_model->getThumbnails($video->id)[0]->filePath;
            $duration = $video->duration;

            $videosData['video'.$video->id] = array(
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


        return $videosData;
    }


}