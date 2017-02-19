<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NotificationController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->library('form_validation');
        $this->load->model('notification_model');
    }

    function notGet() {

        $this->load->model('notification_model');
        $data = $this->notification_model->getNotificationQuestion(5);

        $cards = array();

        foreach ($data as $q) {

            $mycard = array();

            $mycard["type"] = "radio";
            $mycard["card_id"] = "$q->idQuestion";
            $mycard["title"] = "Question";
            $mycard["text"] = $q->question;

            $mycard["options"] = array();

            $option1["value"] = "$q->option1";
            $option1["label"] = "$q->option1";
            $mycard["options"][] = $option1;

            $option2["value"] = "$q->option2";
            $option2["label"] = "$q->option2";
            $mycard["options"][] = $option2;

            $option3["value"] = "$q->option3";
            $option3["label"] = "$q->option3";
            $mycard["options"][] = $option3;

            //$cards[] = $mycard;
            array_push($cards, $mycard);

            //echo json_encode($mycard["options"]);
            //empty($mycard["options"]);
        }
        echo json_encode($cards);
    }

}
