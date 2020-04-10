<?php

class Users extends CI_Controller {

/**** SIGNUP SECTION START HERE
*****/

    public function signup() {
        // echo "This is a Users Controller";
        $this->load->view('Templates/header');
        $this->load->view('Users/signup_view');
        $this->load->view('Templates/footer');

    }


    public function signupProcessing() {

        $this->load->helper(array('form','url'));

        $this->load->library('form_validation');

        $config['global_xss_filtering'] = TRUE;
        
        $userInputs = $this->input->post();

        $_POST['firstName'] = $this->sanitizeFormString($this->input->post("firstName"));
        $_POST['lastName'] = $this->sanitizeFormString($this->input->post("lastName"));

        $_POST['username'] = $this->sanitizeFormUsername($this->input->post("username"));

        $_POST['email'] = $this->sanitizeFormEmail($this->input->post("email"));
        $_POST['email2'] = $this->sanitizeFormEmail($this->input->post("email2"));

        $_POST['password'] = $this->sanitizeFormPassword($this->input->post("password"));
        $_POST['password2'] = $this->sanitizeFormPassword($this->input->post("password2"));

        $this->form_validation->set_rules('firstName','FirstName','trim|required|alpha|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('lastName','LastName','trim|required|alpha|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('username','Username','trim|required|alpha|min_length[2]|max_length[25]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('email2', 'Email Confirmation', 'trim|required|matches[email]');
        if($this->form_validation->run()== FALSE) {

            $this->load->view('Templates/header');
            $this->load->view('Users/signup_view');
            $this->load->view('Templates/footer');
                

        }
        else {

        

            $this->load->model('Users/user_model');

            if($this->user_model->create_user($_POST)) {
              
                //STORE THE USER DATA IN SESSION
                // $this->session->sess_destroy();
                $this->session->set_userdata($userInputs);
                // echo '<pre>'; print_r($this->session->all_userdata());
                redirect('Users/login');


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

    public function sanitizeFormUsername($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
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

/***** SIGNUP SECTION ENDS HERE
***/


/***** LOGIN SECTION START HERE
***/

    public function login() {
        
        $this->load->view('Templates/header');
        $this->load->view('Users/login_view');
        $this->load->view('Templates/footer');

    }

    // Check for USER LOGIN PROCESS
    public function loginProcessing() {

        $this->load->library('form_validation');

        //SANITIZE THE USER INPUT FIRST
        $_POST['username'] = $this->sanitizeFormUsername($this->input->post("username"));
        $_POST['password'] = $this->sanitizeFormPassword($this->input->post("password"));

        //CHECK USER INPUT FOR USER INPUT IN SIGNUP FORM
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric');

        if($this->form_validation->run()==FALSE) {

            $this->load->view('Templates/header');
            $this->load->view('Users/login_view');
            $this->load->view('Templates/footer');

        }
        else {

            //USER INPUT IS CLEAN AND ACCEPTABLE 

            $this->load->model('Users/user_model');

            $data = array(

                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')

            );

            //CHECK IF USER IS REGISTERED OR NOT
            $result = $this->user_model->validate_user($data);

            if(!$result) {

                $error =  array(

                    'error_message' => 'Invalid Username or Password'

                );

                $this->load->view('Templates/header');
                $this->load->view('Users/login_view',$error);
                $this->load->view('Templates/footer');

            }

            else {
 
                //WE FOUND USER IS REGISTERED
                
                //STORE THE USER DATA IN SESSION
                
                $result = $this->user_model->get_user_information($data['username']);

                //Find username which User loogedIn subscribed
                $subsName = $this->userLoggedInSubscribeTo($data['username']);
                $userLoggedInSubscriberData = array();
                foreach ($subsName as $sub){
                    $userLoggedInSubscriberData[$sub->userTo] = $this->getProfilePic($sub->userTo);
                }

                //Here $result is an array of object!
                $userData = array(

                    'firstName' => $result[0]->firstName,
                    'lastName' => $result[0]->lastName,
                    'username' => $result[0]->username,
                    'email' => $result[0]->email,
                    'profilePic'=> $result[0]->profilePic,
                     'subscriptions' => $userLoggedInSubscriberData
                );



                $this->session->set_userdata($userData);
//                 echo '<pre>'; print_r($this->session->all_userdata());
//                 die();
                redirect(base_url('home'));
                 die();

            }



        }


    }

    public function userLoggedInSubscribeTo($username) {
        $this->load->model('Users/user_model');
        $subscribers = $this->user_model->getSubscription($username);
        return $subscribers;
    }

    public function getProfilePic($username) {
        $this->load->model('Users/user_model');
        $result = $this->user_model->get_user_information($username);
        return $result[0]->profilePic;
    }

    /***** LOGIN SECTION END HERE
     ***/

    /***** LOGOUT SECTION START HERE
     ***/

    public function logout() {

        if(session_destroy()){

            redirect(base_url('home'));

        }
    
    }
    /***** LOGIN SECTION END HERE
     ***/






}


?>