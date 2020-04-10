<?php

class Settings extends CI_Controller {

    public function index() {
        $this->load->view('Templates/header',$_SESSION);
        $this->load->view('settings_view');
        $this->load->view('Templates/footer');
    }

    public function userDetailsProcessing(){

        $this->load->helper(array('form','url'));

        $this->load->library('form_validation');

        $userInputs = $this->input->post();

        $_POST['firstName'] = $this->sanitizeFormString($this->input->post("firstName"));
        $_POST['lastName'] = $this->sanitizeFormString($this->input->post("lastName"));
        $_POST['email'] = $this->sanitizeFormEmail($this->input->post("email"));

        $this->form_validation->set_rules('firstName','FirstName','trim|required|alpha|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('lastName','LastName','trim|required|alpha|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run()== FALSE) {

            $this->load->view('Templates/header',$_SESSION);
            $this->load->view('settings_view');
            $this->load->view('Templates/footer');


        }
        else {
            $this->load->model('Users/user_model');
            if($this->user_model->updateUserDetails($userInputs,$_SESSION['username'])) {
                $this->session->set_userdata($userInputs);
                $detailsMessage = array(
                    'detailsMessage' => 'SUCCESS! Details updated'
                );
                $this->load->view('Templates/header',$_SESSION);
                $this->load->view('settings_view',$detailsMessage);
                $this->load->view('Templates/footer');

            }

        }

    }
    public function userPasswordProcessing() {
        $this->load->helper(array('form','url'));

        $this->load->library('form_validation');

        $userInputs = $this->input->post();


        $_POST['oldPassword'] = $this->sanitizeFormPassword($this->input->post("oldPassword"));
        $_POST['newPassword'] = $this->sanitizeFormPassword($this->input->post("newPassword"));
        $_POST['newPassword2'] = $this->sanitizeFormPassword($this->input->post("newPassword2"));

        $this->form_validation->set_rules('newPassword', 'Password', 'trim|required|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('newPassword2', 'Password Confirmation', 'trim|required|matches[newPassword]');

        if($this->form_validation->run()== FALSE) {

            $this->load->view('Templates/header',$_SESSION);
            $this->load->view('settings_view');
            $this->load->view('Templates/footer');


        }
        else {
            $this->load->model('Users/user_model');
            if ($this->user_model->updateUserPasswordDetails($userInputs, $_SESSION['username'])) {
                $this->session->set_userdata($userInputs);
                $passwordMessage = array(
                    'passwordMessage' => 'SUCCESS! Password updated'
                );
                $this->load->view('Templates/header', $_SESSION);
                $this->load->view('settings_view', $passwordMessage);
                $this->load->view('Templates/footer');

            }
            else{
                $passwordMessage = array(
                    'passwordMessage' => 'Failed! Wrong old password'
                );
                $this->load->view('Templates/header', $_SESSION);
                $this->load->view('settings_view', $passwordMessage);
                $this->load->view('Templates/footer');
            }
        }

    }

    public function sanitizeFormString($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText);
        return $inputText;
    }

    public function sanitizeFormPassword($inputText) {
        $inputText = strip_tags($inputText);
        return $inputText;
    }

    public function sanitizeFormEmail($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }


}