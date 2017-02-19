<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ob_start();
session_start();

class PhysicianController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->library('form_validation');
        $this->load->model('Physician_menu_model');
        $this->load->model('data_model');
        $this->load->model('homePhysician_model');
    }

    //not sure if needed
    // Show login page
    public function index() {
        $this->load->view('login_form');
    }

    // Logout from admin page
    public function logout() {
        // Destroying session data
        $this->session->sess_destroy();
        $message['message_display'] = 'Successfully Logout';
        $this->load->view('login_form', $message);
    }

    function homePhysician() {
        $data["page_title"] = 'Home';
        $data["content_title_1"] = 'Home';
        $this->checkAlerts();
        $userId = $this->session->userdata('userId');
        $data2["usersWithAlert"] = array();
        $userType = $this->homePhysician_model->getType($userId);
        if($userType[0]->Usertype == 3){
            $usersWithAlert = $this->homePhysician_model->getPatientsFromEmergency($userType[0]->PhysicianId);
        } else {
            $usersWithAlert = $this->homePhysician_model->getPatientsFromEmergency($userId);
        }
        if($usersWithAlert != NULL)
        {
            foreach ($usersWithAlert as $patient) {
                $pain = $this->data_model->getLatestPain($patient->patientId);
                $weight = $this->data_model->getLatestWeight($patient->patientId);
                $pulse = $this->data_model->getLatestPulse($patient->patientId);
                $blood = $this->data_model->getLatestBlood($patient->patientId);
                if($pain == NULL) {
                    $pain = array();
                    $emptyPain = new stdClass;
                    $emptyPain->painLevel = "none";
                    array_push($pain,  $emptyPain);
                }
                if($weight == NULL) {
                    $weight = array();
                    $emptyWeight = new stdClass;
                    $emptyWeight->weight = "none";
                    array_push($weight,  $emptyWeight);
                }
                if($pulse == NULL) {
                    $pulse = array();
                    $emptyPulse = new stdClass;
                    $emptyPulse->pulse = "none";
                    array_push($pulse,  $emptyPulse);
                }
                if($blood == NULL) {
                    $blood = array();
                    $emptyBlood = new stdClass;
                    $emptyBlood->pressureSystolic = "none";
                    $emptyBlood->pressureDiastolic = "none";
                    array_push($blood,  $emptyBlood);
                }
                $pictureInfo = $this->data_model->getPicture($patient->patientId);
                $picture = $pictureInfo[0]->product_pic;
                $alert = "";
                if($patient->pain){
                    $alert = "pain";
                }
                if($patient->weight){
                    if ($alert != "") {
                        $alert = $alert.", weight";
                    } else {
                        $alert = "weight";
                    }
                }
                if($patient->pulse){
                    if ($alert != "") {
                        $alert = $alert.", pulse";
                    } else {
                        $alert = "pulse";
                    }
                }
                if($patient->blood){
                    if ($alert != "") {
                        $alert = $alert.", blood pressure";
                    } else {
                        $alert = "blood pressure";
                    }
                }
                array_push($data2["usersWithAlert"],  array('Firstname' => $patient->firstName, 'Lastname' => $patient->lastName,'patientId' => $patient->patientId ,'product_pic' => $picture, 'alert' => $alert, 'pain' => $pain[0]->painLevel, 'weight' => $weight[0]->weight, 'pulse' => $pulse[0]->pulse, 'bloodSys' => $blood[0]->pressureSystolic, 'bloodDia' => $blood[0]->pressureDiastolic));
            }
        }
        $data2['namePhysician']= $this->homePhysician_model->getNamePhysician($userId);
        $data["content"] = $this->parser->parse('homePhysician', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('home');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems();
        $this->parser->parse('template', $data);
    }
    
    function checkAlerts() {
        $userId = $this->session->userdata('userId');
        $userType = $this->homePhysician_model->getType($userId);
        if($userType[0]->Usertype == 3){
            $physicianId = $userType[0]->PhysicianId;
        } else {
            $physicianId = $userId;
        }
        $patients = $this->homePhysician_model->getPatients($userId);
        if ($patients != NULL) {
            foreach ($patients as $patient) {
                $dataArray = array(
                    'patientId' => $patient->ID,
                    'physicianId' => $physicianId,
                    'firstName' => $patient->Firstname,
                    'lastName' => $patient->Lastname,
                    'pain' => "0",
                    'weight' => "0",
                    'pulse' => "0",
                    'blood' => "0"
                );
                $pain = $this->checkPain($patient);
                if($pain != NULL) {
                    $dataArray['pain'] = $pain['pain'];
                }
                $weight = $this->checkWeight($patient);
                if($weight != NULL) {
                    $dataArray['weight'] = $weight['weight'];
                }
                $pulse = $this->checkPulse($patient);
                if($pulse != NULL) {
                    $dataArray['pulse'] = $pulse['pulse'];
                }
                $blood = $this->checkBlood($patient);
                if($blood != NULL) {
                    $dataArray['blood'] = $blood['blood'];
                }
                if($dataArray['pain'] == 1 || $dataArray['weight'] == 1 || $dataArray['pulse'] == 1 || $dataArray['blood'] == 1)
                {
                    if($this->homePhysician_model->getPatientFromEmergency($patient->ID) == NULL)
                    {
                        $this->homePhysician_model->insertPatientAllert($dataArray);
                    }
                    else
                    {
                        $this->homePhysician_model->updatePatientAllert($patient->ID, $dataArray);
                    }
                }
                else
                {
                    if($this->homePhysician_model->getPatientFromEmergency($patient->ID) != NULL)
                    {
                        $this->homePhysician_model->deletePatientAllert($patient->ID);
                    }
                }
            }
        }
    }

    function checkPain($patient) {
        $thresholds = $this->homePhysician_model->getThresholdsPatient($patient->ID);
        $pain = $this->data_model->getLatestPain($patient->ID);
        if($pain != NULL && $thresholds != NULL)
        {
            if ($thresholds[0]->painDown > $pain[0]->painLevel || $thresholds[0]->painUp < $pain[0]->painLevel) {
                $dataArray = array(
                    'patientId' => $patient->ID,
                    'firstName' => $patient->Firstname,
                    'lastName' => $patient->Lastname,
                    'pain' => "1"
                );
                return $dataArray;
            }
        }
    }
    
    function checkWeight($patient) {
        $thresholds = $this->homePhysician_model->getThresholdsPatient($patient->ID);
        $weight = $this->data_model->getLatestWeight($patient->ID);
        if($weight != NULL && $thresholds != NULL)
        {
            if ($thresholds[0]->weightDown > $weight[0]->weight || $thresholds[0]->weightUp < $weight[0]->weight) {
                $dataArray = array(
                    'patientId' => $patient->ID,
                    'firstName' => $patient->Firstname,
                    'lastName' => $patient->Lastname,
                    'weight' => "1"
                );
                return $dataArray;
            }
        }
    }
    
    function checkPulse($patient) {
        $thresholds = $this->homePhysician_model->getThresholdsPatient($patient->ID);
        $pulse = $this->data_model->getLatestPulse($patient->ID);
        if($pulse != NULL && $thresholds != NULL)
        {
            if ($thresholds[0]->pulseDown > $pulse[0]->pulse || $thresholds[0]->pulseUp < $pulse[0]->pulse) {
                $dataArray = array(
                    'patientId' => $patient->ID,
                    'firstName' => $patient->Firstname,
                    'lastName' => $patient->Lastname,
                    'pulse' => "1"
                );
                return $dataArray;
            }
        }
    }
    
    function checkBlood($patient) {
        $thresholds = $this->homePhysician_model->getThresholdsPatient($patient->ID);
        $blood = $this->data_model->getLatestBlood($patient->ID);
        if($blood != NULL && $thresholds != NULL)
        {
            if ($thresholds[0]->sysDown > $blood[0]->pressureSystolic || $thresholds[0]->sysUp < $blood[0]->pressureSystolic || $thresholds[0]->diaDown > $blood[0]->pressureDiastolic || $thresholds[0]->diaUp < $blood[0]->pressureDiastolic) {
                echo $thresholds[0]->sysDown;
                echo $blood[0]->pressureSystolic;
                echo $thresholds[0]->sysUp;
                //echo
                $dataArray = array(
                    'patientId' => $patient->ID,
                    'firstName' => $patient->Firstname,
                    'lastName' => $patient->Lastname,
                    'blood' => "1"
                );
                return $dataArray;
            }
        }
    }

    function patientsPhysician() {
        $data["page_title"] = 'patients';
        $data["content_title_1"] = 'Patients';
        $this->load->model('patientsPhysician_model');
        $userId = $this->session->userdata('userId');
        $userType = $this->homePhysician_model->getType($userId);
        if($userType[0]->Usertype == 3){
            $data2['allPatients'] = $this->patientsPhysician_model->getPatients($userType[0]->PhysicianId);
        } else {
            $data2['allPatients'] = $this->patientsPhysician_model->getPatients($userId);
        }
        if($data2['allPatients'] == null)
        {
            $data2['allPatients'] = array();
        }
        $data["content"] = $this->parser->parse('patientsPhysician', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('patients');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('patients');
        $this->parser->parse('template', $data);
    }
    
    function changePatient() {
        $patientId = $this->input->post('idPatient');
        $data3 = array(
                    'painDown' => $this->input->post('painDown'),
                    'painUp' => $this->input->post('painUp'),
                    'weightDown' => $this->input->post('weightDown'),
                    'weightUp' => $this->input->post('weightUp'),
                    'pulseDown' => $this->input->post('pulseDown'),
                    'pulseUp' => $this->input->post('pulseUp'),
                    'sysDown' => $this->input->post('pressureSysDown'),
                    'sysUp' => $this->input->post('pressureSysUp'),
                    'diaDown' => $this->input->post('pressureDiaDown'),
                    'diaUp' => $this->input->post('pressureDiaUp'),
                    'oxygenDown' => $this->input->post('oxygenDown'),
                    'oxygenUp' => $this->input->post('oxygenUp')
                );
        $this->data_model->updateThresholds($patientId, $data3);
        $data["page_title"] = 'patients';
        $data["content_title_1"] = 'Patients';
        $this->load->model('patientsPhysician_model');
        $data2['allPatients'] = $this->patientsPhysician_model->getPatients();
        $data2["succesMessage"] = 'yes';
        $data["content"] = $this->parser->parse('patientsPhysician', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('patients');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('patients');
        $this->parser->parse('template', $data);
        
    }
    
    function changePatientHome() {
        $patientId = $this->input->post('idPatient');
        $data = array(
                    'painDown' => $this->input->post('painDown'),
                    'painUp' => $this->input->post('painUp'),
                    'weightDown' => $this->input->post('weightDown'),
                    'weightUp' => $this->input->post('weightUp'),
                    'pulseDown' => $this->input->post('pulseDown'),
                    'pulseUp' => $this->input->post('pulseUp'),
                    'sysDown' => $this->input->post('pressureSysDown'),
                    'sysUp' => $this->input->post('pressureSysUp'),
                    'diaDown' => $this->input->post('pressureDiaDown'),
                    'diaUp' => $this->input->post('pressureDiaUp'),
                    'oxygenDown' => $this->input->post('oxygenDown'),
                    'oxygenUp' => $this->input->post('oxygenUp')
                );
        $this->data_model->updateThresholds($patientId, $data);
        redirect('/PhysicianController/homePhysician', 'refresh');
    }
    
    function overviewPatient($userId) {
        $data["page_title"] = 'Overview Patient';
        $data["content_title_1"] = 'Overview Patient';
        $data2['pressure_data'] = $this->data_model->getBloodpressureinfo($userId);
        $data2['weight_data'] = $this->data_model->getWeightinfo($userId);
        $data2['pain_data'] = $this->data_model->getPaininfo($userId);
        $data2['activity_data'] = $this->data_model->getActivityinfo($userId);
        $data2['oxygen_data'] = $this->data_model->getOxygeninfo($userId);
        $data2["patient"] = $this->data_model->getName($userId);  
        $data["content"] = $this->parser->parse('overviewPatient', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('data');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('data');
        $this->parser->parse('templateOverviewPatient', $data);
    }   
    
    function dataPhysician() {
        $data["page_title"] = 'data';
        $data["content_title_1"] = 'Data';
        $data["content_title_2"] = 'This is the data';
        $data2["patient"] = 'Mary';
        $data["content"] = $this->parser->parse('dataPhysician', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('data');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('data');
        $this->parser->parse('template', $data);
    }

    function managePhysician() {
        $data["page_title"] = 'manage';
        $data["content_title_1"] = 'Manage';
        $data["content_title_2"] = 'This is the managescreen';
        $userId = $this->session->userdata('userId');
        
        $data2[] = array();
        $assistants = $this->data_model->getPhysicianAssistants($userId);
        if($assistants != NULL) {
            $data2["assistants"] = $assistants;
        }
        $data["content"] = $this->parser->parse('managePhysician', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('data');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('manage');
        $this->parser->parse('template', $data);
    }
    
    function deleteAssistantOfPhysician($assistantId){
        $this->data_model->deleteAssistantOfAPhysician($assistantId);
        redirect('/PhysicianController/managePhysician', 'refresh');
    }
    
    function profilePhysician() {
        $this->load->model('login_model');
        $data["page_title"] = 'profile';
        $data["content_title_1"] = 'Profile';
        $userId = $this->session->userdata('userId');
        
        $assistants = $this->data_model->getPhysicianAssistants($userId);
        if($assistants != NULL) {
            $data2["assistants"] = $assistants;
        }
        
        $data2["info"] = $this->data_model->getPhysicianProfile($userId);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('profile');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('profile');
        
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('height', 'height', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        if($this->input->post('password') != NULL || $this->input->post('password1') != NULL || $this->input->post('password2') != NULL) {
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('password1', 'password1', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'password2', 'required');
        }
        
        if($this->input->post('firstname') != NULL) {
            $error = 0;
            $passwords = $this->login_model->getPasswordFromId($userId);
            $oldPassword = $this->input->post('password');
            if ($oldPassword != NULL) {
                $correctPassword = $passwords[0]->Password;
                if (hash_equals($correctPassword, crypt($oldPassword, $correctPassword))) {
                    //Extra security measures
                    // A higher "cost" is more secure but consumes more processing power
                    $cost = 10;
                    // Create a random salt
                    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
                    // Prefix information about the hash so PHP knows how to verify it later.
                    // "$2a$" Means we're using the Blowfisdh algorithm. The following two digits are the cost parameter.
                    $salt = sprintf("$2a$%02d$", $cost) . $salt;
                    // Hash the password with the salt
                    $encryptedPassword = crypt($this->input->post('password1'), $salt);
                }
                else {
                    $error = 1;
                }
            } else {
                $encryptedPassword = $passwords[0]->Password;
            }
            if ($this->form_validation->run() != FALSE && $error == 0) {
                $data3 = array(
                    'Firstname' => $this->input->post('firstname'),
                    'Lastname' => $this->input->post('lastname'),
                    'Gender' => $this->input->post('gender'),
                    'Height' => $this->input->post('height'),
                    'Birthday' => $this->input->post('birthday'),
                    'Email' => $this->input->post('email'),
                    'Password' => $encryptedPassword
                );
                $this->data_model->updateProfile($userId, $data3);
                $data2["message_display"] = "Profile changed";
                $data2["info"] = $this->data_model->getPhysicianProfile($userId);
                $data["content"] = $this->parser->parse('profilePhysician', $data2, true);
            }
            else {
                $data2["error_message"] = "Failed: wrong input";
                $data["content"] = $this->parser->parse('profilePhysician', $data2, true);
            }
        }
        else {
            $data["content"] = $this->parser->parse('profilePhysician', $data2, true);
        }
        $this->parser->parse('template', $data);
    }
    
    function upload_file() {
        $status = "";
        $msg = "";
        $filename = "product_pic";

        /*if (empty($_POST['firstname'])) {
            $status = "error";
            $msg = "Please Enter title";
        }*/

        $image_path = realpath(APPPATH . '../imagefolder/');

        if ($status != "error") {

            $config['upload_path'] = $image_path;
           // echo $config["upload_path"];
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($filename)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $this->load->model('data_model');
                $data = $this->upload->data();
                $file_id = $this->data_model->insert_file($data['file_name'], $this->session->userdata('userId'));
                if ($file_id) {
                    redirect('PhysicianController/profilePhysician');
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "please try again";
                }
            }
            @unlink($_FILES[$filename]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function surveyPhysician() {
        $this->load->model('survey_model');
        $data["page_title"] = 'Survey';
        $data["content_title"] = 'Survey';
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('survey');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('survey');
        $this->form_validation->set_rules('patientId', 'patientId', 'required');
        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('option1', 'option1', 'required');
        $this->form_validation->set_rules('option2', 'option2', 'required');
        $this->form_validation->set_rules('option3', 'option3', 'required');
        if($this->input->post('question') != NULL) {
            if ($this->form_validation->run() == FALSE) {
                $data2["failed"] = 'yes';
                $data["content"] = $this->parser->parse('surveyPhysician', $data2, true);
            } else {
                $string = $this->input->post('patientId');
                $idArray = explode(',', $string);
                foreach ($idArray as $value) {
                    $dataArray = array(
                        'patientId' => $value,
                        'question' => $this->input->post('question'),
                        'option1' => $this->input->post('option1'),
                        'option2' => $this->input->post('option2'),
                        'option3' => $this->input->post('option3')
                    );
                    $this->survey_model->insertQuestion($dataArray);
                    $this->data_model->updateTaskWithId($value, 'Do survey', '0');
                }
                $data2["succes"] = 'yes';
                $data["content"] = $this->parser->parse('surveyPhysician', $data2, true);
            }
        }
        else {
            $data2["first"] = 'yes';
            $data["content"] = $this->parser->parse('surveyPhysician', $data2, true);
        }
        $this->parser->parse('template', $data);
    }

    function registerPhysician() {
        $data["page_title"] = 'Register';
        $data["content_title"] = 'Profile';
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('register patient');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('register patient');
        //$this->form_validation->set_rules('usertype', 'usertype', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('firstName', 'firstName', 'required');
        $this->form_validation->set_rules('lastName', 'lastName', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'required');
        $this->form_validation->set_rules('height', 'height', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password1', 'password1', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'password2', 'required');
        
        $userId = $this->session->userdata('userId');
        $userType = $this->homePhysician_model->getType($userId);
        if($userType[0]->Usertype == 3){
            $physicianId = $userType[0]->PhysicianId;
        } else {
            $physicianId = $userId;
        }
        
        $check = $this->input->post('username');
        if($check != NULL) {
            if ($this->form_validation->run() == FALSE) {
                $message["error_message"] = 'Register Patient failed: Wrong input ';
                $data["content"] = $this->parser->parse('managePhysician', $message, true);
            } else {
                date_default_timezone_set('Europe/Brussels');
                $string = $this->input->post ('birthday');
                $date = new DateTime($string);
                $newDate = $date->format("Y-m-d");
                
             //Extra security measures
            // A higher "cost" is more secure but consumes more processing power
            $cost = 10;
            // Create a random salt
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            // Prefix information about the hash so PHP knows how to verify it later.
            // "$2a$" Means we're using the Blowfisdh algorithm. The following two digits are the cost parameter.
            $salt = sprintf("$2a$%02d$", $cost) . $salt;
            // Hash the password with the salt
            $encryptedPassword = crypt($this->input->post('password1'), $salt);
                
                
                $dataArray = array(
                    'Usertype' => '2',
                    'Username' => $this->input->post('username'),
                    'PhysicianId' => $physicianId,
                    'Firstname' => $this->input->post('firstName'),
                    'Lastname' => $this->input->post('lastName'),
                    'Gender' => $this->input->post('gender'),
                    'Birthday' => $newDate,
                    'Height' => $this->input->post('height'),
                    'Email' => $this->input->post('email'),
                    'Password' => $encryptedPassword
                );
                
                $patientId = $this->data_model->insertPatient($dataArray);
                //make tasks for the patient
                $this->data_model->makeTasks($patientId);
                //add the patient to the person table
                $this->data_model->insertPerson($patientId, $dataArray);
                //add thresholds for the patient
                $threshold = array(
                    'patientId' => $patientId,
                    'painDown' => $this->input->post('painDown'),
                    'painUp' => $this->input->post('painUp'),
                    'weightDown' => $this->input->post('weightDown'),
                    'weightUp' => $this->input->post('weightUp'),
                    'pulseDown' => $this->input->post('pulseDown'),
                    'pulseUp' => $this->input->post('pulseUp'),
                    'sysDown' => $this->input->post('pressureSysDown'),
                    'sysUp' => $this->input->post('pressureSysUp'),
                    'diaDown' => $this->input->post('pressureDiaDown'),
                    'diaUp' => $this->input->post('pressureDiaUp'),
                    'oxygenDown' => $this->input->post('oxygenDown'),
                    'oxygenUp' => $this->input->post('oxygenUp')
                );
                
                $this->data_model->insertThresholds($threshold);
                $data2["succes"] = "The patient has been added";          
                
                $data["content"] = $this->parser->parse('managePhysician', $data2, true);
            }
        } else {
            $data2["patient"] = 'Maki';
            //$data2["error_message"] = "nothing enterd";
            $data["content"] = $this->parser->parse('managePhysician', $data2, true);
        }
        $this->parser->parse('template', $data);
    }
    
    function registerPhysicianStaffMember() {
        $data["page_title"] = 'Register';
        $data["content_title"] = 'Profile';
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('register patient');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('register patient');
        //$this->form_validation->set_rules('usertype', 'usertype', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('firstName', 'firstName', 'required');
        $this->form_validation->set_rules('lastName', 'lastName', 'required');
        $this->form_validation->set_rules('genderStaff', 'genderStaff', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password1', 'password1', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'password2', 'required');

        $check = $this->input->post('username');
        if($check != NULL) {
            if ($this->form_validation->run() == FALSE) {
                $message["error_message"] = 'Register Staff Member failed: Wrong input';
                $data["content"] = $this->parser->parse('managePhysician', $message, true);
            } else {
                date_default_timezone_set('Europe/Brussels');
                $string = $this->input->post ('birthday');
                $date = new DateTime($string);
                $newDate = $date->format("Y-m-d");
                
             //Extra security measures
            // A higher "cost" is more secure but consumes more processing power
            $cost = 10;
            // Create a random salt
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            // Prefix information about the hash so PHP knows how to verify it later.
            // "$2a$" Means we're using the Blowfisdh algorithm. The following two digits are the cost parameter.
            $salt = sprintf("$2a$%02d$", $cost) . $salt;
            // Hash the password with the salt
            $encryptedPassword = crypt($this->input->post('password1'), $salt);
                
                
                $dataArray = array(
                    'Usertype' => '3',
                    'Username' => $this->input->post('username'),
                    'PhysicianId' => $this->session->userdata('userId'),
                    'Firstname' => $this->input->post('firstName'),
                    'Lastname' => $this->input->post('lastName'),
                    'Gender' => $this->input->post('genderStaff'),
                    'Birthday' => $newDate,
                    'Email' => $this->input->post('email'),
                    'Password' => $encryptedPassword
                );
                
                $patientId = $this->data_model->insertPatient($dataArray);
                //make tasks for the patient
                $this->data_model->makeTasks($patientId);
                //add the patient to the person table
                $this->data_model->insertPerson($patientId, $dataArray);
                //add thresholds for the patient
                
                $data2["succes"] = "The staff member has been added";
                $data["content"] = $this->parser->parse('managePhysician', $data2, true);
            }
        } else {
            $data2["patient"] = 'Maki';
            //$data2["error_message"] = "nothing enterd";
            $data["content"] = $this->parser->parse('managePhysician', $data2, true);
        }
        $this->parser->parse('template', $data);
    }
    
    function getPatient($id) {
        $this->load->model('queryPatient_model');
        echo json_encode($this->queryPatient_model->getUser($id));
    }

    function getPatientGroup($table, $parameter1, $parameter2, $valueLesser, $valueGreater) {
        $this->load->model('queryPatient_model');
        echo json_encode($this->queryPatient_model->getPatientsWhereQuery($table, $parameter1, $parameter2, $valueLesser, $valueGreater));
    }
    
    function getThresholdsPaptient($patientId){
        //$this->load->model('queryPatient_model');
        echo json_encode($this->data_model->getThresholds($patientId));
    }
       
    function sendMessage() {
        

        $this->load->model('patientsPhysician_model');
        $data["page_title"] = 'patients';
        $data2['allPatients'] = $this->patientsPhysician_model->getPatients();
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('patients');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems('patients');
        $this->form_validation->set_rules('patientId', 'patientId', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data2["failedMessage"] = 'yes';
                    $data["content"] = $this->parser->parse('patientsPhysician', $data2, true);
        } else {
                $dataArray = array(
                    'patientId' => $this->input->post('patientId'),
                    'title' => $this->input->post('title'),
                    'message' => $this->input->post('message'),
                );
                $this->data_model->insertMessage($dataArray);
            $data2["succesMessage"] = 'yes';
            $data["content"] = $this->parser->parse('patientsPhysician', $data2, true);
        }
        $this->parser->parse('template', $data);
    }
    
    function sendMessageHome() {
        $this->load->model('patientsPhysician_model');
        $data["page_title"] = 'Home';
        $data["content_title_1"] = 'Home';
        $this->checkAlerts();
        $userId = $this->session->userdata('userId');
        $data2["usersWithAlert"] = array();
        $usersWithAlert = $this->homePhysician_model->getPatientsFromEmergency();
        if($usersWithAlert != NULL)
        {
            foreach ($usersWithAlert as $patient) {
                $pain = $this->data_model->getLatestPain($patient->patientId);
                $weight = $this->data_model->getLatestWeight($patient->patientId);
                $pulse = $this->data_model->getLatestPulse($patient->patientId);
                $blood = $this->data_model->getLatestBlood($patient->patientId);
                if($pain == NULL) {
                    $pain = array();
                    $emptyPain = new stdClass;
                    $emptyPain->weight = "none";
                    array_push($pain,  $emptyPain);
                }
                if($weight == NULL) {
                    $weight = array();
                    $emptyWeight = new stdClass;
                    $emptyWeight->weight = "none";
                    array_push($weight,  $emptyWeight);
                }
                if($pulse == NULL) {
                    $pulse = array();
                    $emptyPulse = new stdClass;
                    $emptyPulse->pulse = "none";
                    array_push($pulse,  $emptyPulse);
                }
                if($blood == NULL) {
                    $blood = array();
                    $emptyBlood = new stdClass;
                    $emptyBlood->pressureSystolic = "none";
                    $emptyBlood->pressureDiastolic = "none";
                    array_push($blood,  $emptyBlood);
                }
                $pictureInfo = $this->data_model->getPicture($patient->patientId);
                $picture = $pictureInfo[0]->product_pic;
                $alert = "";
                if($patient->pain){
                    $alert = "pain";
                }
                if($patient->weight){
                    if ($alert != "") {
                        $alert = $alert.", weight";
                    } else {
                        $alert = "weight";
                    }
                }
                if($patient->pulse){
                    if ($alert != "") {
                        $alert = $alert.", pulse";
                    } else {
                        $alert = "pulse";
                    }
                }
                if($patient->blood){
                    if ($alert != "") {
                        $alert = $alert.", blood pressure";
                    } else {
                        $alert = "blood pressure";
                    }
                }
                array_push($data2["usersWithAlert"],  array('Firstname' => $patient->firstName, 'Lastname' => $patient->lastName,'patientId' => $patient->patientId ,'product_pic' => $picture, 'alert' => $alert, 'pain' => $pain[0]->painLevel, 'weight' => $weight[0]->weight, 'pulse' => $pulse[0]->pulse, 'bloodSys' => $blood[0]->pressureSystolic, 'bloodDia' => $blood[0]->pressureDiastolic));
            }
        }
        $data2['namePhysician']= $this->homePhysician_model->getNamePhysician($userId);
        $data["content"] = $this->parser->parse('homePhysician', $data2, true);
        $data["menu_items_logout"] = $this->Physician_menu_model->get_menuitems_logout();
        $data["menu_items_profile"] = $this->Physician_menu_model->get_menuitems_profile('home');
        $data["menu_items"] = $this->Physician_menu_model->get_menuitems();
        $this->form_validation->set_rules('patientId', 'patientId', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data2["failedMessage"] = 'yes';
                    $data["content"] = $this->parser->parse('homePhysician', $data2, true);
        } else {
                $dataArray = array(
                    'patientId' => $this->input->post('patientId'),
                    'title' => $this->input->post('title'),
                    'message' => $this->input->post('message'),
                );
                $this->data_model->insertMessage($dataArray);
            $data2["succesMessage"] = 'yes';
            $data["content"] = $this->parser->parse('homePhysician', $data2, true);
        }
        $this->parser->parse('template', $data);
    }
    
    
    function getBloodData($id, $nrData)
    {
        $this->load->model('dataPhysician_model');
        echo json_encode($this->dataPhysician_model->getBloodpressureData($id, $nrData));
    }   
    
    function getWeightData($id, $nrData)
    {
        $this->load->model('dataPhysician_model');
        echo json_encode($this->dataPhysician_model->getWeightData($id, $nrData));
    }   
    
    function getActivityData($id, $nrData)
    {
        $this->load->model('dataPhysician_model');
        echo json_encode($this->dataPhysician_model->getActivityData($id, $nrData));
    }   
    
    function getPainData($id, $nrData)
    {
        $this->load->model('dataPhysician_model');
        echo json_encode($this->dataPhysician_model->getPainData($id, $nrData));
    }   
    
     function getOxygenData($id, $nrData)
    {
        $this->load->model('dataPhysician_model');
        echo json_encode($this->dataPhysician_model->getOxygenData($id, $nrData));
    }   
    
        public function deletePatient($data) {
        $this->data_model->deletePatient($data);
    }
}
