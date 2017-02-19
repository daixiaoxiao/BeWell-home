<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class notification_model extends CI_Model {

    public function getNotificationQuestion($patientId) {
        $this->db->select('idQuestion, question, option1, option2, option3');
        $this->db->from('survey');
        $this->db->where('patientId', $patientId);
        $this->db->order_by('question');
        //$this->db->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

}
