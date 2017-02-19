<?php

ob_start();
session_start();

Class User_Authentication extends CI_Controller {
    
    

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_model');
        
    }

    // Show login page
    public function index() {
        // Retrieve session data 
        $session_set_value = $this->session->all_userdata();

        // Check for remember_me data in retrieved session data
        if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
            if ($session_set_value['userType'] == "1") {
                redirect('/PhysicianController/homePhysician');
            } elseif ($session_set_value['userType'] == "2") {
                redirect('/PatientController/homePatient');
            }
        }
        $this->load->view('login_form');
    }

    // Check for user login process
    public function user_login_process() {
        $correctPassword = '';
        $tempPassword = '';

        // Check for validation
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_form');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $data['login_data'] = $this->login_model->getPassword($username);

            if ($data['login_data'] != NULL) {
                foreach ($data['login_data'] as $data) {
                    $usertype = $data->Usertype;
                    $userId = $data->ID;
                    $correctPassword = $data->Password;
                    $tempPassword = $data->TempPassword;
                }
            }




            if(!function_exists('hash_equals'))
            {
                function hash_equals($str1, $str2)
                {
                    if(strlen($str1) != strlen($str2))
                    {
                        return false;
                    }
                    else
                    {
                        $res = $str1 ^ $str2;
                        $ret = 0;
                        for($i = strlen($res) - 1; $i >= 0; $i--)
                        {
                            $ret |= ord($res[$i]);
                        }
                        return !$ret;
                    }
                }
            }
            
         
            if ( hash_equals($correctPassword, crypt($password, $correctPassword)) ) {
                $remember = $this->input->post('remember_me');
                if ($remember) {

                    // Set remember me value in session  
                    $this->session->set_userdata('remember_me', TRUE);
                    $this->session->set_userdata('userType', TRUE);
                }
                $sess_data = array(
                    'username' => $username,
                    'password' => $password,
                );
                $this->session->set_userdata('logged_in', $sess_data);
                $this->session->set_userdata('userId', $userId);


                if ($usertype === '1' || $usertype === '3') {
                    redirect('/PhysicianController/homePhysician');
                } else {
                    redirect('/PatientController/homePatient');
                }
            } elseif ($tempPassword === $password) {
                $remember = $this->input->post('remember_me');
                if ($remember) {

                    // Set remember me value in session  
                    $this->session->set_userdata('remember_me', TRUE);
                    $this->session->set_userdata('userType', TRUE);
                }
                $sess_data = array(
                    'username' => $username,
                    'password' => $password,
                );
                $this->session->set_userdata('logged_in', $sess_data);
                $this->session->set_userdata('userId', $userId);
                $this->session->set_userdata('usertype', $usertype);

                $this->changePassword();
                /* if ($usertype === '1') {
                  redirect('/PhysicianController/profilePhysician');
                  } else {
                  redirect('/PatientController/profilePatient');
                  } */
            } else {
                $message['error_message'] = 'Wrong Password Or Login';
                $this->load->view('login_form', $message);
            }
        }
    }

    public function forgotPassword() {

        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $email = $this->input->post('email');
        if ($email == NULL) {
            $this->load->view('forgotPassword');
        } else {
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                
                $info = $this->login_model->getDataFromEmail($email);

                if ($info != NULL) {
                    $this->load->helper('string');
                    date_default_timezone_set('Europe/Brussels');

                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.groept.be',
                        'smtp_port' => 25,
                        'smtp_user' => 'a15.web04@gmail.com',
                        'smtp_pass' => 'web04_secret',
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );
                    $password = random_string('alnum', 6);
                    $message = 'Hello ' . $info[0]->Firstname . ' ! '
                            . 'Here is your temporary password : ' . $password;
                    $this->load->library('email', $config);

                    $this->email->set_newline("\r\n");

                    $this->email->from('a15.web04@gmail.com', 'Web Apps');
                    $this->email->to('a15.web04@gmail.com');
                    $this->email->subject('Forgotten Password : BeWell@Home');
                    $this->email->message($message);
                    $this->email->send();

                    if ($this->email->send()) {
                        $message_display['message_display'] = 'An email has been sent';
                        $this->login_model->fillTempPassword($info[0]->ID, $password);
                        $this->load->view('login_form', $message_display);
                    } else {
                        //show_error($this->email->print_debugger());
                        $message_display['error_message'] = 'Email not send, connection error';
                        $this->load->view('forgotPassword', $message_display);
                    }

                } else {
                    $message_display['error_message'] = 'Account not found';
                    $this->load->view('forgotPassword', $message_display);
                }
            } else {
                $message_display['error_message'] = 'Not a correct email adress';
                $this->load->view('forgotPassword', $message_display);
            }
        }
    }

    public function changePassword() {
        $this->form_validation->set_rules('password1', 'password1', 'required');
        $this->form_validation->set_rules('password2', 'password2', 'required|matches[password1]');
        $password = $this->input->post('password1');
        $userId = $this->session->userdata('userId');
        $usertype = $this->session->userdata('usertype');
        if ($password != NULL) {
            if ($this->form_validation->run() == FALSE) {
                $message['error_message'] = 'password didnt match';
                $this->load->view('changePassword', $message);
            } else {
                
            //Extra security measures
            // A higher "cost" is more secure but consumes more processing power
            $cost = 10;
            // Create a random salt
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            // Prefix information about the hash so PHP knows how to verify it later.
            // "$2a$" Means we're using the Blowfisdh algorithm. The following two digits are the cost parameter.
            $salt = sprintf("$2a$%02d$", $cost) . $salt;
            // Hash the password with the salt
            $encryptedPassword = crypt($password, $salt);
                
                
                $this->login_model->changePassword($userId, $encryptedPassword );
                if ($usertype === '1') {
                    redirect('/PhysicianController/homePhysician');
                } else {
                    redirect('/PatientController/homePatient');
                }
            }
        } else {
            $this->load->view('changePassword');
        }
    }

}
