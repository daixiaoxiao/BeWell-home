<?php

ob_start();
session_start();

class PatientController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->library('form_validation');
        $this->load->model('Patient_menu_model');
        $this->load->model('data_model');
    }

    function homePatient() {
        $data["page_title"] = 'Home';
        $data["numberOfMessages"] = 'Home';
        $data["content_title_1"] = 'Home';
        $data["content_title_2"] = 'This is the homescreen';
        $userId = $this->session->userdata('userId');
        $data2['pressure_data'] = $this->data_model->getBloodpressureinfo($userId);
        $data2['weight_data'] = $this->data_model->getWeightinfo($userId);
        $data2['pain_data'] = $this->data_model->getPaininfo($userId);
        $data2['activity_data'] = $this->data_model->getActivityinfo($userId);
        $data2['oxygen_data'] = $this->data_model->getOxygeninfo($userId);
        $data2["patient"] = $this->data_model->getName($userId);

        $this->load->model('survey_model');
        $check = $this->survey_model->getQuestion($userId);
        //$data2['questions'] = array();
        if ($check == NULL) {
            $this->data_model->updateTaskWithLink($userId, 'surveyPatient');
        }

        $data2["todo"] = array();
        $data2["manual"] = array();
        $data2["done"] = array();

        $data3 = $this->data_model->getTasks($userId);
        if ($data3 != NULL) {
            $this->checkMeasurementData($data3);
            foreach ($data3 as $data4) {
                $time = $data4->time;
                $curtime = time();
                if (abs($curtime - $time) < 86400) {
                    if ($data4->done == '1') {
                        array_push($data2["done"], array('idTask' => $data4->idTask, 'task' => $data4->task));
                    } else {
                        if ($data4->button == 'Manual') {
                            array_push($data2["manual"], array('idTask' => $data4->idTask, 'task' => $data4->task, 'link' => $data4->link, 'button' => $data4->button));
                        } else {
                            array_push($data2["todo"], array('idTask' => $data4->idTask, 'task' => $data4->task, 'link' => $data4->link, 'button' => $data4->button));
                        }
                    }
                } else { //older then 24 hours
                    if ($data4->button == 'Manual') {
                        array_push($data2["manual"], array('idTask' => $data4->idTask, 'task' => $data4->task, 'link' => $data4->link, 'button' => $data4->button));
                    } else {
                        array_push($data2["todo"], array('idTask' => $data4->idTask, 'task' => $data4->task, 'link' => $data4->link, 'button' => $data4->button));
                    }
                    $this->data_model->updateTask($data4->idTask, '0');
                }
            }
        }
        $data["content"] = $this->parser->parse('homePatient', $data2, true);
        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('home');
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
        $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems();
        
        $this->parser->parse('templatePatient', $data);
    }

    function checkMeasurementData($data) {
        $userId = $this->session->userdata('userId');
        $curtime = time();
        if ($data != NULL) {
            foreach ($data as $temp) {
                switch ($temp->link) {
                    case "measurementBlood":
                        $blood = $this->data_model->getBloodpressureTime($userId);
                        if ($blood != NULL) {
                            foreach ($blood as $date) {
                                $time = $date->timestamp;
                                if (abs($curtime - $time) < 86400) {
                                    $temp->done = '1';
                                    $this->data_model->updateTask($temp->idTask, '1');
                                }
                            }
                        }
                        break;
                    case "measurementOxygen":
                        $oxygen = $this->data_model->getOxygenTime($userId);
                        if ($oxygen != NULL) {
                            foreach ($oxygen as $date) {
                                $time = $date->timestamp;
                                if (abs($curtime - $time) < 86400) {
                                    $temp->done = '1';
                                    $this->data_model->updateTask($temp->idTask, '1');
                                }
                            }
                        }
                        break;
                    case "measurementWeight":
                        $weight = $this->data_model->getWeightTime($userId);
                        if ($weight != NULL) {
                            foreach ($weight as $date) {
                                $time = $date->timestamp;
                                if (abs($curtime - $time) < 86400) {
                                    $temp->done = '1';
                                    $this->data_model->updateTask($temp->idTask, '1');
                                }
                            }
                        }
                        break;
                    //case "measurementSleep":
                    //    $sleep =
                    //    break;
                }
            }
        }
    }

    function historyBlood() {
        $data["page_title"] = 'History Blood Pressure';
        $data["content_title_1"] = 'History Blood Pressure Measurements';
        $userId = $this->session->userdata('userId');
        $data2['pressure_data'] = $this->data_model->getBloodpressureinfo($userId);
        $data["content"] = $this->parser->parse('historyBlood', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
        $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();
        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function historyOxygen() {
        $data["page_title"] = 'History Oxygen';
        $data["content_title_1"] = 'History Oxygen Measurements';
        $userId = $this->session->userdata('userId');
        $data2['oxygen_data'] = $this->data_model->getOxygeninfo($userId);
        $data["content"] = $this->parser->parse('historyOxygen', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function historySleep() {
        $data["page_title"] = 'History Sleep';
        $data["content_title_1"] = 'History Sleep Measurements';
        $userId = $this->session->userdata('userId');
        $data2['activity_data'] = $this->data_model->getActivityinfo($userId);
        $data["content"] = $this->parser->parse('historySleep', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function historyWeight() {
        $data["page_title"] = 'History Weight';
        $data["content_title_1"] = 'History Weight Measurements';
        $userId = $this->session->userdata('userId');
        $data2['weight_data'] = $this->data_model->getWeightinfo($userId);
        $data["content"] = $this->parser->parse('historyWeight', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function measurementBlood() {
        $data["page_title"] = 'Blood Pressure';
        $data["content_title_1"] = 'Measurements';
        $data2["patient"] = 'Maki';
        $data["content"] = $this->parser->parse('measurementBlood', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function measurementOxygen() {
        $data["page_title"] = 'Oxygen';
        $data["content_title_1"] = 'Measurements';
        $data2["patient"] = 'Maki';
        $data["content"] = $this->parser->parse('measurementOxygen', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function measurementWeight() {
        $data["page_title"] = 'Weight';
        $data["content_title_1"] = 'Measurements';
        $data2["patient"] = 'Maki';
        $data["content"] = $this->parser->parse('measurementWeight', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function measurementSleep() {
        $data["page_title"] = 'Sleep';
        $data["content_title_1"] = 'Measurements';
        $data2["patient"] = 'Maki';
        $data["content"] = $this->parser->parse('measurementSleep', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');
        $this->parser->parse('templatePatient', $data);
    }

    function painPatient() {
        $data["page_title"] = 'Pain';
        $data["content_title_1"] = 'Pain';
        $data["content_title_2"] = 'This is the Pain';
        $this->load->model('data_model');
        $userId = $this->session->userdata('userId');
        //$data2['date'] = time();
        //$data2['pain_data'] = $this->data_model->getPaininfo($userId);
        date_default_timezone_set('Europe/Brussels');
        $data2['today'] = date("d/m/Y");
        $data2['pain_data'] = $this->data_model->getPaininfoDate($userId, time());
        $check = $this->data_model->getHistoryPain($userId, time());
        if ($check != NULL) {
            $data2['history'] = $check;
        } else {
            $data2['history'] = array();
        }
        $data["content"] = $this->parser->parse('painPatient', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('pain diary');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('pain diary');
        $this->parser->parse('templatePatient', $data);
        ;
    }

    function getPainDataTime($time) {
        $userId = $this->session->userdata('userId');
        //echo json_encode($this->data_model->getPaininfoDate($userId, $time));
        echo json_encode($this->data_model->getPaininfoUnix($userId, $time));
    }

    function getHistoryPain($time) {
        $userId = $this->session->userdata('userId');
        echo json_encode($this->data_model->getHistoryPain($userId, $time));
    }

    function updatePain() {
        $userId = $this->session->userdata('userId');
        $pain = $this->input->post('pain');
        $remark = $this->input->post('comment');
        $data = array(
            'patientId' => $userId,
            'painLevel' => $pain,
            'remark' => $remark,
            'timestamp' => time()
        );
        $this->data_model->insertPain($data);
        $this->data_model->updateTaskWithLink($userId, 'painPatient');
        $this->load->helper('url');
        redirect('/PatientController/homePatient', 'refresh');
    }

    function messagePatient() {
        $data["page_title"] = 'Messages';
        $data["content_title_1"] = 'Messages';
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('messages');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('messages');
        $userId = $this->session->userdata('userId');
        $check = $this->data_model->getMessages($userId);
        if ($check != NULL) {
            $data2['messages'] = $check;
            $data["content"] = $this->parser->parse('messagePatient', $data2, true);
        } else {
            $data2['messages'] = array();
            $data["content"] = $this->parser->parse('messagePatient', $data2, true);
        }
        $this->parser->parse('templatePatient', $data);
    }

    function surveyPatient() {
        $data["page_title"] = 'Survey';
        $data["content_title_1"] = 'Survey';
        $data["content_title_2"] = 'This is the survey';
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('survey');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('survey');
        $userId = $this->session->userdata('userId');
        $this->load->model('survey_model');
        $check = $this->survey_model->getQuestion($userId);
        if ($check != NULL) {
            $data2['questions'] = $check;
            $data["content"] = $this->parser->parse('surveyPatient', $data2, true);
        } else {
            $data2['questions'] = array();
            $data["content"] = $this->parser->parse('surveyEmpty', $data2, true);
            $this->data_model->updateTaskWithLink($userId, 'surveyPatient');
        }

        $this->parser->parse('templatePatient', $data);
    }

    function updateSurvey() {
        $this->load->model('survey_model');
        $idQuestion = $this->input->post('idQuestion');
        //$patientId = $this->input->post('patientId');
        $answer = $this->input->post('optradio');
        $data = array(
            'idQuestion' => $idQuestion,
            //'patientId' => $patientId,
            'answer' => $answer
        );
        if ($answer != NULL) {
            $this->survey_model->insertAnswer($idQuestion, $data);
        }
        $this->load->helper('url');
        redirect('/PatientController/surveyPatient', 'refresh');
    }

    function profilePatient() {
        $this->load->model('login_model');
        $data["page_title"] = 'Profile';
        $data["content_title_1"] = 'Profile';
        $userId = $this->session->userdata('userId');
        
        $myPhysicianId = $this->data_model->getPhysicianIdOfPatient($userId);
        $myPhysician = $this->data_model->getPhysicianProfile($myPhysicianId);
        if($myPhysician != NULL) {
            $data2["myPhysician"] = $myPhysician;
        }
        
        $assistants = $this->data_model->getPhysicianAssistants($myPhysicianId);
        if($assistants != NULL) {
            $data2["assistants"] = $assistants;
        }
            
        $data2['info'] = $this->data_model->getInfo($userId);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('Profile');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('Profile');

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('height', 'height', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        if ($this->input->post('password') != NULL || $this->input->post('password1') != NULL || $this->input->post('password2') != NULL) {
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('password1', 'password1', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'password2', 'required');
        }
        if ($this->input->post('firstname') != NULL) {
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
                } else {
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
                    'Password' => $encryptedPassword,
                );
                $this->data_model->updateProfile($userId, $data3);
                $data2["message_display"] = "Profile changed";
                $data2['info'] = $this->data_model->getInfo($userId);
                $data["content"] = $this->parser->parse('profilePatient', $data2, true);
            } else {
                $data2["error_message"] = "Failed: wrong input";
                $data["content"] = $this->parser->parse('profilePatient', $data2, true);
            }
        } else {
            $data["content"] = $this->parser->parse('profilePatient', $data2, true);
        }
        $this->parser->parse('templatePatient', $data);
    }

    function upload_file() {
        $status = "";
        $msg = "";
        $filename = "product_pic";

        /* if (empty($_POST['firstname'])) {
          $status = "error";
          $msg = "Please Enter title";
          } */

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
                    redirect('PatientController/profilePatient');
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

    function dataPatient() {
        $data["page_title"] = 'Data';
        $data["content_title_1"] = 'Data';
        $data["content_title_2"] = 'This is the data';
        $data2["patient"] = 'Mary';
        $data["content"] = $this->parser->parse('dataPatient', $data2, true);
        $data["menu_items_logout"] = $this->Patient_menu_model->get_menuitems_logout();
                $data["menu_items_message"] = $this->Patient_menu_model->get_menuitems_message();

        $data["menu_items_profile"] = $this->Patient_menu_model->get_menuitems_profile('measurements');
        $data["menu_items"] = $this->Patient_menu_model->get_menuitems('measurements');

        $this->parser->parse('templatePatient', $data);
    }

    // Logout from admin page
    public function logout() {

        // Destroying session data
        $this->session->sess_destroy();
        $message['message_display'] = 'Successfully Logout';
        $this->load->view('login_form', $message);
    }
    
    public function deleteMessage($data) {
        $this->data_model->deleteMessage($data);
    }

}
