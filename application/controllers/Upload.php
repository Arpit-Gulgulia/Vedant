<?php


class Upload extends CI_Controller {
    
    public function index() {

       
        $this->load->view('Templates/header',$_SESSION);
        $this->load->view('video_upload_view',$this->category());
        $this->load->view('Templates/footer');
    }

    
    public function category() {

        $this->load->model('VideoUpload/Categories_model');
        $data['categories'] = $this->Categories_model->get_categories();

        return $data;

    }


    public function processing() {

        $config['global_xss_filtering'] = TRUE;

        if(!isset($_POST['uploadButton'])) {
            echo "No file sent to page. Permission denied to processing page!";
            exit();
            
        }
        
        $config['upload_path'] = './uploads/videos/';
        $config['allowed_types'] = 'mp4|flv|webm|mkv|vob|ogv|ogg|avi|wmv|mov|mpeg|mpg';
        $config['max_size'] = '0';
        $config['max_filename'] = '255';
        $config['file_ext_tolower'] = TRUE;
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload',$config);

        if(! $this->upload->do_upload('fileInput')) {

            $error = array(

                'error' => $this->upload->display_errors()

            );
            $data = $error + $this->category();

            $this->load->view('Templates/header',$_SESSION);
            $this->load->view('video_upload_view',$data);
            $this->load->view('Templates/footer');


        }
        else{

            // VIDEO IS SUCCESSFULLY UPLOADED ON SERVER
            $data = array('upload_data' => $this->upload->data());

            

            $finalFilePath = "uploads/videos/".uniqid().".mp4";
            $tempFilePath = "uploads/videos/".$data['upload_data']['file_name'];
           

            // CONVERT INPUT VIDEO STORED IN SERVER TO MP4 FORMATE
            if(! $this->convertVideoToMp4($tempFilePath,$finalFilePath)) {

                echo "Upload Failed-Convertion Failed";
                die();

            }

            else{
                //SUCCESSFULLY CHANGED VIDEO FORMATE. NOW DELETE THE OLD VIDEO
                if(!$this->deleteFile($tempFilePath)) {
                    echo "Upload Failed-File is not deleted\n";
                    die();
                }
            }



            $data = array(

                'title' => $this->input->post('titleInput',TRUE),
                'uploadedBy' => $this->session->userdata('username'),
                'description' => $this->input->post('descriptionInput',TRUE),
                'privacy' => $this->input->post('privacyInput',TRUE),
                'filepath' => $finalFilePath,
                'category' => $this->input->post('categoryInput',TRUE)
    
            );

            
           // FINALLY INSERT DATA INTO DATABASE
            $this->load->model('VideoUpload/insert_data_model');
            if($this->insert_data_model->insert_data($data)) {


                //GENERATE THUMBNAILS
                if(! $this->generateThumbnails($finalFilePath)) {

                    echo "Upload Failed- couldn't generate thumbnails\n";
                    die();
    
                }
                else{
                    echo "Upload Successful\n";
                }
    
            }
            else{
                echo "Error in Insertion of video data's!";
            }
           

        }

        

        

    }

    public function convertVideoToMp4($tempFilePath,$finalFilePath) {

        $cmd = "ffmpeg/ffmpeg -i $tempFilePath $finalFilePath 2>&1";

        $outputLog = array();

        exec($cmd,$outputLog,$returnCode);

        if($returnCode!=0) {
            // Command Failed
            foreach($outputLog as $line) {
                echo $line ."<br>";
            }

            return false;
        }

        return true;


    }

    public function deleteFile($filePath) {

        if(!unlink($filePath)) {

            echo "Could not delete file\n";
            return false;

        }

        return true;

    }

    public function generateThumbnails($filePath) {

        $thumbnailSize = "210*118";
        $numThumbnails = 3;
        $pathToThumbnail = "uploads/videos/thumbnails";

        $duration = $this->getVideoDuration($filePath);

        $videoId = $this->db->insert_id();

        $this->updateDuration($duration,$videoId);

        for($num = 1; $num <= $numThumbnails; $num++) {
            $imageName = uniqid() . ".jpg";
            $interval = ($duration * 0.8) / $numThumbnails * $num;
            $fullThumbnailPath = "$pathToThumbnail/$videoId-$imageName";

            $cmd = "ffmpeg/ffmpeg -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";

            $outputLog = array();
            exec($cmd, $outputLog, $returnCode);
            
            if($returnCode != 0) {
                //Command failed
                foreach($outputLog as $line) {
                    echo $line . "<br>";
                }
                return false;
            }

            $selected = $num == 1 ? 1 : 0;

            $data = array(
                'videoId' => $videoId,
                'filePath' => $fullThumbnailPath,
                'selected' => $selected
            );
            $this->load->model('VideoUpload/insert_thumbnails');
            $success = $this->insert_thumbnails->index($data);

            if(!$success) {
                echo "Error inserting thumbail\n";
                return false;
            }
        }

        return true;


    }

    private function getVideoDuration($filePath) {

        return (int)shell_exec("ffmpeg/ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");

    }


    private function updateDuration($duration, $videoId) {
        
        $hours = floor($duration / 3600);
        $mins = floor(($duration - ($hours*3600)) / 60);
        $secs = floor($duration % 60);
        
        $hours = ($hours < 1) ? "" : $hours . ":";
        $mins = ($mins < 10) ? "0" . $mins . ":" : $mins . ":";
        $secs = ($secs < 10) ? "0" . $secs : $secs;

        $duration = $hours.$mins.$secs;

       $data = array(
           'duration' => $duration,
           'id' => $videoId
       );

       $this->load->model('VideoUpload/update_video_duration');
       $this->update_video_duration->update_duration($data);

    }

}









?>